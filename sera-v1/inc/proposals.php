<?php
/**
 * Private commercial proposals at /comercial/<slug>.
 *
 * Each proposal is a PHP data file in inc/proposals/<key>.php (terms, client, version). The page is
 * rendered here, outside the normal theme templates: no wp_head(), no plugins' scripts, no tracking.
 *
 * Access
 * - A four-digit access code, checked on the server. The code is never in the repository: it is set
 *   in wp-admin › Ferramentas › Propostas (stored as a password hash) or in wp-config.php as
 *   define( 'SERA_PROPOSAL_PIN_EVANLY', '....' ). With no code set, the page stays locked.
 * - Failed attempts are throttled per visitor (hashed IP, kept only in a short transient) and
 *   globally per proposal, so the 10,000 combinations cannot be walked through.
 * - A correct code sets a signed, HttpOnly, Secure, SameSite=Lax cookie for 2 hours. Its name starts
 *   with "wp-postpass_" on purpose: page caches (Endurance/Newfold, nginx) never cache a request
 *   carrying that cookie. Changing the code or "Revogar sessões" invalidates every open session.
 * - Every response on the route is private/no-store, noindex and never framed.
 *
 * Records
 * - Acceptances and questions are stored as private posts of type sera_prop_record (never public,
 *   no front-end URL) and listed in Ferramentas › Propostas for admins only.
 * - Persist first, notify second: if the e-mail fails the record stays, flagged for a resend.
 * - One acceptance per proposal version (idempotent); questions are allowed before and after it.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

const SERA_PROP_SESSION_TTL   = 7200; // 2 hours.
const SERA_PROP_IP_FAILS      = 5;    // Wrong codes per visitor…
const SERA_PROP_IP_WINDOW     = 900;  // …per 15 minutes.
const SERA_PROP_GLOBAL_FAILS  = 60;   // Wrong codes per proposal (all visitors)…
const SERA_PROP_GLOBAL_WINDOW = 3600; // …per hour.
const SERA_PROP_MAX_MESSAGE   = 4000;

/**
 * Known proposals: key => data (loaded from inc/proposals/<key>.php).
 *
 * @return array<string,array>
 */
function sera_proposals() {
	static $all = null;
	if ( null === $all ) {
		$all = array();
		foreach ( array( 'evanly' ) as $key ) {
			$file = get_template_directory() . '/inc/proposals/' . $key . '.php';
			if ( file_exists( $file ) ) {
				$data        = require $file;
				$data['key'] = $key;
				$all[ $key ] = $data;
			}
		}
	}
	return $all;
}

/**
 * Proposal served at a slug (e.g. 'evenly'), or null.
 *
 * @param string $slug Last part of /comercial/<slug>.
 */
function sera_proposal_by_slug( $slug ) {
	foreach ( sera_proposals() as $p ) {
		if ( in_array( $slug, $p['slugs'], true ) ) {
			return $p;
		}
	}
	return null;
}

/* ---------------------------------------------------------------------------------------------
 * Access code + session
 * ------------------------------------------------------------------------------------------- */

/**
 * Where the code comes from: 'config' (wp-config constant), 'admin' (hash in options) or ''.
 *
 * @param array $p Proposal.
 */
function sera_prop_pin_source( $p ) {
	$const = 'SERA_PROPOSAL_PIN_' . strtoupper( $p['key'] );
	if ( defined( $const ) && preg_match( '/^\d{4}$/', (string) constant( $const ) ) ) {
		return 'config';
	}
	$hashes = (array) get_option( 'sera_prop_pins', array() );
	return empty( $hashes[ $p['id'] ] ) ? '' : 'admin';
}

/**
 * Does the code match?
 *
 * @param array  $p   Proposal.
 * @param string $pin Four digits.
 */
function sera_prop_pin_ok( $p, $pin ) {
	if ( ! preg_match( '/^\d{4}$/', $pin ) ) {
		return false;
	}
	$src = sera_prop_pin_source( $p );
	if ( 'config' === $src ) {
		return hash_equals( (string) constant( 'SERA_PROPOSAL_PIN_' . strtoupper( $p['key'] ) ), $pin );
	}
	if ( 'admin' === $src ) {
		$hashes = (array) get_option( 'sera_prop_pins', array() );
		return password_verify( $pin, (string) $hashes[ $p['id'] ] );
	}
	return false;
}

/**
 * Secret that signs sessions. Changes when the code changes or sessions are revoked.
 *
 * @param array $p Proposal.
 */
