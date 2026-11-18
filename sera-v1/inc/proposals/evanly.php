<?php
/**
 * Proposal data: Evanly · Product Foundation Sprint.
 *
 * Canonical commercial terms live here, on the server. The browser never sends prices or terms:
 * an acceptance stores a snapshot of this array (and its hash) as the record of what was accepted.
 * Any change to price, payment terms or scope wording needs a new 'version' so earlier
 * acceptances keep pointing to the terms they actually saw.
 *
 * The access code is NOT here. It is set in wp-admin (Ferramentas › Propostas) or in wp-config.php.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

return array(
	'id'       => 'evanly-foundation-sprint',
	'version'  => '1',
	'slugs'    => array( 'evenly', 'evanly' ), // /comercial/evenly was requested; /comercial/evanly is an alias.
	'client'   => 'Evanly',
	'contact'  => array(
		'first' => 'Alex',
		'name'  => 'Alex Hutchinson',
		'email' => 'alex@evanly.app', // Prefilled only after the access code is accepted.
	),
	'terms'    => array(
		'offer'                     => 'Product Foundation Sprint',
		'currency'                  => 'USD',
		'amountCents'               => 129900,
		'depositCents'              => 64950,
		'finalPaymentCents'         => 64950,
		'additionalHourlyRateCents' => 7500,
		'duration'                  => 'Two weeks (up to ten business days), starting after acceptance, the initial payment, access and kickoff.',
		'payment'                   => '50% before the sprint starts, 50% on delivery. No automatic charge: payment instructions are sent after acceptance.',
		'additionalWork'            => 'Optional work beyond the agreed scope is billed at USD 75 per hour, only with prior approval.',
		'scope'                     => 'Three stages (Product & Competitive Assessment; Design & Brand Foundations; Product Refinement & Implementation). Priorities and implementation scope are agreed at kickoff. Starter foundation only: not a complete rebrand, full product redesign or exhaustive component library.',
	),
);
