<?php
/**
 * Proposal page: Evanly · Product Foundation Sprint. Rendered only with a valid session.
 *
 * Variables: $p, $url, $csrf, $accepted (WP_Post|null), $flag, $asset, $logo, $photo.
 * The static preview (tools/proposal-preview.php) renders this same file with stubs.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$sera_t     = $p['terms'];
$sera_price = sera_prop_money( $sera_t['amountCents'] );
$sera_dep   = sera_prop_money( $sera_t['depositCents'] );
$sera_fin   = sera_prop_money( $sera_t['finalPaymentCents'] );
$sera_rate  = sera_prop_money( $sera_t['additionalHourlyRateCents'] );
$sera_first = $p['contact']['first'];
$sera_until = $until ? gmdate( 'j F Y', strtotime( $until ) ) : '';

$sera_faq = array(
	array( 'How do revisions work?', 'Revisions and adjustments are agreed in our calls and async check-ins. I gather them into one shared list of changes, and the sprint includes up to two rounds of fine-tuning against that list.' ),
	array( 'What if we need another round?', 'An additional round of adjustments is priced from ' . esc_html( sera_prop_money( $sera_t['extraRoundFromCents'] ) ) . ', depending on the scope of the changes. I confirm the price with you before starting it.' ),
	array( 'What about work outside the scope?', 'Anything outside the agreed scope needs a new quote before work begins, so you always know the cost up front.' ),
	array( 'What happens if we cancel?', 'If you cancel after the initial payment, a 50% cancellation fee applies to it: of the ' . esc_html( $sera_dep ) . ' paid to get started, I refund ' . esc_html( sera_prop_money( $sera_t['cancellationRefundCents'] ) ) . '. The final payment is never charged.' ),
	array( 'When does the sprint start?', 'Once you accept, I confirm the kickoff and send payment instructions. The ten business days start after the initial payment, access and kickoff are in place.' ),
	array( 'How does payment work?', '50% to get started (' . esc_html( $sera_dep ) . ') and 50% on delivery (' . esc_html( $sera_fin ) . '). Instructions arrive by email after you accept; nothing is charged automatically.' ),
	array( 'What do you need from us?', 'Access to the product and, for implementation, the relevant codebase and environments. A person who can give feedback and make decisions quickly helps the sprint move.' ),
	array( 'Will you change anything in production?', 'Not without your approval. Changes go in as a reviewable branch or pull request when the stack allows, and affected paths are tested before handoff.' ),
);
if ( $sera_until ) {
	$sera_faq[] = array( 'How long is this proposal valid?', 'For ' . (int) $p['validDays'] . ' days, until ' . esc_html( $sera_until ) . '. After that, price and availability may change.' );
}

$sera_errors = array(
	'e-email'     => 'Enter a valid work email, like name@company.com.',
	'e-name'      => 'Enter your full name.',
	'e-confirm'   => 'Tick the confirmation box to accept the proposal.',
	'e-version'   => 'This proposal was updated. Reload the page to review the current version.',
	'e-save'      => "Your acceptance wasn't saved. Please try again.",
	'e-busy'      => 'Too many requests. Please wait a moment and try again.',
	'e-expired'   => 'This proposal is no longer open for acceptance. Send me a message below and I&rsquo;ll prepare an updated one.',
	'e-q-email'   => 'Enter a valid email so I can reply.',
	'e-q-message' => 'Write a message before sending.',
	'e-q-long'    => 'Keep the message under 4,000 characters.',
	'e-q-save'    => "Your message wasn't sent. Please try again.",
);
$sera_err_a = ( isset( $sera_errors[ $flag ] ) && 0 !== strpos( $flag, 'e-q-' ) ) ? $sera_errors[ $flag ] : '';
$sera_err_q = ( isset( $sera_errors[ $flag ] ) && 0 === strpos( $flag, 'e-q-' ) ) ? $sera_errors[ $flag ] : '';

$sera_stages = array(
	array(
		'n'     => '01',
		'id'    => 'assess',
		'days'  => 'Days 1 and 2',
		'title' => 'Product & Competitive Assessment',
		'text'  => 'Understand the existing financing experience, review relevant competitors, and identify high-impact opportunities to improve usability and differentiate Evanly.',
		'how'   => 'I start with the product as it is today, financing screens first, seen from the side of developers and of funders: the main flow, points of friction, hierarchy, how clearly financial information reads, and how consistent components and messages are. Alongside, a small set of direct and adjacent competitors, chosen with you, compared for strengths, gaps and practical openings. Experience attributes such as clarity, trust, efficiency and consistency come out of this as hypotheses to validate, not conclusions.',
		'gets'  => array( 'Focused UX assessment', 'Competitive insights', 'Experience principles', 'Prioritised recommendations' ),
		'check' => 'We confirm the focus before moving on.',
	),
	array(
		'n'     => '02',
		'id'    => 'found',
		'days'  => 'Days 3 to 5',
		'title' => 'Design & Brand Foundations',
		'text'  => "Build a lightweight, reusable design system and brand hub around the product’s actual needs: essential design tokens, core components, visual principles and tone of voice.",
		'how'   => 'What already works stays. On top of it: primitive and semantic tokens for colour, type, spacing, radius and states; the components the chosen flow needs; basic accessibility rules. A compact brand hub records personality, visual principles, tone of voice and microcopy examples, connected to the code when access allows.',
		'gets'  => array( 'Starter design system', 'Reusable visual foundations', 'Concise brand guidelines' ),
		'check' => 'You approve the direction.',
	),
	array(
		'n'     => '03',
		'id'    => 'refine',
		'days'  => 'Days 6 to 10',
		'title' => 'Product Refinement & Implementation',
		'text'  => 'Apply those foundations to the financing screens you mentioned. Refine the interface and key user flows, improve priority website and product copy, and implement the agreed changes while preserving what already works.',
		'how'   => 'Functional logic, data and architecture stay as they are. Hierarchy, legibility, navigation, states and visual consistency improve where the assessment points. Changes go into the code directly when access and stack allow, ideally as a reviewable branch or pull request, and never into production without your approval. Affected paths, responsive layouts and relevant regressions are tested.',
		'gets'  => array( 'Prioritised financing experience improvements', 'Implementation within the agreed technical scope', 'A concise handoff and next-cycle recommendations' ),
		'check' => 'Final demo and delivery.',
	),
);
$sera_proof = array(
	array(
		'mockup' => 'will-bank',
		'brand'  => 'will bank',
		'title'  => 'See the next bill before buying.',
		'text'   => 'I turned a back-end migration into control over time: a real-time open bill, future bills in the app and a way to plan a purchase before making it.',
		'slug'   => 'will-bank-switching-the-brain',
	),
	array(
		'mockup' => 'pagaleve',
		'brand'  => 'Pagaleve',
		'title'  => 'Move a due date before it&rsquo;s late.',
		'text'   => 'Customers who knew they couldn&rsquo;t pay could agree on a new date ahead of time, with AI agents choosing who saw the offer. From hackathon pitch to production.',
		'slug'   => 'combina-antes',
	),
	array(
		'mockup' => 'acordo-certo',
		'brand'  => 'Acordo Certo',
		'title'  => 'Make debt negotiation feel safe.',
		'text'   => 'The service is free for people in debt, yet the old homepage didn&rsquo;t feel trustworthy. I led strategy, research and direction, built on our own design system.',
		'slug'   => 'acordo-certo-homepage',
	),
);
$sera_styles = array( 'assets/css/mockups.css', 'assets/css/cases/wb.css', 'assets/css/cases/pg.css', 'assets/css/cases/ac.css', 'assets/css/proposal.css' );
?><!doctype html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
<meta name="referrer" content="no-referrer">
<title>Product Foundation Sprint · Prepared for <?php echo esc_html( $p['client'] ); ?></title>
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/favicon.svg' ); ?>" type="image/svg+xml">
<?php foreach ( $sera_styles as $sera_css ) : ?>
<link rel="stylesheet" href="<?php echo esc_url( $asset( $sera_css ) ); ?>">
<?php endforeach; ?>
<script src="<?php echo esc_url( $asset( 'assets/js/proposal.js' ) ); ?>" defer></script>
<script src="<?php echo esc_url( $asset( 'assets/js/lib/three.min.js' ) ); ?>" defer></script>
<script src="<?php echo esc_url( $asset( 'assets/js/proposal-building.js' ) ); ?>" defer></script>
</head>
<body class="prop">
<a class="p-skip" href="#content">Skip to content</a>

<header class="p-bar" data-prop-bar>
	<div class="p-wrap p-bar-row">
		<span class="p-bar-brand"><span class="p-bar-logo" aria-hidden="true"><?php echo $logo; // phpcs:ignore WordPress.Security.EscapeOutput ?></span><span class="p-bar-for">Proposal for <?php echo esc_html( $p['client'] ); ?></span></span>
		<nav class="p-bar-nav" aria-label="Proposal sections">
			<a href="#approach">Approach</a>
			<a href="#foundation">Foundation</a>
			<a href="#collaboration">Collaboration</a>
			<a href="#investment">Investment</a>
			<a href="#scope">Scope</a>
			<a href="#work">Work</a>
			<a href="#faq">FAQ</a>
		</nav>
		<a class="p-btn p-btn-ink p-btn-sm p-bar-cta" href="#accept"><?php echo $accepted ? 'Accepted' : 'Review and accept'; ?></a>
	</div>
</header>

<main id="content">

	<section class="p-hero" aria-labelledby="hero-title">
		<div class="p-wrap">
			<p class="p-kicker">Private project proposal, prepared for <?php echo esc_html( $p['client'] ); ?></p>
			<h1 class="p-hero-title" id="hero-title">A stronger foundation for Evanly&rsquo;s next stage.</h1>
			<div class="p-hero-cols">
				<p class="p-lede">Refine your financing experience today. Build the design and brand foundations that make tomorrow&rsquo;s changes easier.</p>
				<p class="p-hero-body">A focused, two-week collaboration with Matheus Serafim, created for early-stage startups that need to move quickly without sacrificing consistency.</p>
			</div>
			<dl class="p-facts">
				<div><dt>Format</dt><dd>Two-week sprint</dd></div>
				<div><dt>Scope</dt><dd>Design + implementation</dd></div>
				<div><dt>Fixed investment</dt><dd><?php echo esc_html( $sera_price ); ?> <abbr title="US dollars">USD</abbr></dd></div>
			</dl>
		</div>
	</section>

	<section class="p-note" aria-label="A note for <?php echo esc_attr( $sera_first ); ?>">
		<div class="p-wrap p-note-grid">
			<figure class="p-note-who">
				<img src="<?php echo esc_url( $photo ); ?>" alt="" width="96" height="96" loading="lazy" decoding="async">
				<figcaption><strong>Matheus Serafim</strong><span>Staff Product Designer</span></figcaption>
			</figure>
			<div class="p-note-body" data-focus>
				<p class="p-note-hi">Hi <?php echo esc_html( $sera_first ); ?>,</p>
				<p>You&rsquo;ve already built a working product and made meaningful progress on the financing screens. Rather than starting over, I&rsquo;d like to build on that progress and help make the experience clearer, more cohesive and easier to evolve.</p>
				<p>Evanly promises that every document, number and decision stays with the project, and that every figure can be traced back to where it came from. The financing screens are where people feel that promise most, so that&rsquo;s where I&rsquo;d start.</p>
				<p>The Product Foundation Sprint is a structured way to do that: understand what matters, establish just enough of a foundation, and put it to work in the product immediately.</p>
				<p class="p-note-sign">Matheus</p>
			</div>
		</div>
	</section>

	<section class="p-sec p-approach" id="approach" aria-labelledby="approach-title">
		<div class="p-wrap">
			<header class="p-head">
				<h2 class="p-h2" id="approach-title">Three stages. One focused outcome.</h2>
				<p class="p-head-text">The stages run in order and can overlap where that saves time. Each one ends with a checkpoint, so nothing moves forward without your view on it.</p>
			</header>

			<figure class="p-ruler" aria-labelledby="ruler-cap">
				<figcaption class="screen-reader-text" id="ruler-cap">Illustrative schedule across ten business days: stage 1 on days 1 and 2, stage 2 on days 3 to 5, stage 3 on days 6 to 10, with a short checkpoint every day.</figcaption>
				<ol class="p-ruler-days" aria-hidden="true">
					<?php for ( $sera_d = 1; $sera_d <= 10; $sera_d++ ) : ?>
						<li><span class="p-day-word">Day </span><?php echo (int) $sera_d; ?></li>
					<?php endfor; ?>
				</ol>
				<div class="p-ruler-track" aria-hidden="true">
					<?php foreach ( $sera_stages as $sera_s ) : ?>
						<a class="p-ruler-stage p-ruler-<?php echo esc_attr( $sera_s['id'] ); ?>" href="#stage-<?php echo esc_attr( $sera_s['id'] ); ?>" tabindex="-1"><b><?php echo esc_html( $sera_s['n'] ); ?></b><span><?php echo esc_html( $sera_s['title'] ); ?></span></a>
					<?php endforeach; ?>
				</div>
				<div class="p-ruler-ticks" aria-hidden="true">
					<?php for ( $sera_d = 1; $sera_d <= 10; $sera_d++ ) : ?>
						<i<?php echo in_array( $sera_d, array( 2, 5, 10 ), true ) ? ' class="is-gate"' : ''; ?>></i>
					<?php endfor; ?>
				</div>
				<p class="p-ruler-key" aria-hidden="true"><span class="p-key-dot"></span>Daily checkpoint <span class="p-key-dot is-gate"></span>Stage checkpoint</p>
			</figure>

			<div class="p-build" data-build-scroll>
				<figure class="p-bld" data-building aria-label="Illustration: an apartment building that is surveyed, given a foundation and structure, then finished, as you scroll through the three stages.">
					<div class="p-bld-stage">
						<svg class="p-bld-lines" aria-hidden="true" focusable="false">
							<line data-line="assess"></line><line data-line="found"></line><line data-line="refine"></line>
							<circle data-dot="assess" r="3"></circle><circle data-dot="found" r="3"></circle><circle data-dot="refine" r="3"></circle>
						</svg>
						<span class="p-bld-tag" data-tag="assess"><i aria-hidden="true">01</i>Assessment</span>
						<span class="p-bld-tag is-found" data-tag="found"><i aria-hidden="true">02</i>Foundations</span>
						<span class="p-bld-tag is-right" data-tag="refine"><i aria-hidden="true">03</i>Refinement</span>
						<span class="p-bld-prog" aria-hidden="true"><i></i><i></i><i></i></span>
					</div>
				</figure>
			<ol class="p-stages">
				<?php foreach ( $sera_stages as $sera_s ) : ?>
					<li class="p-stage p-stage-<?php echo esc_attr( $sera_s['id'] ); ?>" id="stage-<?php echo esc_attr( $sera_s['id'] ); ?>" data-stage="<?php echo esc_attr( $sera_s['id'] ); ?>">
						<div class="p-stage-side">
							<span class="p-stage-n" aria-hidden="true"><?php echo esc_html( $sera_s['n'] ); ?></span>
							<span class="p-stage-days"><?php echo esc_html( $sera_s['days'] ); ?></span>
						</div>
						<div class="p-stage-main">
							<h3 class="p-h3"><span class="screen-reader-text">Stage <?php echo esc_html( ltrim( $sera_s['n'], '0' ) ); ?>: </span><?php echo esc_html( $sera_s['title'] ); ?></h3>
							<p class="p-stage-text"><?php echo esc_html( $sera_s['text'] ); ?></p>
							<p class="p-stage-how"><?php echo esc_html( $sera_s['how'] ); ?></p>
						</div>
						<div class="p-stage-gets">
							<h4 class="p-label">Deliverables</h4>
							<ul>
								<?php foreach ( $sera_s['gets'] as $sera_g ) : ?>
									<li><?php echo esc_html( $sera_g ); ?></li>
								<?php endforeach; ?>
							</ul>
							<p class="p-stage-check"><span class="p-label">Checkpoint</span> <?php echo esc_html( $sera_s['check'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
			</div>
		</div>
	</section>

	<section class="p-sec p-found" id="foundation" aria-labelledby="found-title">
		<div class="p-wrap p-found-grid">
			<div class="p-found-copy">
				<h2 class="p-h2" id="found-title">Built to evolve, not to slow you down.</h2>
				<p>Early-stage products change quickly. A lean, well-structured foundation makes it easier to explore a different colour palette, refine the tone of voice or adjust the visual direction without rebuilding every screen.</p>
				<p>The aim is to make future decisions faster, keep the experience consistent, and reduce unnecessary rework.</p>
				<p>Evanly follows a building from acquisition to operations. The interface can hold up the same way: one set of decisions, applied from the first screen to the hundredth.</p>
				<p class="p-fine">Visual decisions live in tokens. Tone of voice lives in shared patterns and centralised copy where the code allows it. Both are documented, so the next change is a decision, not a hunt through screens.</p>
			</div>
			<figure class="p-demo" data-prop-demo>
				<div class="p-demo-controls" role="group" aria-label="Try a different palette">
					<span class="p-label" id="demo-label">Change one token set</span>
					<div class="p-demo-swatches">
						<button type="button" class="p-sw is-on" data-theme="a" aria-pressed="true"><i></i><span>Palette A</span></button>
						<button type="button" class="p-sw" data-theme="b" aria-pressed="false"><i></i><span>Palette B</span></button>
						<button type="button" class="p-sw" data-theme="c" aria-pressed="false"><i></i><span>Palette C</span></button>
					</div>
				</div>
				<div class="p-demo-screens" data-demo-theme="a" aria-hidden="true">
					<?php for ( $sera_i = 0; $sera_i < 3; $sera_i++ ) : ?>
						<div class="p-demo-screen p-demo-s<?php echo (int) $sera_i; ?>">
							<span class="d-top"></span>
							<span class="d-h"></span>
							<span class="d-l"></span><span class="d-l d-short"></span>
							<span class="d-row"><span class="d-chip"></span><span class="d-chip d-chip-2"></span></span>
							<span class="d-card"><span class="d-l"></span><span class="d-l d-short"></span></span>
							<span class="d-btn"></span>
						</div>
					<?php endfor; ?>
				</div>
				<figcaption class="p-demo-cap">Illustration only, not Evanly&rsquo;s interface. Every screen reads from the same tokens, so one change reaches all of them.</figcaption>
			</figure>
		</div>
	</section>

	<section class="p-sec p-collab" id="collaboration" aria-labelledby="collab-title">
		<div class="p-wrap p-collab-grid">
			<div>
				<h2 class="p-h2" id="collab-title">Two weeks, with progress you can see.</h2>
				<p>Daily asynchronous checkpoints on business days, with short updates, previews, feedback requests and decisions. We&rsquo;ll use live calls when they&rsquo;re genuinely helpful. Priorities are agreed at kickoff, and feedback is incorporated throughout the sprint within the agreed scope.</p>
			</div>
			<div class="p-daily">
				<h3 class="p-label">Every business day, a short update with</h3>
				<ul class="p-daily-list">
					<li><strong>Progress</strong><span>What moved, with a preview when there is something to see.</span></li>
					<li><strong>Decisions</strong><span>What I need from you, and by when.</span></li>
					<li><strong>Next steps</strong><span>What comes next in the sprint.</span></li>
					<li><strong>Blockers</strong><span>Access or feedback that is holding something up.</span></li>
				</ul>
				<p class="p-fine">If access or feedback runs late, the schedule can shift. I&rsquo;ll tell you before assuming any extension.</p>
			</div>
		</div>
	</section>

	<section class="p-sec p-invest" id="investment" aria-labelledby="invest-title" data-dark>
		<div class="p-wrap p-invest-grid">
			<div class="p-invest-head">
				<h2 class="p-label p-label-lt" id="invest-title">Investment</h2>
				<p class="p-invest-offer"><?php echo esc_html( $sera_t['offer'] ); ?></p>
				<ul class="p-invest-meta">
					<li>Two weeks</li>
					<li>Three stages</li>
					<li>Design + implementation</li>
				</ul>
			</div>
			<div class="p-invest-price">
				<p class="p-price"><span class="p-price-num"><?php echo esc_html( $sera_price ); ?></span> <span class="p-price-cur">USD</span></p>
				<p class="p-price-sub">One-time investment, fixed price.</p>
				<div class="p-split" role="list" aria-label="Payment schedule">
					<div class="p-split-part" role="listitem">
						<span class="p-split-bar"></span>
						<span class="p-split-k">50% to get started</span>
						<span class="p-split-v"><?php echo esc_html( $sera_dep ); ?></span>
					</div>
					<div class="p-split-part" role="listitem">
						<span class="p-split-bar"></span>
						<span class="p-split-k">50% upon delivery</span>
						<span class="p-split-v"><?php echo esc_html( $sera_fin ); ?></span>
					</div>
				</div>
				<?php if ( $sera_until ) : ?>
					<p class="p-invest-valid">Valid for <?php echo (int) $p['validDays']; ?> days, until <?php echo esc_html( $sera_until ); ?>.</p>
				<?php endif; ?>
				<p class="p-invest-note">Additional work beyond the agreed scope is optional and billed at <?php echo esc_html( $sera_rate ); ?>/hour with prior approval.</p>
			</div>
		</div>
	</section>

	<section class="p-sec p-scope" id="scope" aria-labelledby="scope-title">
		<div class="p-wrap">
			<header class="p-head">
				<h2 class="p-h2" id="scope-title">Scope and next steps</h2>
				<p class="p-head-text">This sprint is intentionally focused. We&rsquo;ll agree on the priority financing screens and implementation scope before work begins.</p>
			</header>
			<div class="p-scope-grid">
				<div class="p-scope-col">
					<h3 class="p-h4">Included</h3>
					<ul class="p-list p-list-yes">
						<li>A starter foundation: tokens, core components and concise brand guidelines</li>
						<li>Refinement of the priority financing screens agreed at kickoff</li>
						<li>Implementation within the agreed technical scope</li>
						<li>Daily checkpoints and a final demo with handoff</li>
					</ul>
				</div>
				<div class="p-scope-col">
					<h3 class="p-h4">Not part of this sprint</h3>
					<ul class="p-list p-list-no">
						<li>A complete rebrand</li>
						<li>A full product redesign</li>
						<li>An exhaustive component library</li>
						<li>Requests beyond the agreed scope, which are scoped and approved separately</li>
					</ul>
				</div>
				<div class="p-scope-col">
					<h3 class="p-h4">Good to know</h3>
					<ul class="p-list">
						<li>Implementation depends on access to the relevant codebase and environments.</li>
						<li>The schedule begins once the initial payment, access and kickoff are complete.</li>
						<li>Delays in required feedback or access may shift the timeline.</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="p-sec p-proof" id="work" aria-labelledby="proof-title" data-dark>
		<div class="p-wrap p-proof-in">
			<header class="p-proof-head">
				<h2 class="p-h2 p-proof-title" id="proof-title">Why work with me?</h2>
				<p class="p-proof-lede">Draws, funding and applications only work when people trust the numbers in front of them. I&rsquo;ve designed for that moment across credit cards, payment plans and debt negotiation, from research to shipped product.</p>
			</header>
			<ul class="p-deck" data-deck>
				<?php foreach ( $sera_proof as $sera_c ) : ?>
					<li class="p-card">
						<div class="p-card-cover" aria-hidden="true" inert><?php echo function_exists( 'sera_render_mockup' ) ? sera_render_mockup( $sera_c['mockup'] ) : ''; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
						<div class="p-card-body">
							<p class="p-card-co"><?php echo esc_html( $sera_c['brand'] ); ?></p>
							<h3 class="p-card-title"><a class="p-card-link" href="<?php echo esc_url( home_url( '/' . $sera_c['slug'] . '/' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php echo $sera_c['title']; // phpcs:ignore WordPress.Security.EscapeOutput -- fixed copy above. ?><span class="screen-reader-text"> Read the <?php echo esc_html( $sera_c['brand'] ); ?> case study (opens in a new tab)</span></a></h3>
							<p class="p-card-text"><?php echo $sera_c['text']; // phpcs:ignore WordPress.Security.EscapeOutput -- fixed copy above. ?></p>
							<p class="p-card-read" aria-hidden="true">Read the case <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 11L11 5M6 5h5v5"/></svg></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="p-sec p-accept" id="accept" aria-labelledby="accept-title">
		<div class="p-wrap p-accept-grid">
			<div class="p-accept-copy">
				<h2 class="p-h2" id="accept-title">Let&rsquo;s build the next version of Evanly?</h2>
				<p>If this approach feels right, confirm your acceptance below. If you&rsquo;d rather discuss the scope or investment first, we can do that too.</p>
				<h3 class="p-label">After you accept</h3>
				<ol class="p-next">
					<li>I confirm the kickoff with you.</li>
					<li>I send payment instructions for the first 50%.</li>
					<li>I share the initial access checklist.</li>
				</ol>
				<?php if ( $sera_until ) : ?>
					<p class="p-valid<?php echo $expired ? ' is-over' : ''; ?>"><?php echo $expired ? 'This proposal was valid until ' . esc_html( $sera_until ) . '. Send me a message and I&rsquo;ll prepare an updated one.' : 'This commercial proposal is valid for ' . (int) $p['validDays'] . ' days, until ' . esc_html( $sera_until ) . '. After that, price and availability may change.'; ?></p>
				<?php endif; ?>
				<p class="p-fine">Accepting doesn&rsquo;t charge anything. It records your confirmation of this proposal (version <?php echo esc_html( $p['version'] ); ?>); it isn&rsquo;t a digital signature.</p>
			</div>

			<div class="p-accept-box">
				<div class="p-done<?php echo $accepted ? ' is-on' : ''; ?>" data-done tabindex="-1"<?php echo $accepted ? '' : ' hidden'; ?>>
					<span class="p-done-mark" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></span>
					<p class="p-done-title" role="status">Thank you, <?php echo esc_html( $sera_first ); ?>. Your acceptance has been recorded.</p>
					<p>I&rsquo;ll be in touch to confirm the kickoff and payment details.</p>
					<?php if ( $accepted ) : ?>
						<p class="p-fine">Accepted on <?php echo esc_html( gmdate( 'j F Y, H:i', strtotime( (string) get_post_meta( $accepted->ID, 'createdAtUtc', true ) ) ) ); ?> UTC · version <?php echo esc_html( (string) get_post_meta( $accepted->ID, 'version', true ) ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( ! $accepted && ! $expired ) : ?>
				<form class="p-form" method="post" action="<?php echo esc_url( $url ); ?>#accept" data-prop-form="accept" novalidate>
					<input type="hidden" name="sera_action" value="accept">
					<input type="hidden" name="token" value="<?php echo esc_attr( $csrf ); ?>">
					<input type="hidden" name="version" value="<?php echo esc_attr( $p['version'] ); ?>">
					<p class="p-form-err" role="alert" data-err><?php echo esc_html( $sera_err_a ); ?></p>
					<div class="p-field">
						<label for="acc-name">Full name</label>
						<input id="acc-name" name="name" type="text" autocomplete="name" maxlength="120" required value="<?php echo esc_attr( $p['contact']['name'] ); ?>"<?php echo 'e-name' === $flag ? ' aria-invalid="true"' : ''; ?>>
					</div>
					<div class="p-field">
						<label for="acc-email">Work email</label>
						<input id="acc-email" name="email" type="email" autocomplete="email" maxlength="190" required value="<?php echo esc_attr( $p['contact']['email'] ); ?>"<?php echo 'e-email' === $flag ? ' aria-invalid="true"' : ''; ?>>
					</div>
					<div class="p-check">
						<input id="acc-confirm" name="confirm" type="checkbox" value="1" required<?php echo 'e-confirm' === $flag ? ' aria-invalid="true"' : ''; ?>>
						<label for="acc-confirm">I confirm that I&rsquo;m authorised to accept this proposal on behalf of <?php echo esc_html( $p['client'] ); ?>, including the <?php echo esc_html( $sera_price ); ?> USD investment, payment terms and agreed-scope approach described above.</label>
					</div>
					<div class="p-actions">
						<button class="p-btn p-btn-ink p-btn-lg" type="submit"><span class="p-btn-label">Accept proposal</span></button>
						<a class="p-btn p-btn-line p-btn-lg" href="#questions" data-open-questions aria-controls="questions">I have questions</a>
					</div>
				</form>
				<?php endif; ?>

				<div class="p-questions<?php echo $accepted ? ' is-after' : ''; ?>" id="questions" data-questions tabindex="-1">
					<h3 class="p-h4">What would you like to discuss?</h3>
					<?php if ( $accepted ) : ?>
						<p class="p-fine">Questions are still welcome after accepting.</p>
					<?php endif; ?>
					<p class="p-q-ok<?php echo 'asked' === $flag ? ' is-on' : ''; ?>" role="status" data-q-ok><?php echo 'asked' === $flag ? 'Your message has been received. I&rsquo;ll get back to you shortly.' : ''; ?></p>
					<form class="p-form" method="post" action="<?php echo esc_url( $url ); ?>#questions" data-prop-form="question" novalidate>
						<input type="hidden" name="sera_action" value="question">
						<input type="hidden" name="token" value="<?php echo esc_attr( $csrf ); ?>">
						<p class="p-form-err" role="alert" data-err><?php echo esc_html( $sera_err_q ); ?></p>
						<div class="p-field">
							<label for="q-email">Your email</label>
							<input id="q-email" name="email" type="email" autocomplete="email" maxlength="190" required value="<?php echo esc_attr( $p['contact']['email'] ); ?>"<?php echo 'e-q-email' === $flag ? ' aria-invalid="true"' : ''; ?>>
						</div>
						<div class="p-field">
							<label for="q-msg">Your message</label>
							<textarea id="q-msg" name="message" rows="5" maxlength="4000" required<?php echo in_array( $flag, array( 'e-q-message', 'e-q-long' ), true ) ? ' aria-invalid="true"' : ''; ?>></textarea>
						</div>
						<div class="p-actions">
							<button class="p-btn p-btn-ink" type="submit"><span class="p-btn-label">Send message</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<section class="p-sec p-faq" id="faq" aria-labelledby="faq-title">
		<div class="p-wrap p-faq-grid">
			<header class="p-faq-head">
				<h2 class="p-h2" id="faq-title">Questions, answered.</h2>
				<p>The practical details, in one place. Anything else, send it through the form above and I&rsquo;ll reply.</p>
			</header>
			<div class="p-faq-list">
				<?php foreach ( $sera_faq as $sera_i => $sera_q ) : ?>
					<details class="p-faq-item"<?php echo 0 === $sera_i ? ' open' : ''; ?>>
						<summary><span class="p-faq-q"><?php echo esc_html( $sera_q[0] ); ?></span><span class="p-faq-ico" aria-hidden="true"></span></summary>
						<div class="p-faq-a"><p><?php echo $sera_q[1]; // phpcs:ignore WordPress.Security.EscapeOutput -- fixed copy built above. ?></p></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

</main>

<footer class="p-foot">
	<div class="p-wrap p-foot-row">
		<p>Prepared by Matheus Serafim for <?php echo esc_html( $p['client'] ); ?>. Proposal <?php echo esc_html( $p['id'] ); ?>, version <?php echo esc_html( $p['version'] ); ?>. A commercial offer, not a substitute for a contract where one is needed.</p>
		<form method="post" action="<?php echo esc_url( $url ); ?>">
			<input type="hidden" name="sera_action" value="leave">
			<input type="hidden" name="token" value="<?php echo esc_attr( $csrf ); ?>">
			<button class="p-link" type="submit">Close proposal on this device</button>
		</form>
	</div>
</footer>
</body>
</html>