function sera_prop_secret( $p ) {
	$gens   = (array) get_option( 'sera_prop_gen', array() );
	$gen    = isset( $gens[ $p['id'] ] ) ? (int) $gens[ $p['id'] ] : 1;
	$hashes = (array) get_option( 'sera_prop_pins', array() );
	$pinkey = 'config' === sera_prop_pin_source( $p ) ? hash( 'sha256', (string) constant( 'SERA_PROPOSAL_PIN_' . strtoupper( $p['key'] ) ) ) : ( isset( $hashes[ $p['id'] ] ) ? $hashes[ $p['id'] ] : '' );
	return wp_salt( 'secure_auth' ) . '|' . $p['id'] . '|' . $gen . '|' . $pinkey;
}

/**
 * Cookie name (wp-postpass_ prefix keeps page caches away, see header).
 *
 * @param array $p Proposal.
 */
function sera_prop_cookie( $p ) {
	return 'wp-postpass_sera_' . $p['key'];
}

/**
 * Current session value, or '' when there is no valid session.
 *
 * @param array $p Proposal.
 */
function sera_prop_session( $p ) {
	$name = sera_prop_cookie( $p );
	if ( empty( $_COOKIE[ $name ] ) || '' === sera_prop_pin_source( $p ) ) {
		return '';
	}
	$raw   = (string) wp_unslash( $_COOKIE[ $name ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$parts = explode( '.', $raw );
	if ( 3 !== count( $parts ) || ! ctype_digit( $parts[0] ) ) {
		return '';
	}
	list( $exp, $nonce, $sig ) = $parts;
	if ( (int) $exp < time() || (int) $exp > time() + SERA_PROP_SESSION_TTL + 60 ) {
		return '';
	}
	$want = hash_hmac( 'sha256', $exp . '.' . $nonce, sera_prop_secret( $p ) );
	return hash_equals( $want, $sig ) ? $raw : '';
}

/**
 * Start a session (after a correct code).
 *
 * @param array $p Proposal.
 */
function sera_prop_start_session( $p ) {
	$exp   = (string) ( time() + SERA_PROP_SESSION_TTL );
	$nonce = bin2hex( random_bytes( 12 ) );
	$val   = $exp . '.' . $nonce . '.' . hash_hmac( 'sha256', $exp . '.' . $nonce, sera_prop_secret( $p ) );
	sera_prop_set_cookie( $p, $val, (int) $exp );
	return $val;
}

/**
 * Write (or clear) the session cookie.
 *
 * @param array  $p   Proposal.
 * @param string $val Value ('' clears).
 * @param int    $exp Unix expiry.
 */
function sera_prop_set_cookie( $p, $val, $exp ) {
	setcookie(
		sera_prop_cookie( $p ),
		$val,
		array(
			'expires'  => $exp,
			'path'     => sera_home_path() . '/comercial/',
			'secure'   => is_ssl(),
			'httponly' => true,
			'samesite' => 'Lax',
		)
	);
}

/**
 * Form token bound to the session (CSRF).
 *
 * @param array  $p       Proposal.
 * @param string $session Session value.
 */
function sera_prop_csrf( $p, $session ) {
	return hash_hmac( 'sha256', 'csrf|' . $session, sera_prop_secret( $p ) );
}

/**
 * Visitor key for throttling: a salted hash of the IP, never the IP itself.
 */
function sera_prop_visitor() {
	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? (string) wp_unslash( $_SERVER['REMOTE_ADDR'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	return substr( hash_hmac( 'sha256', $ip, wp_salt( 'nonce' ) ), 0, 24 );
}

/**
 * Count a hit in a fixed window. Returns the count after this hit.
 *
 * @param string $key    Transient key.
 * @param int    $window Seconds.
 */
function sera_prop_hit( $key, $window ) {
	$data = get_transient( $key );
	if ( ! is_array( $data ) || $data['until'] < time() ) {
		$data = array(
			'n'     => 0,
			'until' => time() + $window,
		);
	}
	++$data['n'];
	set_transient( $key, $data, max( 1, $data['until'] - time() ) );
	return $data['n'];
}

/**
 * Hits so far in the current window.
 *
 * @param string $key Transient key.
 */
function sera_prop_hits( $key ) {
	$data = get_transient( $key );
	return ( is_array( $data ) && $data['until'] >= time() ) ? (int) $data['n'] : 0;
}

/**
 * Is the access form locked for this visitor (or for everyone)?
 *
 * @param array $p Proposal.
 */
function sera_prop_locked( $p ) {
	return sera_prop_hits( 'sera_pf_' . sera_prop_visitor() ) >= SERA_PROP_IP_FAILS
		|| sera_prop_hits( 'sera_pg_' . md5( $p['id'] ) ) >= SERA_PROP_GLOBAL_FAILS;
}

/* ---------------------------------------------------------------------------------------------
 * Records
 * ------------------------------------------------------------------------------------------- */

add_action(
	'init',
	function () {
		register_post_type(
			'sera_prop_record',
			array(
				'label'               => 'Registros de proposta',
				'public'              => false,
				'publicly_queryable'  => false,
				'exclude_from_search' => true,
				'show_ui'             => false,
				'show_in_rest'        => false,
				'rewrite'             => false,
				'query_var'           => false,
				'supports'            => array( 'title' ),
			)
		);
	}
);

/**
 * Records of a proposal.
 *
 * @param string $proposal_id Proposal id.
 * @param string $type        'acceptance' | 'question' | '' (both).
 * @param string $version     Only this version ('' = any).
 * @return WP_Post[]
 */
function sera_prop_records( $proposal_id, $type = '', $version = '' ) {
	$meta = array(
		array(
			'key'   => 'proposalId',
			'value' => $proposal_id,
		),
	);
	if ( $type ) {
		$meta[] = array(
			'key'   => 'type',
			'value' => $type,
		);
	}
	if ( $version ) {
		$meta[] = array(
			'key'   => 'version',
			'value' => $version,
		);
	}
	return get_posts(
		array(
			'post_type'        => 'sera_prop_record',
			'post_status'      => 'private',
			'posts_per_page'   => 200,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'meta_query'       => $meta, // phpcs:ignore WordPress.DB.SlowDBQuery
			'suppress_filters' => true,
		)
	);
}

/**
 * The acceptance of the proposal's current version, or null.
 *
 * @param array $p Proposal.
 */
function sera_prop_acceptance( $p ) {
	$r = sera_prop_records( $p['id'], 'acceptance', $p['version'] );
	return $r ? $r[0] : null;
}

/**
 * Store a record. Returns the post ID (0 on failure).
 *
 * @param string $title Admin title.
 * @param array  $meta  Fields.
 */
function sera_prop_store( $title, $meta ) {
	$meta['id']                 = wp_generate_uuid4();
	$meta['createdAtUtc']       = gmdate( 'Y-m-d\TH:i:s\Z' );
	$meta['notificationStatus'] = 'pending';
	$id                         = wp_insert_post(
		array(
			'post_type'   => 'sera_prop_record',
			'post_status' => 'private',
			'post_title'  => $title,
			'meta_input'  => $meta,
		),
		true
	);
	return is_wp_error( $id ) ? 0 : (int) $id;
}

/**
 * E-mail address that receives notifications.
 */
function sera_prop_notify_to() {
	$to = (string) get_option( 'sera_prop_notify_email', '' );
	return is_email( $to ) ? $to : (string) get_option( 'admin_email' );
}

/**
 * Money: 129900 → "$1,299.00".
 *
 * @param int $cents Cents.
 */
function sera_prop_money( $cents ) {
	$cents = (int) $cents;
	return '$' . number_format( $cents / 100, 0 === $cents % 100 ? 0 : 2 );
}

/**
 * Send the notification of a record and save its status. Returns true when sent.
 *
 * @param int $post_id Record.
 */
function sera_prop_notify( $post_id ) {
	$type = get_post_meta( $post_id, 'type', true );
	$p    = null;
	foreach ( sera_proposals() as $cand ) {
		if ( $cand['id'] === get_post_meta( $post_id, 'proposalId', true ) ) {
			$p = $cand;
		}
	}
	if ( ! $p ) {
		return false;
	}
	$email = (string) get_post_meta( $post_id, 'email', true );
	$name  = (string) get_post_meta( $post_id, 'name', true );
	$when  = (string) get_post_meta( $post_id, 'createdAtUtc', true );
	$admin = admin_url( 'tools.php?page=sera-proposals' );
	if ( 'acceptance' === $type ) {
		$t       = json_decode( (string) get_post_meta( $post_id, 'termsSnapshot', true ), true );
		$subject = sprintf( '[Proposta] %s aceitou: %s (v%s)', $p['client'], $p['terms']['offer'], get_post_meta( $post_id, 'version', true ) );
		$body    = "Proposta aceita.\n\n"
			. 'Cliente: ' . $p['client'] . "\n"
			. 'Nome: ' . ( $name ? $name : '-' ) . "\n"
			. 'E-mail: ' . $email . "\n"
			. 'Quando (UTC): ' . $when . "\n"
			. 'Proposta: ' . $p['id'] . ' · versão ' . get_post_meta( $post_id, 'version', true ) . "\n"
			. 'Valor: ' . sera_prop_money( $t['amountCents'] ) . ' ' . $t['currency'] . ' (' . sera_prop_money( $t['depositCents'] ) . ' na entrada, ' . sera_prop_money( $t['finalPaymentCents'] ) . " na entrega)\n"
			. 'Hash dos termos: ' . get_post_meta( $post_id, 'termsHash', true ) . "\n"
			. 'Registro: ' . get_post_meta( $post_id, 'id', true ) . "\n\n"
			. "Próximos passos: confirmar o kickoff, mandar as instruções de pagamento e o checklist de acessos.\n"
			. 'Registros: ' . $admin . "\n";
	} else {
		$subject = sprintf( '[Proposta] Pergunta de %s (%s)', $p['client'], $email );
		$body    = "Nova mensagem na proposta.\n\n"
			. 'E-mail: ' . $email . "\n"
			. 'Quando (UTC): ' . $when . "\n\n"
			. (string) get_post_meta( $post_id, 'message', true ) . "\n\n"
			. 'Registros: ' . $admin . "\n";
	}
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( is_email( $email ) ) {
		$headers[] = 'Reply-To: ' . $email;
	}
	$sent = wp_mail( sera_prop_notify_to(), $subject, $body, $headers );
	update_post_meta( $post_id, 'notificationStatus', $sent ? 'sent' : 'failed' );

	// Optional confirmation to the client (off by default; never during tests).
	if ( $sent && 'acceptance' === $type && get_option( 'sera_prop_confirm_client' ) && is_email( $email ) ) {
		$first = $name ? strtok( $name, ' ' ) : $p['contact']['first'];
		wp_mail(
			$email,
			'Your acceptance of the ' . $p['terms']['offer'] . ' proposal',
			'Hi ' . $first . ",\n\nThank you. Your acceptance of the " . $p['terms']['offer'] . ' proposal (version ' . $p['version'] . ') has been recorded on ' . $when . " (UTC).\n\n"
			. 'Investment: ' . sera_prop_money( $p['terms']['amountCents'] ) . ' ' . $p['terms']['currency'] . ', 50% to get started (' . sera_prop_money( $p['terms']['depositCents'] ) . ') and 50% on delivery (' . sera_prop_money( $p['terms']['finalPaymentCents'] ) . ").\n\n"
			. "Next, I'll confirm the kickoff, send payment instructions and share the initial access checklist. Nothing has been charged.\n\nMatheus Serafim\n",
			array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . sera_prop_notify_to() )
		);
	}
	return $sent;
}

/* ---------------------------------------------------------------------------------------------
 * Router
 * ------------------------------------------------------------------------------------------- */

add_action(
	'parse_request',
	function ( $wp ) {
		if ( ! preg_match( '#^comercial/([a-z0-9-]+)/?$#', (string) $wp->request, $m ) ) {
			return;
		}
		$p = sera_proposal_by_slug( $m[1] );
		if ( ! $p ) {
			return; // Normal 404.
		}
		sera_prop_serve( $p, $m[1] );
		exit;
	},
	0
);

/**
 * Private, never cached, never indexed, never framed.
 */
function sera_prop_headers() {
	if ( ! defined( 'DONOTCACHEPAGE' ) ) {
		define( 'DONOTCACHEPAGE', true );
	}
	nocache_headers();
	header( 'Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0' );
	header( 'Pragma: no-cache' );
	header( 'Vary: Cookie' );
	header( 'X-Robots-Tag: noindex, nofollow, noarchive, nosnippet' );
	header( 'Referrer-Policy: no-referrer' );
	header( 'X-Frame-Options: DENY' );
	header( 'X-Content-Type-Options: nosniff' );
	header( "Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'; form-action 'self'; frame-ancestors 'none'; base-uri 'none'" );
}

/**
 * Is a POST coming from this site? (Origin/Referer check on top of SameSite + token.)
 */
function sera_prop_same_origin() {
	$home = wp_parse_url( home_url(), PHP_URL_HOST );
	foreach ( array( 'HTTP_ORIGIN', 'HTTP_REFERER' ) as $h ) {
		if ( ! empty( $_SERVER[ $h ] ) ) {
			return wp_parse_url( (string) wp_unslash( $_SERVER[ $h ] ), PHP_URL_HOST ) === $home; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		}
	}
	return true; // Some privacy setups send neither; the session token still applies.
}

/**
 * Handle the request for a proposal.
 *
 * @param array  $p    Proposal.
 * @param string $slug Requested slug.
 */
function sera_prop_serve( $p, $slug ) {
	sera_prop_headers();
	$url     = home_url( '/comercial/' . $slug . '/' );
	$method  = isset( $_SERVER['REQUEST_METHOD'] ) ? strtoupper( (string) $_SERVER['REQUEST_METHOD'] ) : 'GET'; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$is_json = isset( $_SERVER['HTTP_ACCEPT'] ) && false !== strpos( (string) $_SERVER['HTTP_ACCEPT'], 'application/json' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$session = sera_prop_session( $p );

	if ( 'POST' === $method ) {
		// phpcs:disable WordPress.Security.NonceVerification -- session-bound token checked below.
		$action = isset( $_POST['sera_action'] ) ? sanitize_key( wp_unslash( $_POST['sera_action'] ) ) : '';
		$res    = sera_prop_post( $p, $action, $session, $_POST );
		// phpcs:enable
		if ( $is_json ) {
			status_header( $res['status'] );
			header( 'Content-Type: application/json; charset=utf-8' );
			echo wp_json_encode( $res['body'] );
			return;
		}
		// No-JS fallback: back to the page (Post/Redirect/Get), with a short flag.
		$flag = isset( $res['body']['flag'] ) ? $res['body']['flag'] : ( isset( $res['body']['error'] ) ? 'e-' . $res['body']['error'] : '' );
		$to   = $flag ? add_query_arg( 'r', $flag, $url ) : $url;
		if ( ! empty( $res['body']['anchor'] ) ) {
			$to .= '#' . $res['body']['anchor'];
		}
		wp_safe_redirect( $to, 303 );
		return;
	}

	if ( 'GET' !== $method && 'HEAD' !== $method ) {
		status_header( 405 );
		return;
	}

	$flag = isset( $_GET['r'] ) ? sanitize_key( wp_unslash( $_GET['r'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	header( 'Content-Type: text/html; charset=utf-8' );
	if ( ! $session ) {
		status_header( 200 );
		sera_prop_render(
			'gate',
			array(
				'p'      => $p,
				'url'    => $url,
				'error'  => $flag,
				'locked' => sera_prop_locked( $p ),
				'ready'  => '' !== sera_prop_pin_source( $p ),
			)
		);
		return;
	}
	sera_prop_render(
		$p['key'],
		array(
			'p'        => $p,
			'url'      => $url,
			'csrf'     => sera_prop_csrf( $p, $session ),
			'accepted' => sera_prop_acceptance( $p ),
			'flag'     => $flag,
		)
	);
}

/**
 * Render a proposal template with its variables.
 *
 * @param string $tpl  Template name in template-parts/proposals/.
 * @param array  $vars Variables.
 */
function sera_prop_render( $tpl, $vars ) {
	$vars['asset'] = function ( $rel ) {
		return get_template_directory_uri() . '/' . $rel . '?ver=' . rawurlencode( sera_asset_ver( $rel ) );
	};
	$vars['logo']  = function_exists( 'sera_brand_logo' ) ? sera_brand_logo() : '';
	$vars['photo'] = get_template_directory_uri() . '/assets/img/proposal-photo.webp';
	extract( $vars ); // phpcs:ignore WordPress.PHP.DontExtract
	include get_template_directory() . '/template-parts/proposals/' . $tpl . '.php';
}

/**
 * POST actions. Returns array( 'status' => int, 'body' => array ).
 *
 * @param array  $p       Proposal.
 * @param string $action  unlock | accept | question | leave.
 * @param string $session Current session ('' when none).
 * @param array  $in      Raw $_POST.
 */
function sera_prop_post( $p, $action, $session, $in ) {
	$err = function ( $status, $code, $anchor = '' ) {
		return array(
			'status' => $status,
			'body'   => array(
				'ok'     => false,
				'error'  => $code,
				'anchor' => $anchor,
			),
		);
	};
	if ( ! sera_prop_same_origin() ) {
		return $err( 403, 'origin' );
	}

	if ( 'unlock' === $action ) {
		if ( '' === sera_prop_pin_source( $p ) ) {
			return $err( 503, 'unavailable' );
		}
		if ( sera_prop_locked( $p ) ) {
			return $err( 429, 'locked' );
		}
		$pin = isset( $in['code'] ) ? preg_replace( '/\D/', '', (string) wp_unslash( $in['code'] ) ) : '';
		if ( ! sera_prop_pin_ok( $p, $pin ) ) {
			sera_prop_hit( 'sera_pf_' . sera_prop_visitor(), SERA_PROP_IP_WINDOW );
			sera_prop_hit( 'sera_pg_' . md5( $p['id'] ), SERA_PROP_GLOBAL_WINDOW );
			return sera_prop_locked( $p ) ? $err( 429, 'locked' ) : $err( 401, 'code' );
		}
		delete_transient( 'sera_pf_' . sera_prop_visitor() );
		sera_prop_start_session( $p );
		return array(
			'status' => 200,
			'body'   => array( 'ok' => true ),
		);
	}

	// Everything below needs a valid session and its token.
	$token = isset( $in['token'] ) ? (string) wp_unslash( $in['token'] ) : '';
	if ( ! $session ) {
		return $err( 401, 'session' );
	}
	if ( ! hash_equals( sera_prop_csrf( $p, $session ), $token ) ) {
		return $err( 403, 'token' );
	}

	if ( 'leave' === $action ) {
		sera_prop_set_cookie( $p, '', time() - 3600 );
		return array(
			'status' => 200,
			'body'   => array(
				'ok'   => true,
				'flag' => 'left',
			),
		);
	}

	// Writes: a small per-visitor budget against floods.
	if ( sera_prop_hit( 'sera_pw_' . sera_prop_visitor(), 3600 ) > 20 ) {
		return $err( 429, 'busy', 'accept' );
	}

	$email = isset( $in['email'] ) ? sanitize_email( wp_unslash( $in['email'] ) ) : '';
	$name  = isset( $in['name'] ) ? sanitize_text_field( wp_unslash( $in['name'] ) ) : '';

	if ( 'accept' === $action ) {
		if ( ! is_email( $email ) || strlen( $email ) > 190 ) {
			return $err( 422, 'email', 'accept' );
		}
		if ( '' === $name || mb_strlen( $name ) > 120 ) {
			return $err( 422, 'name', 'accept' );
		}
		if ( empty( $in['confirm'] ) ) {
			return $err( 422, 'confirm', 'accept' );
		}
		if ( ( isset( $in['version'] ) ? (string) $in['version'] : '' ) !== $p['version'] ) {
			return $err( 409, 'version', 'accept' );
		}
		$done = array(
			'status' => 200,
			'body'   => array(
				'ok'     => true,
				'flag'   => 'accepted',
				'anchor' => 'accept',
			),
		);
		if ( sera_prop_acceptance( $p ) ) {
			return $done; // Already recorded: same answer, no duplicate.
		}
		$lock = 'sera_prop_lock_' . md5( $p['id'] . '|' . $p['version'] );
		if ( ! add_option( $lock, time(), '', false ) ) {
			return sera_prop_acceptance( $p ) ? $done : $err( 409, 'busy', 'accept' );
		}
		$terms = $p['terms'] + array(
			'proposalId' => $p['id'],
			'version'    => $p['version'],
		);
		$snap  = wp_json_encode( $terms );
		$id    = sera_prop_store(
			sprintf( 'Aceite · %s · v%s · %s', $p['client'], $p['version'], $email ),
			array(
				'type'                => 'acceptance',
				'proposalId'          => $p['id'],
				'version'             => $p['version'],
				'termsVersion'        => $p['version'],
				'termsSnapshot'       => wp_slash( $snap ),
				'termsHash'           => hash( 'sha256', $snap ),
				'amountCents'         => (int) $p['terms']['amountCents'],
				'currency'            => $p['terms']['currency'],
				'email'               => $email,
				'name'                => $name,
				'acceptanceConfirmed' => 1,
			)
		);
		if ( ! $id ) {
			delete_option( $lock );
			return $err( 500, 'save', 'accept' );
		}
		sera_prop_notify( $id );
		return $done;
	}

	if ( 'question' === $action ) {
		$msg = isset( $in['message'] ) ? sanitize_textarea_field( wp_unslash( $in['message'] ) ) : '';
		if ( ! is_email( $email ) || strlen( $email ) > 190 ) {
			return $err( 422, 'q-email', 'questions' );
		}
		if ( '' === trim( $msg ) ) {
			return $err( 422, 'q-message', 'questions' );
		}
		if ( mb_strlen( $msg ) > SERA_PROP_MAX_MESSAGE ) {
			return $err( 422, 'q-long', 'questions' );
		}
		$id = sera_prop_store(
			sprintf( 'Pergunta · %s · %s', $p['client'], $email ),
			array(
				'type'       => 'question',
				'proposalId' => $p['id'],
				'version'    => $p['version'],
				'email'      => $email,
				'message'    => $msg,
			)
		);
		if ( ! $id ) {
			return $err( 500, 'q-save', 'questions' );
		}
		sera_prop_notify( $id );
		return array(
			'status' => 200,
			'body'   => array(
				'ok'     => true,
				'flag'   => 'asked',
				'anchor' => 'questions',
			),
		);
	}

	return $err( 400, 'action' );
}

/* ---------------------------------------------------------------------------------------------
 * Admin: Ferramentas › Propostas (admins only)
 * ------------------------------------------------------------------------------------------- */

add_action(
	'admin_menu',
	function () {
		add_management_page( 'Propostas', 'Propostas', 'manage_options', 'sera-proposals', 'sera_prop_admin_page' );
	}
);

add_action(
	'admin_post_sera_prop_admin',
	function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Sem permissão.' );
		}
		check_admin_referer( 'sera_prop_admin' );
		$do  = isset( $_POST['do'] ) ? sanitize_key( wp_unslash( $_POST['do'] ) ) : '';
		$pid = isset( $_POST['proposal'] ) ? sanitize_text_field( wp_unslash( $_POST['proposal'] ) ) : '';
		$msg = '';
		$bump = function () use ( $pid ) {
			$gens         = (array) get_option( 'sera_prop_gen', array() );
			$gens[ $pid ] = ( isset( $gens[ $pid ] ) ? (int) $gens[ $pid ] : 1 ) + 1;
			update_option( 'sera_prop_gen', $gens, false );
		};
		if ( 'pin' === $do ) {
			$pin = isset( $_POST['pin'] ) ? preg_replace( '/\D/', '', (string) wp_unslash( $_POST['pin'] ) ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			if ( preg_match( '/^\d{4}$/', $pin ) ) {
				$hashes         = (array) get_option( 'sera_prop_pins', array() );
				$hashes[ $pid ] = password_hash( $pin, PASSWORD_DEFAULT );
				update_option( 'sera_prop_pins', $hashes, false );
				$bump();
				$msg = 'pin';
			} else {
				$msg = 'pin-bad';
			}
		} elseif ( 'revoke' === $do ) {
			$bump();
			$msg = 'revoked';
		} elseif ( 'settings' === $do ) {
			$to = isset( $_POST['notify'] ) ? sanitize_email( wp_unslash( $_POST['notify'] ) ) : '';
			update_option( 'sera_prop_notify_email', is_email( $to ) ? $to : '', false );
			update_option( 'sera_prop_confirm_client', empty( $_POST['confirm_client'] ) ? 0 : 1, false );
			$msg = 'saved';
		} elseif ( 'resend' === $do ) {
			$rid = isset( $_POST['record'] ) ? absint( $_POST['record'] ) : 0;
			$msg = ( $rid && 'sera_prop_record' === get_post_type( $rid ) && sera_prop_notify( $rid ) ) ? 'resent' : 'resend-failed';
		} elseif ( 'test' === $do ) {
			$msg = wp_mail( sera_prop_notify_to(), '[Proposta] Teste de notificação', "Teste enviado de Ferramentas › Propostas. Nenhum cliente recebeu nada.\n" ) ? 'test-ok' : 'test-failed';
		}
		wp_safe_redirect( admin_url( 'tools.php?page=sera-proposals&msg=' . $msg ) );
		exit;
	}
);

/**
 * Admin screen.
 */
function sera_prop_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$msgs = array(
		'pin'           => 'Código salvo. Sessões abertas foram encerradas.',
		'pin-bad'       => 'O código precisa ter 4 dígitos.',
		'revoked'       => 'Todas as sessões abertas foram encerradas.',
		'saved'         => 'Configurações salvas.',
		'resent'        => 'Notificação reenviada.',
		'resend-failed' => 'O e-mail falhou de novo. Confira o envio de e-mails do WordPress.',
		'test-ok'       => 'E-mail de teste enviado para ' . sera_prop_notify_to() . '.',
		'test-failed'   => 'O e-mail de teste falhou. O WordPress não está conseguindo enviar e-mails.',
	);
	$msg  = isset( $_GET['msg'] ) ? sanitize_key( wp_unslash( $_GET['msg'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	$form = function ( $pid, $do, $inner, $label, $cls = 'button' ) {
		echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '" style="display:inline-block;margin:0 8px 8px 0">';
		wp_nonce_field( 'sera_prop_admin' );
		echo '<input type="hidden" name="action" value="sera_prop_admin"><input type="hidden" name="do" value="' . esc_attr( $do ) . '"><input type="hidden" name="proposal" value="' . esc_attr( $pid ) . '">';
		echo $inner; // phpcs:ignore WordPress.Security.EscapeOutput
		echo ' <button class="' . esc_attr( $cls ) . '">' . esc_html( $label ) . '</button></form>';
	};
	echo '<div class="wrap"><h1>Propostas</h1>';
	if ( isset( $msgs[ $msg ] ) ) {
		echo '<div class="notice notice-info"><p>' . esc_html( $msgs[ $msg ] ) . '</p></div>';
	}

	echo '<h2>Notificações</h2><form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '">';
	wp_nonce_field( 'sera_prop_admin' );
	echo '<input type="hidden" name="action" value="sera_prop_admin"><input type="hidden" name="do" value="settings">';
	echo '<p><label>E-mail que recebe aceites e perguntas<br><input type="email" class="regular-text" name="notify" value="' . esc_attr( (string) get_option( 'sera_prop_notify_email', '' ) ) . '" placeholder="' . esc_attr( (string) get_option( 'admin_email' ) ) . '"></label></p>';
	echo '<p><label><input type="checkbox" name="confirm_client" value="1" ' . checked( (bool) get_option( 'sera_prop_confirm_client' ), true, false ) . '> Mandar confirmação por e-mail para o cliente quando ele aceitar (deixe desligado enquanto testa)</label></p>';
	echo '<p><button class="button button-primary">Salvar</button></p></form>';
	$form( '', 'test', '', 'Enviar e-mail de teste para mim' );

	foreach ( sera_proposals() as $p ) {
		$src  = sera_prop_pin_source( $p );
		$link = home_url( '/comercial/' . $p['slugs'][0] . '/' );
		echo '<hr><h2>' . esc_html( $p['client'] . ' · ' . $p['terms']['offer'] ) . ' <small>(v' . esc_html( $p['version'] ) . ')</small></h2>';
		echo '<p><a href="' . esc_url( $link ) . '" target="_blank" rel="noopener">' . esc_html( $link ) . '</a></p>';
		echo '<p>Código de acesso: <strong>' . esc_html( 'config' === $src ? 'definido no wp-config.php' : ( 'admin' === $src ? 'definido aqui' : 'não definido (a página fica trancada)' ) ) . '</strong></p>';
		if ( 'config' !== $src ) {
			$form( $p['id'], 'pin', '<input type="password" name="pin" inputmode="numeric" pattern="\d{4}" maxlength="4" autocomplete="new-password" placeholder="4 dígitos" style="width:110px">', 'Salvar código', 'button button-primary' );
		}
		$form( $p['id'], 'revoke', '', 'Encerrar todas as sessões' );

		$recs = sera_prop_records( $p['id'] );
		echo '<h3>Registros</h3>';
		if ( ! $recs ) {
			echo '<p>Nenhum registro ainda.</p>';
			continue;
		}
		echo '<table class="widefat striped"><thead><tr><th>Tipo</th><th>Quando (UTC)</th><th>Nome / e-mail</th><th>Detalhe</th><th>Notificação</th></tr></thead><tbody>';
		foreach ( $recs as $r ) {
			$type = get_post_meta( $r->ID, 'type', true );
			$st   = (string) get_post_meta( $r->ID, 'notificationStatus', true );
			echo '<tr><td>' . esc_html( 'acceptance' === $type ? 'Aceite' : 'Pergunta' ) . '</td>';
			echo '<td>' . esc_html( (string) get_post_meta( $r->ID, 'createdAtUtc', true ) ) . '</td>';
			echo '<td>' . esc_html( trim( get_post_meta( $r->ID, 'name', true ) . ' ' ) ) . '<br>' . esc_html( (string) get_post_meta( $r->ID, 'email', true ) ) . '</td><td>';
			if ( 'acceptance' === $type ) {
				echo 'v' . esc_html( (string) get_post_meta( $r->ID, 'version', true ) ) . ' · ' . esc_html( sera_prop_money( (int) get_post_meta( $r->ID, 'amountCents', true ) ) . ' ' . get_post_meta( $r->ID, 'currency', true ) ) . '<br><code style="font-size:11px">' . esc_html( substr( (string) get_post_meta( $r->ID, 'termsHash', true ), 0, 16 ) ) . '…</code> · ' . esc_html( (string) get_post_meta( $r->ID, 'id', true ) );
			} else {
				echo nl2br( esc_html( (string) get_post_meta( $r->ID, 'message', true ) ) );
			}
			echo '</td><td>' . esc_html( 'sent' === $st ? 'enviada' : ( 'failed' === $st ? 'falhou' : 'pendente' ) );
			if ( 'sent' !== $st ) {
				echo '<br>';
				$form( $p['id'], 'resend', '<input type="hidden" name="record" value="' . (int) $r->ID . '">', 'Reenviar', 'button button-small' );
			}
			echo '</td></tr>';
		}
		echo '</tbody></table>';
	}
	echo '<p style="margin-top:24px;color:#646970">O aceite registra a confirmação do cliente na página (checkbox), não é assinatura digital certificada. Nada é cobrado automaticamente.</p></div>';
}
