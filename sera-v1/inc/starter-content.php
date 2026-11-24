<?php
/**
 * Case library + importer.
 *
 * The case studies ship with the theme as block content: narrative in core
 * blocks (editable), visuals in the "sera/artifact" and "sera/mockup" blocks.
 * Appearance › Sera · Cases creates or updates each one as a Page in the
 * "portfolio" category, with its own URL, so it shows up on the home.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/* ------------------------------------------------------------ block helpers */

function sera_b_p( $html, $class = '' ) {
	if ( $class ) {
		return '<!-- wp:paragraph {"className":"' . $class . '"} -->' . "\n" . '<p class="' . $class . '">' . $html . "</p>\n<!-- /wp:paragraph -->\n\n";
	}
	return "<!-- wp:paragraph -->\n<p>" . $html . "</p>\n<!-- /wp:paragraph -->\n\n";
}
function sera_b_kicker( $text ) {
	return sera_b_p( $text, 'kicker' );
}
function sera_b_h2( $text ) {
	return '<!-- wp:heading {"className":"chapter"} -->' . "\n" . '<h2 class="wp-block-heading chapter">' . $text . "</h2>\n<!-- /wp:heading -->\n\n";
}
function sera_b_art( $name ) {
	return '<!-- wp:sera/artifact {"name":"' . $name . '"} /-->' . "\n\n";
}
function sera_b_mock( $slug ) {
	return '<!-- wp:sera/mockup {"mockup":"' . $slug . '","align":"wide"} /-->' . "\n\n";
}
function sera_b_chapter( $n, $label, $title ) {
	return sera_b_kicker( sprintf( '%02d · %s', $n, $label ) ) . sera_b_h2( $title );
}

/* ------------------------------------------------------------- the library */

function sera_starter_cases() {
	$cases = array();

	/* ---------------------------------------------------- 1. Combina Antes */
	$c  = sera_b_art( 'pg-glance' );
	$c .= sera_b_chapter( 1, 'The problem', 'Late fees looked like revenue. Much of that money never arrived.' );
	$c .= sera_b_p( 'In buy-now-pay-later, a missed instalment triggers a late fee, and on a spreadsheet late fees look like income. The data showed that a big share of those fees is never collected, and that the instalments left unpaid cost more than all the late fees bring in.', 'lead' );
	$c .= sera_b_p( 'And one late payment tends to bring the next.' );
	$c .= sera_b_art( 'pg-stats' );
	$c .= sera_b_chapter( 2, 'The customer side', 'Customers knew they’d be late. The app found out afterwards.' );
	$c .= sera_b_p( 'Customers usually know days in advance that a payment won’t work out. The only way out, renegotiation, was built for people already in collections: it only opens after the delay, asks for a down payment and has a minimum amount that many customers with one overdue instalment don’t reach. It strained the relationship right when customers needed help, and late fees were among the most common complaints in app reviews.' );
	$c .= sera_b_art( 'pg-gap' );
	$c .= sera_b_p( 'Time was the main design constraint. Every extra week of delay makes the money much harder to get back. So the agreement is short on purpose: a few days, and never past the day an instalment is reported to the credit bureau.' );
	$c .= sera_b_art( 'pg-window' );
	$c .= sera_b_chapter( 3, 'The idea', 'Let customers agree on a new date before the due date.' );
	$c .= sera_b_p( 'Our squad picked this idea in the 2026 hackathon. My job was to turn it into something that works for the customer, for credit and for the P&amp;L at the same time. The product itself had to stay very simple: a heads-up, a new date and the payment.' );
	$c .= sera_b_art( 'pg-steps' );
	$c .= sera_b_mock( 'pagaleve-flow' );
	$c .= sera_b_p( 'I designed every screen so that <strong>the customer is never surprised by a number or a rule</strong>.' );
	$c .= sera_b_art( 'pg-decisions' );
	$c .= sera_b_chapter( 4, 'The hard part', 'Showing the offer to everyone would eat into late fees.' );
	$c .= sera_b_p( 'Leadership raised a fair objection: if everyone gets the button, everyone clicks, including people who would have paid one day late anyway. We accepted it and built the design around it.' );
	$c .= sera_b_art( 'pg-economics' );
	$c .= sera_b_chapter( 5, 'The system', 'AI decides who sees the offer. Credit decides who gets it.' );
	$c .= sera_b_p( 'The squad’s engineer was worried, fairly, that we were taking on too much for an MVP and stepping on the Risk team’s turf. So I drew a clear line. The orchestrator only decides <strong>who sees the button and who gets a heads-up</strong>. The credit engine decides, at the click, whether someone can postpone, for how long and at what price. That line is what got the idea built, and it’s the part of this case I’m proudest of.' );
	$c .= sera_b_art( 'pg-orchestrator' );
	$c .= sera_b_p( 'We were asked whether this needed AI at all. It does, for a narrow job: the agents decide who sees the offer, write down why and re-tune the rule against the control group every week. The rule itself is simple and auditable on purpose. At the click, the orchestrator steps aside and the credit engine takes over, and every path ends somewhere the customer already knows. If credit says no, the app says “offer not available at the moment”. If the agreement isn’t honoured, the original due date takes over. A predictive model that reaches customers before their first overdue instalment is left for later, and it would also need an approved proposal first.' );
	$c .= sera_b_art( 'pg-paths' );
	$c .= sera_b_chapter( 6, 'The outcome', 'From pitch to pilot to production.' );
	$c .= sera_b_p( 'Before the pitch, the squad tested demand with a fake-door email. A sample of customers with an instalment coming up received a message offering to pick a new due date, and the button led to a short form instead of a product. It tested whether people would reach for the offer before the due date, with no late fee pushing them. Enough of them did to show the demand was real, so the conversation with leadership started from what customers had done.' );
	$c .= sera_b_p( 'We pitched it to leadership as a pilot: a small share of the base, a control group in every audience and a few weeks to replace our estimates with measured numbers. The idea was then implemented, and it is live in production today. I stayed on the product through implementation and owned the flow until it shipped.' );
	$c .= sera_b_art( 'pg-pilot' );
	$c .= sera_b_art( 'pg-impact' );
	$c .= sera_b_chapter( 7, 'Why it matters', 'I turned leadership’s objection into the product’s rule.' );
	$c .= sera_b_art( 'pg-reflection' );
	$c .= sera_b_art( 'pg-signals' );

	$cases[] = array(
		'slug'    => 'combina-antes',
		'title'   => 'Combina Antes: the feature that threatened late-fee revenue',
		'order'   => 1,
		'excerpt' => 'A hackathon idea that is now live in production: customers agree on a new due date before they fall behind. I designed the flow and drew the line that got it approved: AI decides who sees the offer, credit decides who gets it. Leadership’s objection was that the offer would eat into late-fee revenue, so we built the product around that objection.',
		'meta'    => array(
			'_sera_headline' => 'Combina Antes: leadership feared it would eat late-fee revenue, so that fear became the product’s rule',
			'_sera_company'  => 'Pagaleve',
			'_sera_year'     => '2026',
			'_sera_role'     => 'Specialist Product Designer, hackathon squad',
			'_sera_metrics'  => "0→1 | From hackathon idea to a shipped product\n2 AI agents | Pick who sees the offer and re-tune weekly vs. control\nLive | Implemented after the leadership pitch",
			'_sera_chips'    => 'BNPL, AI orchestration, Credit & collections',
			'_sera_visual'   => 'pagaleve',
		),
		'content' => $c,
	);

	/* --------------------------------------------------- 2. Western Union */
	$c  = sera_b_art( 'wu-glance' );
	$c .= sera_b_chapter( 1, 'Context', 'Most people came for money that was already waiting.' );
	$c .= sera_b_p( 'Western Union’s digital account in Brazil serves immigrants and their families: Pix, bills and essential banking. The typical customer already has money waiting and needs to cash it out urgently, before they even have an account.', 'lead' );
	$c .= sera_b_p( 'The key metric was the OKR itself: the share of people who finish onboarding, from KYC (the identity check, “know your customer”) to an open account. The bottleneck was just as clear: <strong>the documents people sent were being rejected</strong>. Every customer we lost at that step had already decided to open an account.' );
	$c .= sera_b_chapter( 2, 'Constraints', 'No budget, no vendor, a small team, and Compliance on every step.' );
	$c .= sera_b_art( 'wu-constraints' );
	$c .= sera_b_chapter( 3, 'The thesis', 'Get the document through on the first try.' );
	$c .= sera_b_p( 'Too many customers needed more than one attempt to get a document through. Rather than guess, I cross-checked three sources we already had access to.' );
	$c .= sera_b_art( 'wu-triangle' );
	$c .= sera_b_p( 'The stores gave us the customers’ own words. Customers go there when something breaks, and the staff hear the same sentences every day.' );
	$c .= sera_b_art( 'wu-voices' );
	$c .= sera_b_chapter( 4, 'The audit', 'I sorted the rejected photos by reason.' );
	$c .= sera_b_p( 'I asked for the batch of rejected documents and sorted them by reason. One mistake explained most of them.' );
	$c .= sera_b_art( 'wu-audit' );
	$c .= sera_b_p( 'The error screen customers saw made it worse. It only appeared after a photo had already been rejected, and it pointed at the plastic sleeve and legibility, never at the back of the document. The product was explaining a problem most people didn’t have.' );
	$c .= sera_b_art( 'wu-error-screen' );
	$c .= sera_b_art( 'wu-statement' );
	$c .= sera_b_p( 'Success meant three things: more correct front and back submissions, fewer rejections from simple mistakes, and higher conversion without raising fraud risk.' );
	$c .= sera_b_chapter( 5, 'The redesign', 'I split the document step in two and made the back look different.' );
	$c .= sera_b_p( 'The old flow asked for “a photo of the front and one of the back” on a single screen. It was the fifth of five steps, with a dense “important” box that was easy to skip. The new flow asks for the front and the back separately, gives each its own instructions and puts the back on a different background.' );
	$c .= sera_b_mock( 'wu-before-after' );
	$c .= sera_b_p( 'Smaller decisions around it cleared up what was still ambiguous and removed steps that only slowed people down.' );
	$c .= sera_b_mock( 'wu-solutions' );
	$c .= sera_b_art( 'wu-solutions' );
	$c .= sera_b_p( 'Each of these decisions answers one of the causes the audit found, and all of them were judged against the same three criteria.' );
	$c .= sera_b_art( 'wu-diagnosis' );
	$c .= sera_b_p( 'The fifth decision shortened the funnel. Most customers came to receive money, yet the path to an account also asked for their occupation, estimated income, source of funds and a second set of document data, all of it required only for sending money abroad. With Compliance and LATAM leadership, we moved that data behind a “complete now or later” choice, so it stopped blocking the account.' );
	$c .= sera_b_art( 'wu-journey' );
	$c .= sera_b_chapter( 6, 'Testing', 'We tested the prototypes with customers in the stores.' );
	$c .= sera_b_art( 'wu-testing' );
	$c .= sera_b_chapter( 7, 'Delivery', 'The first release made things worse. The second set a record.' );
	$c .= sera_b_p( 'Onboarding conversion fell sharply after the first release. I treated it as an incident: we found the causes quickly, fixed them and shipped again.' );
	$c .= sera_b_art( 'wu-release' );
	$c .= sera_b_chapter( 8, 'Impact', 'A double-digit gain in conversion, and a record month.' );
	$c .= sera_b_art( 'wu-impact' );
	$c .= sera_b_p( 'With those results, the company approved budget for an identity-verification vendor to improve authentication.' );
	$c .= sera_b_chapter( 9, 'Looking back', 'What I’d keep, and what I’d change.' );
	$c .= sera_b_art( 'wu-reflection' );
	$c .= sera_b_chapter( 10, 'Why it matters', 'No budget and no vendor. I got the result first and the budget after.' );
	$c .= sera_b_art( 'wu-signals' );

	$cases[] = array(
		'slug'    => 'western-union-onboarding',
		'title'   => 'Western Union: people sent the front of their ID twice',
		'order'   => 4,
		'excerpt' => 'Onboarding conversion reached an all-time record, with a double-digit gain, and the results got a vendor budget approved. I was both the designer and the PO, with no research budget, no OCR vendor, a small engineering team and Compliance reviewing every change. An audit of rejected documents showed people were sending the front of their ID twice. The first release made conversion worse. I treated it as an incident, and the second one set the record.',
		'meta'    => array(
			'_sera_headline' => 'Western Union: the onboarding redesign that first lowered conversion, then took it to a record',
			'_sera_company'  => 'Western Union',
			'_sera_year'     => '2025–26',
			'_sera_role'     => 'Specialist Product Designer, acting as Designer + PO',
			'_sera_metrics'  => "Double-digit | Onboarding conversion lift, up to an all-time record\nFewer | Document upload retries, much closer to one attempt\n~2 min | Cut from the funnel by moving steps post-onboarding",
			'_sera_chips'    => 'Onboarding, Scrappy research, Compliance',
			'_sera_visual'   => 'western-union',
		),
		'content' => $c,
	);

	/* -------------------------------------------------------- 3. will bank */
	$c  = sera_b_art( 'wb-glance' );
	$c .= sera_b_chapter( 1, 'Context', 'Our credit card ran on someone else’s processor.' );
	$c .= sera_b_p( 'will bank used an outsourced processor to orchestrate every credit card operation. That got the bank to market quickly, but it also made basic tasks unstable and kept our transaction approval rate below the main competitors’.', 'lead' );
	$c .= sera_b_art( 'wb-stakes' );
	$c .= sera_b_p( 'Replacing the whole processor was too big a job, so the team decided to bring in-house the part that caused the most problems, the authorizer. On paper, it was an infrastructure project with nothing for customers to see.' );
	$c .= sera_b_art( 'wb-statement' );
	$c .= sera_b_p( 'Beyond approval rates, the team saw the authorizer as a chance to make customers happier and the card more competitive. To find out how, the work ran in six stages, each adding a point of view before anything reached the backlog.' );
	$c .= sera_b_art( 'wb-process' );
	$c .= sera_b_chapter( 2, 'Discovery', 'I read the support tickets first, then interviewed customers.' );
	$c .= sera_b_p( 'I used an LLM to classify chat transcripts by cause and measure what the old brain was costing us in operations. Then I interviewed customers who had opened chats, to understand what those tickets meant in their lives.' );
	$c .= sera_b_art( 'wb-quotes' );
	$c .= sera_b_art( 'wb-pains' );
	$c .= sera_b_p( 'For customers who budget down to the last cent, <strong>a bill that changes after they set the money aside is a reason to stop using the card</strong>.' );
	$c .= sera_b_p( 'In the interviews, customers described the bill as their budget, and not only this month’s. They look at paid bills to see what they spent, check the open one to set money aside and count the instalments for the coming months before buying again. Customers think about the bill over time, and our card only showed the present.' );
	$c .= sera_b_p( 'Worse, even the present wasn’t reliable. Purchases still being processed weren’t added to the open bill, and instalments from earlier months only appeared after the bill had opened.' );
	$c .= sera_b_art( 'wb-bill-model' );
	$c .= sera_b_chapter( 3, 'Market and ideas', 'We compared our card with what the market already offers.' );
	$c .= sera_b_p( 'With Mastercard, we mapped what every card in Brazil is expected to do, and looked for what ours was missing.' );
	$c .= sera_b_art( 'wb-framework' );
	$c .= sera_b_p( 'The workshop gave us a direction we called Temporal Control: customers needed to see the past, the present and the future of their bill, and act on them. The order became clear there too. No one plans the coming months on a bill that keeps changing, so the present came first.' );
	$c .= sera_b_art( 'wb-next' );
	$c .= sera_b_chapter( 4, 'The present', 'First, an open bill people could trust.' );
	$c .= sera_b_p( 'I built low-fidelity prototypes to refine the solution with engineering, since everything depended on what the new authorizer could do. The high-fidelity versions went to usability tests with customers, to reduce implementation risk before anything was built.' );
	$c .= sera_b_mock( 'will-bank-detail' );
	$c .= sera_b_art( 'wb-before-after' );
	$c .= sera_b_p( 'The second feature came straight out of Mastercard’s “Impeccable Basics”. Not every card in Brazil opens the bill with every instalment from previous months already included, so closing our own gap also gave us a point of difference.' );
	$c .= sera_b_chapter( 5, 'Past and future', 'Then, the rest of the bill’s timeline.' );
	$c .= sera_b_p( 'With the authorizer in-house, the bank knew in real time what fell on each bill, including the ones that hadn’t opened yet. That made the rest of Temporal Control possible, on three fronts I designed with the team.', 'lead' );
	$c .= sera_b_p( '<strong>Bills over time.</strong> A timeline of months opens the bills area. Paid bills sit in the background, the open one stands out and the upcoming ones follow, each with its amount so far. Tapping a month shows what’s in it, including instalments still to come. People who used a spreadsheet to plan could now see the coming months in the app.' );
	$c .= sera_b_mock( 'will-bank-bills' );
	$c .= sera_b_p( '<strong>Paying instalments early, with a discount.</strong> It was one of the five pains from the research. From an upcoming bill, people pick which future instalments to pay now, and the further away the instalment, the bigger the interest discount. Before confirming, they see how much they save and which bill the amount goes to. Paying by Pix frees the limit at once, because authorisation is now ours.' );
	$c .= sera_b_mock( 'will-bank-advance' );
	$c .= sera_b_p( '<strong>Planning before buying.</strong> The last front looks at the next purchase. The simulation shows how each future bill looks with the new purchase, and the calendar explains the bill cycle without jargon: when it closes, the best day to buy and when it’s due. When changing the due date, each day already shows the new best day to buy.' );
	$c .= sera_b_mock( 'will-bank-plan' );
	$c .= sera_b_p( 'At the time, not every bank in Brazil gave people this control in the app. Complete future bills, early payment with a discount in a few taps and a limit freed on the spot became points of difference for our card, all from a project that started as infrastructure.' );
	$c .= sera_b_art( 'wb-lessons' );
	$c .= sera_b_chapter( 6, 'Impact', 'Measured against a control group.' );
	$c .= sera_b_p( 'Everything shipped in a controlled rollout, with a test group compared against a control group. I also worked with other teams so they could use the new authorizer in their own products.' );
	$c .= sera_b_art( 'wb-impact' );
	$c .= sera_b_chapter( 7, 'Why it matters', 'I found a product inside an infrastructure project.' );
	$c .= sera_b_art( 'wb-reflection' );
	$c .= sera_b_art( 'wb-signals' );

	$cases[] = array(
		'slug'    => 'will-bank-switching-the-brain',
		'title'   => 'will bank: an infrastructure project that became a product',
		'order'   => 5,
		'excerpt' => 'A back-end migration with nothing for customers to see ended up shipping four things they use: a real-time open bill, past and future bills in the app, early payment of instalments with a discount and planning before buying. In a controlled rollout, CSAT and NPS were higher and support contacts lower in the test group. As Staff Product Designer on the credit card, I read the support tickets, interviewed customers and found that they plan their lives around the bill, which the old setup didn’t let them do.',
		'meta'    => array(
			'_sera_headline' => 'Switching the brain: the migration that wasn’t meant to change anything for customers, and changed their bill',
			'_sera_company'  => 'will bank',
			'_sera_year'     => '2023',
			'_sera_role'     => 'Staff Product Designer, Credit Card',
			'_sera_metrics'  => "A/B | Rolled out against a control group\nCSAT & NPS ↑ | Higher in the test group than in control\nContacts ↓ | Fewer tickets in the test group",
			'_sera_chips'    => 'Credit card, Product strategy, Temporal Control',
			'_sera_visual'   => 'will-bank',
		),
		'content' => $c,
	);

	/* ---------------------------------------------- Fatal Model · PerfisAD */
	$c  = sera_b_art( 'fm-glance' );
	$c .= sera_b_chapter( 1, 'The question', 'A commercial brief about advertisers we barely knew.' );
	$c .= sera_b_p( 'At Atlas Technologies, the company behind Fatal Model, I worked in the tribe that serves the advertisers (ADs): independent escorts who pay for plans to be seen on the platform. The brief was commercial: understand our advertisers well enough to find ways to make the site more profitable.', 'lead' );
	$c .= sera_b_p( 'The people behind that revenue were almost invisible inside the company. We knew them as plans, points and rankings. So from the first day, I gave the study a second goal: <strong>humanise these users</strong>. Hear them as people, in their own words, before deciding anything about the business.' );
	$c .= sera_b_art( 'fm-chair' );
	$c .= sera_b_chapter( 2, 'The cut', 'Four profiles that carry most of the platform.' );
	$c .= sera_b_p( 'First we had to decide who to hear. With data science, we segmented the active advertisers with an RFM model, from those who always buy plans to those who never bought one.' );
	$c .= sera_b_art( 'fm-rfm' );
	$c .= sera_b_chapter( 3, 'The method', 'Interviews that fit the lives of the people we wanted to hear.' );
	$c .= sera_b_p( 'Live interviews would have been slow, and a bad fit for people who value discretion, work irregular hours and often have a second job. So I designed an asynchronous flow: the team recorded the questions on video, and each advertiser answered by video, audio or text, when and where they felt comfortable.' );
	$c .= sera_b_mock( 'fm-method' );
	$c .= sera_b_p( 'The answers then went through a pipeline: speech to text, an AI pass to group similar answers, a survey to test the patterns at scale, and clusters that compared what people said with what they did.' );
	$c .= sera_b_art( 'fm-pipeline' );
	$c .= sera_b_chapter( 4, 'The profiles', 'Four ways of living the same profession.' );
	$c .= sera_b_p( 'Each profile came with its sub-groups, routines, goals and pains, described through the people in it. Veterans and Loyal advertisers keep the platform running. Jugglers and Improvisers are where it can grow, if it earns their trust.' );
	$c .= sera_b_art( 'fm-profiles' );
	$c .= sera_b_p( 'One simple question told us a lot. When we asked people to walk us through a normal day, from waking up to going to sleep, each profile described a different one: work that swallows mealtimes, work with its own slot, work squeezed between another job, or long hours waiting for a client.' );
	$c .= sera_b_art( 'fm-day' );
	$c .= sera_b_art( 'fm-voices' );
	$c .= sera_b_p( 'Some findings we could check against platform data. Veterans complained the most about unclear warnings and bans, and the numbers matched.' );
	$c .= sera_b_art( 'fm-warnings' );
	$c .= sera_b_p( 'Plans and the ranking are what advertisers pay for, so this is where the commercial brief met their experience. No two profiles understood them the same way. Understanding fell from Veterans to Improvisers, and so did buying. Those who bought without understanding felt they had paid for nothing.' );
	$c .= sera_b_art( 'fm-plans' );
	$c .= sera_b_chapter( 5, 'Beyond the brief', 'The vulnerabilities behind every profile.' );
	$c .= sera_b_p( 'The study was about profitability, but the only pattern shared by all four profiles had nothing to do with plans. Advertisers in every profile described toxic clients, scams, limits that were not respected and a constant fear of violence. I chose to close the revenue readout with this finding, and gave safety the same weight as the commercial ones.' );
	$c .= sera_b_art( 'fm-common' );
	$c .= sera_b_chapter( 6, 'Impact', 'The readout shaped the next OKRs and a reorganisation.' );
	$c .= sera_b_p( 'I presented the study to the company as four named profiles, each told through the people in it. The readout became the base for the next planning cycle’s <strong>OKRs and an internal reorganisation around advertisers</strong>, with safety, clarity and fairness weighing as much as revenue.' );
	$c .= sera_b_art( 'fm-impact' );
	$c .= sera_b_p( 'Each opportunity area traces back to something advertisers asked for. The requests we couldn’t act on yet stayed in the readout as open questions.' );
	$c .= sera_b_art( 'fm-asks' );
	$c .= sera_b_art( 'fm-next' );
	$c .= sera_b_chapter( 7, 'Why it matters', 'I answered the commercial question, and the one nobody had asked.' );
	$c .= sera_b_art( 'fm-reflection' );
	$c .= sera_b_art( 'fm-signals' );

	$cases[] = array(
		'slug'    => 'fatal-model-perfis-ad',
		'title'   => 'Fatal Model: a revenue study that ended on safety',
		'order'   => 7,
		'excerpt' => 'The study became the base for the next planning cycle’s OKRs and for a reorganisation at Atlas Technologies around advertisers. I led the research: an asynchronous, AI-assisted flow that heard independent escorts by video and checked the patterns with a survey. The brief was to grow revenue. The only pattern shared by every profile was about safety, so I gave it the same weight as the commercial findings.',
		'meta'    => array(
			'_sera_headline' => 'Fatal Model: I was asked how to grow revenue, and closed the readout talking about safety',
			'_sera_company'  => 'Atlas Technologies',
			'_sera_year'     => '2024',
			'_sera_role'     => 'Staff Product Designer, research lead',
			'_sera_metrics'  => "Async | Video interviews, answered on each person’s own time\n4 profiles | Each with routines, goals and pains\nNew OKRs | A restructuring to serve advertisers better",
			'_sera_chips'    => 'Mixed-methods research, AI-assisted synthesis, Segmentation',
			'_sera_visual'   => 'fatal-model',
		),
		'content' => $c,
	);

	/* ----------------------------------------------------- 4. Acordo Certo */
	$c  = sera_b_art( 'ac-glance' );
	$c .= sera_b_chapter( 1, 'The problem', 'The homepage of a debt-negotiation platform didn’t feel safe.' );
	$c .= sera_b_p( 'Acordo Certo helps Brazilians negotiate their debts online, without hours on the phone. It’s free for the person in debt: the company earns a percentage of each agreement closed on the platform. The homepage and landing pages were the first contact with the product, and they had four problems at once.', 'lead' );
	$c .= sera_b_art( 'ac-obstacles' );
	$c .= sera_b_mock( 'ac-before-after' );
	$c .= sera_b_chapter( 2, 'The team', 'Two designers: I set the direction, Carolina gave it shape.' );
	$c .= sera_b_p( 'At Acordo Certo, the design team was Carolina and me. I led the strategy, the research, the vision workshop and the overall direction: what to learn first, how to learn it, who to bring into the room and how the pieces would come together. Carolina, the junior product designer on my team, worked with me throughout and turned that direction into UI. We did discovery side by side.' );
	$c .= sera_b_art( 'ac-duo' );
	$c .= sera_b_p( 'Redesigning the page first would have meant guessing. So I set the order of the work: <strong>understand the customer, build a product vision with the company, and only then design the layout</strong>.' );
	$c .= sera_b_art( 'ac-sequence' );
	$c .= sera_b_chapter( 3, 'Discovery', 'Interviews about why people negotiate a debt, and what comes after.' );
	$c .= sera_b_p( 'I adapted the Jobs-to-be-Done interview to our context, in five stages that follow the customer from the first thought about the debt to life after paying it. We interviewed two groups who had closed a deal: satisfied customers and dissatisfied ones.' );
	$c .= sera_b_art( 'ac-jtbd' );
	$c .= sera_b_p( 'The stages on either side of the deal mattered most. Before it, we asked when people first started noticing the options they had to clear their name. After it, what they liked most, what they liked least, and whether they could now do something they couldn’t before. The answers were rarely about the debt itself.' );
	$c .= sera_b_art( 'ac-voices' );
	$c .= sera_b_art( 'ac-findings' );
	$c .= sera_b_p( 'I then sorted the findings by the stages a customer goes through. Each stage had its own fear, and the page had to answer it before the next step could feel safe.' );
	$c .= sera_b_art( 'ac-journey' );
	$c .= sera_b_chapter( 4, 'Archetypes', 'Three archetypes, built from what people told us.' );
	$c .= sera_b_p( 'The labels we had, promoter and detractor, debtor and payer, didn’t explain how people behaved. The interviews did, so we turned what we heard into three archetypes and a storyboard that the whole company could use to talk about the customer.' );
	$c .= sera_b_art( 'ac-personas' );
	$c .= sera_b_chapter( 5, 'Vision', 'A product vision written together with the company.' );
	$c .= sera_b_p( 'With the archetypes in hand, I ran a product vision workshop with key people from the company. The prompt was a time machine: read tomorrow’s newspaper article about our product, and tell us what it says.' );
	$c .= sera_b_art( 'ac-vision' );
	$c .= sera_b_chapter( 6, 'The homepage', 'Four pillars, decided together.' );
	$c .= sera_b_p( 'For the homepage we followed the Double Diamond, and brought Marketing, Customer Service, CRO and tribe leads into the brainstorm. They knew the pains of the old page better than anyone, and after helping shape the new one, they defended it.' );
	$c .= sera_b_art( 'ac-process' );
	$c .= sera_b_art( 'ac-pillars' );
	$c .= sera_b_chapter( 7, 'Testing', 'A handful of users, three decisions that changed the page.' );
	$c .= sera_b_art( 'ac-testing' );
	$c .= sera_b_chapter( 8, 'The result', 'A lighter page, built on our design system.' );
	$c .= sera_b_p( 'Carolina produced the high-fidelity design, with me setting the direction, on top of Atlas, the design system we had been building. A clean layout, rounded shapes, a friendlier typeface, a wider palette to lighten a heavy subject, simple illustrations and the negotiation steps shown right on the page.' );
	$c .= sera_b_mock( 'acordo-certo' );
	$c .= sera_b_p( 'Every block on the new page came from something we heard in the interviews or saw in the tests.' );
	$c .= sera_b_art( 'ac-anatomy' );
	$c .= sera_b_p( 'On mobile, where a lot of these negotiations begin, the page opens with a single promise, the CPF field and one button.' );
	$c .= sera_b_mock( 'ac-mobile' );
	$c .= sera_b_art( 'ac-system' );
	$c .= sera_b_chapter( 9, 'Impact', 'Higher conversion and new design roles.' );
	$c .= sera_b_art( 'ac-impact' );
	$c .= sera_b_p( 'We also redesigned the About, Partners and partner landing pages with the same system.' );
	$c .= sera_b_chapter( 10, 'Why it matters', 'I left the page for last. By then, every block had a reason.' );
	$c .= sera_b_art( 'ac-reflection' );
	$c .= sera_b_art( 'ac-signals' );

	$cases[] = array(
		'slug'    => 'acordo-certo-homepage',
		'title'   => 'Acordo Certo: the homepage people didn’t trust with their debt',
		'order'   => 6,
		'excerpt' => 'The redesign lifted conversion by 15% on the homepage and landing pages, and the company opened new design roles after it. I led a two-person design team: the strategy, the research, a company-wide vision workshop and the direction, with Carolina Miguel, the junior product designer on my team, turning it into UI. Acordo Certo negotiates debts for free for the person in debt, and its homepage didn’t feel safe. We started with the customer and left the layout for last.',
		'meta'    => array(
			'_sera_headline' => 'Acordo Certo: making a debt-negotiation platform feel safe enough to start',
			'_sera_company'  => 'Acordo Certo',
			'_sera_year'     => '2021–22',
			'_sera_role'     => 'Product Design Manager, leading a design duo',
			'_sera_metrics'  => "+15% | Conversion on the homepage and landing pages\n3 | Archetypes the company adopted to talk about customers\nAtlas | Design system built by the team (no relation to Atlas Technologies)",
			'_sera_chips'    => 'Design leadership, JTBD research, Design system',
			'_sera_visual'   => 'acordo-certo',
		),
		'content' => $c,
	);

	/* ------------------------------------------------------ 5. Bastidores */
	$c  = sera_b_art( 'nb-glance' );
	$c .= sera_b_chapter( 1, 'Context', 'A criticism site that looked like a viral-news feed.' );
	$c .= sera_b_p( 'Bastidores is a Brazilian site of film, TV and game criticism and pop-culture news, with a simple promise in its tagline: <em>Aqui a crítica acontece</em>, this is where criticism happens. I own the product, from strategy and design to the front end (a custom WordPress theme in PHP), and the business runs on ads.', 'lead' );
	$c .= sera_b_p( 'From 2022 to 2026, the site ran on a stock viral-news theme. It worked as a blog, but it said nothing about what made Bastidores different, and it had no planned place for ads, the thing the business runs on.' );
	$c .= sera_b_chapter( 2, 'The audit', 'Four problems, visible on the homepage alone.' );
	$c .= sera_b_art( 'nb-audit' );
	$c .= sera_b_p( 'The clearest way to see the problem is to look at what a reader met before the first story. The old theme stacked three bars of links and a row of six thumbnails above the fold. The redesign keeps one line of news, one header and one planned ad slot, and gives the rest of the screen to criticism.' );
	$c .= sera_b_art( 'nb-fold' );
	$c .= sera_b_mock( 'nb-before-after' );
	$c .= sera_b_chapter( 3, 'The bet', 'Grow the audience and the business, together.' );
	$c .= sera_b_p( 'Most media sites treat these as a trade-off: more ads, worse reading, less traffic. I treated them as one product problem, and designed both sides at the same time.' );
	$c .= sera_b_art( 'nb-levers' );
	$c .= sera_b_chapter( 4, 'The redesign', 'Criticism as the front door.' );
	$c .= sera_b_p( 'The new homepage opens with a mosaic of the reviews and stories that matter that day, followed by sections for film and game criticism, and only then the stream of news. A black ticker keeps the latest headlines one glance away, and the whole identity moved from a generic blue to paper, ink and a serif typeface for headlines.' );
	$c .= sera_b_mock( 'bastidores' );
	$c .= sera_b_art( 'nb-system' );
	$c .= sera_b_chapter( 5, 'Ad strategy', 'Ads as components of the system.' );
	$c .= sera_b_p( 'I decided where the ads belong before drawing the layout: one slot under the header and units between feed sections. Reading stays calm, and the ads stop competing with the stories.' );
	$c .= sera_b_art( 'nb-ads' );
	$c .= sera_b_p( 'Each slot is a component with its own rules. It is labelled, holds its space before the ad loads and only appears between sections, so the page never jumps and an ad never passes for a story.' );
	$c .= sera_b_art( 'nb-slot' );
	$c .= sera_b_chapter( 6, 'Mobile', 'Getting to the first story faster on the phone.' );
	$c .= sera_b_p( 'On the phone, the old site stacked a menu bar, a trending-topics strip and a row of tiny thumbnails before the first story. The new one opens straight on the story, with sections and ad slots sized for the screen.' );
	$c .= sera_b_mock( 'nb-mobile' );
	$c .= sera_b_p( 'The redesign is also lighter. Without the stock theme’s extra menus, sidebar widgets and repeated blocks, the homepage HTML went from about 200 KB to about 52 KB. That matters most on the phone, where both the first story and the ads have to load.' );
	$c .= sera_b_art( 'nb-weight' );
	$c .= sera_b_chapter( 7, 'Impact', 'A much bigger audience, and a more profitable business.' );
	$c .= sera_b_art( 'nb-impact' );
	$c .= sera_b_chapter( 8, 'Why it matters', 'I decided where the ads go before I drew anything else.' );
	$c .= sera_b_art( 'nb-reflection' );
	$c .= sera_b_art( 'nb-signals' );

	$cases[] = array(
		'slug'    => 'bastidores-redesign',
		'title'   => 'Bastidores: more readers and more ad revenue, at once',
		'order'   => 8,
		'excerpt' => 'In the 30 days after launch, visits grew about 500% and ad revenue per visit rose 20%, against the 30 days before. Bastidores is my own product, a Brazilian film, TV and games criticism site that ran on a stock viral-news theme. I did the strategy, the design and the front end: reviews at the front door, and ads designed into the layout so they stop competing with the stories.',
		'meta'    => array(
			'_sera_headline' => 'Bastidores: turning a viral-news blog into a criticism publication, and a better business',
			'_sera_company'  => 'Bastidores',
			'_sera_year'     => '2026',
			'_sera_role'     => 'Owner · strategy, design and front end',
			'_sera_metrics'  => "~500% | More visits in the 30 days after launch, vs the 30 before\n+20% | Higher ad revenue per visit in the same window\n1 | Planned ad slot above the fold, instead of none",
			'_sera_chips'    => 'Product ownership, Editorial design, Monetisation',
			'_sera_visual'   => 'bastidores',
		),
		'content' => $c,
	);

	/* -------------------------------------------- 7. Pagaleve · Research Hub */
	$c  = sera_b_art( 'rh-glance' );
	$c .= sera_b_chapter( 1, 'The problem', 'Research got presented, praised and forgotten.' );
	$c .= sera_b_p( 'I’ve been doing research for more than ten years, and the hardest part has always been what happens after the presentation. At Pagaleve, findings lived in decks spread across Drive. A PM would ask a question we had already answered, and a new hire had no way to learn what we already knew about our customers, short of asking the one person who ran the study.', 'lead' );
	$c .= sera_b_p( 'At the same time, more people on the team wanted to run research, including designers who had never written a survey. And the raw material of research, spreadsheets with customer IDs and session recordings with faces and voices, sat one click away from the slides anyone could open. Under Brazil’s data protection law (<strong>LGPD</strong>), that can’t depend on people remembering to be careful.' );
	$c .= sera_b_art( 'rh-failures' );
	$c .= sera_b_chapter( 2, 'The bet', 'Make publishing part of running a study, so the archive builds itself.' );
	$c .= sera_b_art( 'rh-statement' );
	$c .= sera_b_p( 'Four principles guided every decision, from the folder structure to the last toggle.' );
	$c .= sera_b_art( 'rh-principles' );
	$c .= sera_b_chapter( 3, 'The system', 'One loop, from what we learned to what we learn next.' );
	$c .= sera_b_p( 'A Claude skill guides the research, Google Drive keeps the files, and the Research Hub, built in Lovable, turns both into something people can browse, ask and plan with. The pieces talk through an <strong>MCP server I built into the hub</strong> (MCP, the open standard that lets an AI assistant call a tool). So the archive does three jobs. The skill reads it at the start of a study and publishes to it at the end. Anyone at the company can connect it to their own Claude. And next quarter’s roadmap is built from it.' );
	$c .= sera_b_art( 'rh-system' );
	$c .= sera_b_chapter( 4, 'The hub', 'The team’s Drive folders, turned into a product.' );
	$c .= sera_b_p( 'The hub reads the structure the team already used. A folder is an area, a subfolder is a study (date and method come from its name), and a <code>resumo.md</code> becomes the summary and insights. Drop in a .zip, a PDF, a deck or a spreadsheet. Nothing goes live before you review what each file turns into. Behind it, an admin panel keeps studies, authors, feedback and settings in one place.' );
	$c .= sera_b_mock( 'rh-shots-archive' );
	$c .= sera_b_art( 'rh-import' );
	$c .= sera_b_chapter( 5, 'The skill', 'How I run research, packaged for any designer.' );
	$c .= sera_b_p( 'I packaged how I run research into a Claude skill. It works out which stage you’re in, does that stage’s work and moves on to the next. It only stops for what a person has to do (sign in, press send, approve the insights), and says so in a short “your turn” card. And it talks to the hub through MCP: it reads the archive at the start and publishes the insights at the end, on its own.' );
	$c .= sera_b_art( 'rh-flow' );
	$c .= sera_b_art( 'rh-mcp' );
	$c .= sera_b_p( 'A skill only helps if people install it. So the hub got a guide, a five-minute read next to the skill download. It helps you write the first question in four parts (audience, moment, doubt and the decision it informs) and turns it into a request ready to paste into Claude. It also sets the house rules: the skill suggests, people decide, and customer data never leaves the room.' );
	$c .= sera_b_art( 'rh-guide' );
	$c .= sera_b_chapter( 6, 'The format', 'Every study, the same six sections.' );
	$c .= sera_b_p( 'Interviews, a survey or a usability test: every study is written up the same way. You can compare two studies or skim one in a minute, and the detail is there when you need it.' );
	$c .= sera_b_art( 'rh-format' );
	$c .= sera_b_chapter( 7, 'Ask the archive', 'Questions in plain language, answers with sources.' );
	$c .= sera_b_p( 'The chat only answers from the hub and tags each claim with the study it came from, one tap away from the source. It opens on a blank page with a few starting questions, and you can attach up to ten studies to limit the answer to them.' );
	$c .= sera_b_p( 'Later the chat became the hub’s home screen. One menu now covers the whole product, as a sidebar on desktop and a drawer on mobile: the archive, the roadmap, the guide and the Claude connector are one tap away, next to the conversations you want to keep. Every answer can be copied, redone or rated, and a thumbs down asks what was missing, so the chat learns from its misses.' );
	$c .= sera_b_mock( 'rh-shots-ask' );
	$c .= sera_b_p( 'The same archive also lives outside the hub. The MCP server became a connector anyone at Pagaleve can add to their own Claude, signing in with a company account: tools to list studies, publish one, read the roadmap and update it. People ask in their own chat, and the confidentiality rules travel with the data, so confidential files stay locked there too.' );
	$c .= sera_b_art( 'rh-connect' );
	$c .= sera_b_chapter( 8, 'The roadmap', 'Using the archive to plan next quarter’s studies.' );
	$c .= sera_b_p( 'Once the archive was searchable, the team needed to decide what to research next quarter, and why. Planning used to happen in a spreadsheet, from memory. I added a research roadmap to the hub that starts from the archive instead, in three steps.', 'lead' );
	$c .= sera_b_art( 'rh-roadmap-steps' );
	$c .= sera_b_mock( 'rh-shots-roadmap' );
	$c .= sera_b_p( 'Ideas from the team and ideas from the AI sit side by side, and both face the same test: a question, the decision it informs and a reason to do it now. The AI only reads Internal content, so confidential studies inform the team without leaking into suggestions.' );
	$c .= sera_b_p( 'Then the ranked list becomes a calendar. A draft only becomes the plan when someone publishes it, and publishing is what creates the Jira cards, so the roadmap and the team’s backlog never drift apart. Three small guardrails came from using it: a warning when the calendar no longer follows the priority, a dry run that shows what would change in Jira before anything is created, and a sync that brings each card’s status back.' );
	$c .= sera_b_p( 'With that, the roadmap feeds the skill, the skill feeds the archive, and the archive feeds the next roadmap.' );
	$c .= sera_b_chapter( 9, 'Privacy by default', 'The system applies the LGPD rules, so people don’t have to remember them.' );
	$c .= sera_b_p( 'I designed the privacy rules before the first screen. The findings are open to the whole company, and data about the people behind them stays locked. Every rule is applied automatically: on import, inside the skill, and in what the roadmap’s AI is allowed to read.' );
	$c .= sera_b_art( 'rh-privacy' );
	$c .= sera_b_chapter( 10, 'What changed', 'From “who ran that study?” to “what do we learn next?”' );
	$c .= sera_b_art( 'rh-impact' );
	$c .= sera_b_chapter( 11, 'What I learned', 'With AI, more of my work became describing how the system should behave.' );
	$c .= sera_b_art( 'rh-reflection' );
	$c .= sera_b_art( 'rh-signals' );
	$c .= sera_b_p( 'Real product screens, anonymised: studies, people, quotes and figures are fictional. Pagaleve’s findings, figures and internal data are confidential and don’t appear here.', 'note' );

	$cases[] = array(
		'slug'    => 'research-hub',
		'title'   => 'Research Hub: the research nobody opened twice',
		'order'   => 2,
		'excerpt' => 'I designed and built Pagaleve’s Research Hub, with Lovable and Claude, because our research ended as decks nobody opened again. It is an archive that fills itself, a Claude skill that guides each study, a chat that cites every claim and an AI roadmap that sends next quarter’s studies to Jira.',
		'meta'    => array(
			'_sera_headline' => 'Research Hub: an archive of Pagaleve’s research that answers questions',
			'_sera_company'  => 'Pagaleve',
			'_sera_year'     => '2026',
			'_sera_role'     => 'Specialist Product Designer · concept, design and build',
			'_sera_metrics'  => "Searchable | One archive, in plain language, in the hub and from Claude\nSourced | Every claim linked to the study it came from\n→ Jira | An AI roadmap turns findings into next quarter’s studies",
			'_sera_chips'    => 'Research ops, AI tooling, LGPD by design',
			'_sera_visual'   => 'research-hub',
		),
		'content' => $c,
	);

	/* ------------------------------------------------------------- 8. Lume */
	$c  = sera_b_art( 'lm-glance' );
	$c .= sera_b_chapter( 1, 'The problem', 'Most prototypes ship untested, because testing them well costs a designer a week.' );
	$c .= sera_b_p( 'A moderated usability test is still the best way to learn why someone gets lost on a screen. It’s also the first thing cut from a sprint: recruit, schedule, run and transcribe eight sessions and the week is gone. At Pagaleve there was a second problem. More designers wanted to test, and the tools that scale, click maps and unmoderated tasks, show where people tapped but never ask what they expected to happen.', 'lead' );
	$c .= sera_b_p( 'And when the designer who drew the screen moderates the session, the test tends to lean towards the answer they are hoping for.' );
	$c .= sera_b_art( 'lm-pains' );
	$c .= sera_b_chapter( 2, 'The bet', 'A moderator that comes with the link.' );
	$c .= sera_b_art( 'lm-statement' );
	$c .= sera_b_p( 'I called it the Lume. I’m building it for the team in Lovable, on a realtime voice model, and it’s still in progress, so this page shows where it stands today. Four decisions shaped it before the first screen.' );
	$c .= sera_b_art( 'lm-principles' );
	$c .= sera_b_chapter( 3, 'The system', 'A Figma link in, an invite link out, a report that fills itself in.' );
	$c .= sera_b_p( 'The designer sends a Figma prototype link. A Claude skill reads the screens, drafts the script and creates the study through the Lume’s own MCP server, the same open standard I used in the Research Hub. The designer marks what can’t be skipped, rehearses with simulated participants and publishes. The CRM sends the invite. Customers use the prototype on their phones, thinking out loud, and the report writes itself as the sessions come in.' );
	$c .= sera_b_art( 'lm-system' );
	$c .= sera_b_p( 'The designer area is built for the laptop and still works on the phone, so a study can be checked between meetings. Each screen below is shown on both.' );
	$c .= sera_b_mock( 'lm-shots-setup' );
	$c .= sera_b_chapter( 4, 'The session', 'The prototype fills the screen. The moderator is a card at the bottom.' );
	$c .= sera_b_p( 'Most of the design work went into the participant’s side, and most of that was taking things away. The best session is the one where the moderator almost disappears.', 'lead' );
	$c .= sera_b_mock( 'lume-flow' );
	$c .= sera_b_art( 'lm-session' );
	$c .= sera_b_p( 'Deciding what the Lume says was the easy part. The hard part was deciding <strong>when it stops</strong>. A voice assistant that fills every pause reads as rude, and a participant who gets interrupted stops thinking out loud. So turn-taking became a product rule.' );
	$c .= sera_b_art( 'lm-turns' );
	$c .= sera_b_p( 'Each version of the session got smaller. The first had a chat under the prototype, then a bottom sheet, then an iPhone drawn inside the iPhone. All of it competed with the thing being tested.' );
	$c .= sera_b_art( 'lm-cut' );
	$c .= sera_b_chapter( 5, 'The designer’s side', 'Draft, essential blocks, a rehearsal, then the field.' );
	$c .= sera_b_p( 'The designer area is deliberately small: one account, company sign-in, and a study that is a draft until someone decides it isn’t.' );
	$c .= sera_b_art( 'lm-designer' );
	$c .= sera_b_art( 'lm-profiles' );
	$c .= sera_b_p( 'Once a study is in the field, the designer doesn’t wait for the last session. Findings appear as sessions come in, each one with the number of sessions behind it and a quote, and any session can be replayed next to its transcript, as at the top of this page.' );
	$c .= sera_b_mock( 'lm-findings' );
	$c .= sera_b_chapter( 6, 'Building it', 'A product agent improves the Lume every night. I review the log in the morning.' );
	$c .= sera_b_p( 'A voice product has a thousand small failures you only hear by using it, and I can’t run twenty sessions a night. So the Lume has a scheduled product agent that does: it audits the session, compares what it finds with the vision and the decisions already logged, fixes what it can and sends me the list.' );
	$c .= sera_b_art( 'lm-agent' );
	$c .= sera_b_chapter( 7, 'Where it stands', 'Working, being tuned, and what comes next.' );
	$c .= sera_b_art( 'lm-status' );
	$c .= sera_b_chapter( 8, 'What I learned so far', 'The words came last. Turn-taking came first.' );
	$c .= sera_b_art( 'lm-reflection' );
	$c .= sera_b_art( 'lm-signals' );
	$c .= sera_b_p( 'Work in progress, published on purpose. Real product screens, rebuilt in HTML and CSS from the Lovable UI and anonymised; studies, participants, questions and quotes are fictional. Pagaleve’s findings and internal data are confidential and don’t appear here.', 'note' );

	$cases[] = array(
		'slug'    => 'lume',
		'title'   => 'Lume: an AI moderator that knows when to stop talking',
		'order'   => 3,
		'excerpt' => 'Moderated usability tests don’t scale, and unmoderated tools lose the why. I’m building the Lume, an AI voice moderator that turns a Figma prototype link into a usability test customers run on their phones, with a report that cites every finding. The hard part was deciding when it stops talking. Work in progress, published on purpose.',
		'meta'    => array(
			'_sera_headline' => 'Lume: usability tests run by an AI voice, from a Figma link',
			'_sera_company'  => 'Pagaleve',
			'_sera_year'     => '2026 · in progress',
			'_sera_role'     => 'Specialist Product Designer · concept, design and build',
			'_sera_metrics'  => "One link | A Figma prototype in, a CRM invite out\nBy voice | The moderator asks, waits and never interrupts\n5–12 | sessions per study, rehearsed with simulated participants first",
			'_sera_chips'    => 'Research tooling, Voice AI, Work in progress',
			'_sera_visual'   => 'lume',
		),
		'content' => $c,
	);

	/* ------------------------------------------------- 9. Paperplane Studio */
	// Text version of the case (SEO, llms.txt, editor). The page itself is template-parts/cases/paperplane.php,
	// generated with the real studio screens; see inc/paperplane.php.
	$c  = sera_b_p( 'A sentence goes in, an animated episode comes out, and every click shows its price before it happens. I set the product, the scope and the finish of every screen. A team of AI agents built it under my direction, in 23 days.', 'lead' );
	$c .= sera_b_p( 'AI wrote the code. Every decision that makes Paperplane feel simple and finished was mine.' );
	$c .= sera_b_chapter( 1, 'The landscape', 'Making an episode with AI today means directing with six tabs open and the bill in the dark.' );
	$c .= sera_b_p( 'Anyone who has tried to make animation with AI knows the scene. One tab for the image, another for the video, another for the voice, and a spreadsheet to keep track of what it has cost.', 'lead' );
	$c .= sera_b_p( 'The prompt is written in English, copied from a tutorial. Every attempt costs money, and the price only shows up afterwards. The character with short hair in scene 1 comes back with a fringe in scene 2. And the total arrives at the end of the month, on the card statement.' );
	$c .= sera_b_p( 'Somewhere in all that, the story gets lost. Someone who wanted to direct spends the day operating tools: copy, paste, translate, wait in the queue, download, upload again. An idea that fitted in one sentence becomes a folder of files with names like "final_v3".' );
	$c .= sera_b_p( '<strong>Paperplane brings that whole desk into a single screen, in the order of a shoot, and puts the price on every button.</strong>' );
	$c .= sera_b_chapter( 2, 'The product', 'From sentence to episode in ten steps any film set would recognise.' );
	$c .= sera_b_p( 'I laid the studio out in the order of a real production. Write, Visualise, Shoot. Each screen asks for one thing.', 'lead' );
	$c .= sera_b_p( 'The order is what keeps continuity. Characters and locations get an approved sheet before the storyboard, and that sheet goes with every frame. The shot breakdown comes after them on purpose: breaking down a scene means planning the camera, and Origami, the studio’s AI assistant, only picks the right shot when it knows the cast and the places.' );
	$c .= sera_b_p( 'The vocabulary comes from the set too: take, shot, breakdown. Every screen has a short title, one sentence explaining why, and one main button. I picked the names with the same care: "universe" instead of "bible", so the series doesn’t carry a religious term.' );
	$c .= sera_b_chapter( 3, 'The price before the click', 'Every click costs money. So the price arrives before the click.' );
	$c .= sera_b_p( 'Every other decision rests on this one. A video generator charges per attempt, and an assistant acting on its own can burn through someone’s balance without warning.', 'lead' );
	$c .= sera_b_p( 'I designed four rules so that <strong>no credit is spent unless the person asks</strong>. They apply across the whole studio, Origami included, and no change goes live if it breaks one of them.' );
	$c .= sera_b_p( '<strong>A balance counted in minutes</strong> The balance says how much video it still buys, as an estimate, at the chosen quality. At zero the sentence disappears; it never shows "0 s".' );
	$c .= sera_b_p( '<strong>Media only comes out with a click</strong> The click is the consent, and the button carries the estimated price. I turned down an automatic mode with a spending cap because it broke this rule.' );
	$c .= sera_b_p( '<strong>If it fails, the credit comes back</strong> The credit is held while generating and comes back if there is an error. A finished result is charged, and the interface says so plainly.' );
	$c .= sera_b_p( '<strong>Image first, video after</strong> Every take is approved as an image before it is animated. Only the approved frame becomes the first frame of the video.' );
	$c .= sera_b_chapter( 4, 'The redesign', 'Effortless to use, serious under the hood.' );
	$c .= sera_b_p( 'Five days in, the studio was growing one feature on top of another, and every screen had a different skeleton. On 24 October I stopped and redesigned everything around four rules. A first-timer finishes a step without opening a single menu, and a professional finds the rest under "More options".', 'lead' );
	$c .= sera_b_p( 'Then I cut what was intimidating. Four technical modes became a single choice: Basic or Advanced. Model names, price per second and English prompts left the screen. People write in Portuguese, mention @Maria or @take 1A, and the studio handles the rest.' );
	$c .= sera_b_chapter( 5, 'Microinteractions', 'Every movement in the studio tells you where your money is.' );
	$c .= sera_b_p( 'I chose a motion personality and gave it a name: "Quiet with a landing, credit gives energy". The base is calm. When something moves, it has something to say.', 'lead' );
	$c .= sera_b_p( 'The strictest rule: <strong>the particle is the credit</strong>. It only appears where there is credit or Origami, travels from the balance to the action and is always triggered by a real event. With reduced motion, everything stops and the information stays in the text.' );
	$c .= sera_b_chapter( 6, 'Dobra', 'A design system that runs the whole studio.' );
	$c .= sera_b_p( 'I created Dobra so the whole studio would follow one standard. Colour, spacing, corners and motion live in one place, and that is where I tune every piece of the product. When I change a value there, the whole studio follows, and the agents speak the same language I do: I ask for <code>--accent</code> and they know where to look.', 'lead' );
	$c .= sera_b_p( 'Nothing off-standard goes live: colour, spacing and contrast are checked on every change.' );
	$c .= sera_b_chapter( 7, 'The website', 'Dobradura: the home page speaks the studio’s language.' );
	$c .= sera_b_p( 'The home page has one job: make people who haven’t come in yet want to. I brought Dobra’s vocabulary to it, with smooth paper, flat lime and the highlight that folds. The promise comes along too: the price appears before every take. The waiting list measures the funnel without cookies and without storing names, emails or IP addresses in its events.', 'lead' );
	$c .= sera_b_p( 'The whole studio fits in your pocket, with everything the desktop can do.' );
	$c .= sera_b_chapter( 8, 'How I work', 'Every night, a team of agents researches what Paperplane should become. In the morning, I choose.' );
	$c .= sera_b_p( 'While I sleep, agents review the platform, study the competition and follow what is new in the AI market. Out of that comes a shortlist of what deserves a place on the roadmap.', 'lead' );
	$c .= sera_b_p( 'The best ideas arrive ready to try, behind a switch I can turn off whenever I like. At midday I open the night’s summary and decide what stays, what goes back and what is dropped.' );
	$c .= sera_b_p( 'There are nine agents, each with one role: research, theme memory, strategy, critique, design, building, quality, security and the morning summary. The critic attacks every idea before it becomes a screen.' );
	$c .= sera_b_p( 'In 23 days, every milestone on this line started with a decision of mine. The agents propose, build and test. The direction, the cuts and the standard of finish are mine.' );
	$c .= sera_b_chapter( 9, 'What I learned', 'What I have learned so far, and what comes next.' );
	$c .= sera_b_p( '<strong>A written decision beats a remembered one.</strong> Agents don’t keep context from one session to the next. Numbering and dating every decision stopped the product going round in circles.' );
	$c .= sera_b_p( '<strong>A standard that matters is written into the product.</strong> Asking for "no loose colours" lasted a day. Once the rule was built into the studio, no colour slipped through again.' );
	$c .= sera_b_p( '<strong>Taking things off the screen is the hardest work.</strong> Agents add things easily. Every cut needed a decision from me, and cutting is what made the studio simple.' );
	$c .= sera_b_p( '<strong>Testing with people from film and video.</strong> The beta is closed. I am testing it myself, along with close friends who work in film and video, and gathering their feedback to decide what comes next.' );
	$c .= sera_b_p( '<strong>Do minutes work for people who have never generated video?</strong> It is the assumption I most want to validate with the people testing it now.' );
	$c .= sera_b_chapter( 10, 'Where it stands', 'The studio is in closed beta. The home page is live.' );
	$c .= sera_b_p( 'Paperplane is still in progress, and this page shows where it stands today. If you work in product, AI or animation and want to talk about how a designer directs a team of agents, get in touch.' );
	$c .= sera_b_p( 'The images and videos inside the screens are examples. Product screens are shown in Portuguese, the product’s language.', 'note' );

	$cases[] = array(
		'slug'    => 'paperplane-studio',
		'title'   => 'Paperplane Studio: an AI film studio that shows the price before the click',
		'order'   => 9,
		'excerpt' => 'A sentence goes in, an animated episode comes out, and every click shows its price before it happens. I set the product, the scope and the finish of every screen; a team of AI agents built it under my direction in 23 days. A personal project, in closed beta.',
		'meta'    => array(
			'_sera_headline' => 'Paperplane Studio: an AI film studio that shows the price before the click',
			'_sera_company'  => 'Paperplane Studio',
			'_sera_year'     => '2026 · in beta',
			'_sera_role'     => 'Founder & Designer',
			'_sera_metrics'  => "23 days | From the first screen to a complete studio, with editing and billing\n10 steps | From sentence to episode, as on a real film set\nZero | Media generated without the person’s click",
			'_sera_chips'    => 'Personal project, Generative AI, Design system',
			'_sera_visual'   => 'paperplane',
		),
		'content' => $c,
	);

	return $cases;
}

/**
 * Cases that left the library. The importer offers to take them off the home.
 */
function sera_retired_cases() {
	return array( 'cliniclik-redesign' => 'CliniClik: redesign concept' );
}

/**
 * Portuguese version of a case: inc/i18n/cases/<slug>.php returns
 * array( 'title' => …, 'excerpt' => …, 'meta' => array( '_sera_headline' => … ), 'content' => … ).
 *
 * @param string $slug Case slug.
 * @return array|null
 */
function sera_case_pt( $slug ) {
	$file = get_template_directory() . '/inc/i18n/cases/' . sanitize_file_name( $slug ) . '.php';
	if ( ! file_exists( $file ) ) {
		return null;
	}
	$pt = include $file;
	if ( ! is_array( $pt ) || empty( $pt['content'] ) ) {
		return null;
	}
	return wp_parse_args( $pt, array( 'title' => '', 'excerpt' => '', 'meta' => array(), 'content' => '' ) );
}

/* ---------------------------------------------------------------- importer */

function sera_portfolio_term_id() {
	$term = term_exists( 'portfolio', 'category' );
	if ( ! $term ) {
		$term = wp_insert_term( 'Portfolio', 'category', array( 'slug' => 'portfolio' ) );
	}
	if ( is_wp_error( $term ) ) {
		return 0;
	}
	return (int) ( is_array( $term ) ? $term['term_id'] : $term );
}

/**
 * Create or update one case page.
 *
 * @param array  $case   Case definition.
 * @param string $status 'draft' | 'publish' | 'keep'.
 * @return int|WP_Error  Page ID.
 */
function sera_import_case( $case, $status = 'draft' ) {
	$term_id  = sera_portfolio_term_id();
	$existing = get_page_by_path( $case['slug'], OBJECT, 'page' );
	$postarr  = array(
		'post_type'    => 'page',
		'post_title'   => $case['title'],
		'post_name'    => $case['slug'],
		'post_excerpt' => $case['excerpt'],
		'post_content' => $case['content'],
		'menu_order'   => $case['order'],
	);
	if ( $existing ) {
		$postarr['ID']          = $existing->ID;
		$postarr['post_status'] = 'keep' === $status ? $existing->post_status : $status;
		$id                     = wp_update_post( wp_slash( $postarr ), true );
	} else {
		$postarr['post_status'] = 'keep' === $status ? 'draft' : $status;
		$id                     = wp_insert_post( wp_slash( $postarr ), true );
	}
	if ( is_wp_error( $id ) ) {
		return $id;
	}
	if ( $term_id ) {
		wp_set_object_terms( $id, array( $term_id ), 'category', true );
	}
	foreach ( $case['meta'] as $k => $v ) {
		update_post_meta( $id, $k, $v );
	}
	// Brazilian Portuguese version (served at /pt/<slug>/, see inc/i18n.php).
	$pt = sera_case_pt( $case['slug'] );
	if ( $pt ) {
		update_post_meta( $id, '_sera_title_pt', $pt['title'] );
		update_post_meta( $id, '_sera_excerpt_pt', $pt['excerpt'] );
		update_post_meta( $id, '_sera_content_pt', wp_slash( $pt['content'] ) );
		foreach ( $pt['meta'] as $k => $v ) {
			update_post_meta( $id, $k . '_pt', $v );
		}
	}
	update_post_meta( $id, '_sera_library_version', SERA_VERSION );
	return (int) $id;
}

/**
 * On activation: create drafts for any case that doesn't exist yet.
 */
add_action(
	'after_switch_theme',
	function () {
		foreach ( sera_starter_cases() as $case ) {
			if ( ! get_page_by_path( $case['slug'], OBJECT, 'page' ) ) {
				sera_import_case( $case, 'draft' );
			}
		}
	}
);

/**
 * Admin screen: Appearance › Sera · Cases.
 */
add_action(
	'admin_menu',
	function () {
		add_theme_page( 'Sera · Cases', 'Sera · Cases', 'edit_pages', 'sera-cases', 'sera_cases_screen' );
	}
);

add_action(
	'admin_post_sera_import',
	function () {
		if ( ! current_user_can( 'edit_pages' ) ) {
			wp_die( 'Sem permissão.' );
		}
		check_admin_referer( 'sera_import' );
		$slug   = isset( $_POST['slug'] ) ? sanitize_key( wp_unslash( $_POST['slug'] ) ) : 'all';
		$status = isset( $_POST['status'] ) ? sanitize_key( wp_unslash( $_POST['status'] ) ) : 'draft';
		if ( ! in_array( $status, array( 'draft', 'publish', 'keep' ), true ) ) {
			$status = 'draft';
		}
		if ( 'publish' === $status && ! current_user_can( 'publish_pages' ) ) {
			$status = 'draft';
		}
		if ( 'retire' === ( isset( $_POST['op'] ) ? sanitize_key( wp_unslash( $_POST['op'] ) ) : '' ) ) {
			$page = get_page_by_path( $slug, OBJECT, 'page' );
			if ( $page && array_key_exists( $slug, sera_retired_cases() ) && current_user_can( 'edit_page', $page->ID ) ) {
				wp_update_post( array( 'ID' => $page->ID, 'post_status' => 'draft' ) );
				wp_remove_object_terms( $page->ID, 'portfolio', 'category' );
				wp_remove_object_terms( $page->ID, 'portfolio', 'post_tag' );
			}
			wp_safe_redirect( add_query_arg( array( 'page' => 'sera-cases', 'imported' => 0 ), admin_url( 'themes.php' ) ) );
			exit;
		}
		$done = 0;
		foreach ( sera_starter_cases() as $case ) {
			if ( 'all' !== $slug && $case['slug'] !== $slug ) {
				continue;
			}
			if ( ! is_wp_error( sera_import_case( $case, $status ) ) ) {
				$done++;
			}
		}
		wp_safe_redirect( add_query_arg( array( 'page' => 'sera-cases', 'imported' => $done ), admin_url( 'themes.php' ) ) );
		exit;
	}
);

function sera_cases_screen() {
	$imported = isset( $_GET['imported'] ) ? (int) $_GET['imported'] : -1; // phpcs:ignore WordPress.Security.NonceVerification
	?>
	<div class="wrap">
		<h1>Sera · Cases</h1>
		<?php sera_copy_pack_box(); ?>
		<p style="max-width:760px">Os cases vêm com o tema, já diagramados: texto em blocos editáveis e visuais (mockups e artefatos) em blocos do Sera. Importar cria (ou atualiza) cada case como uma <strong>Página</strong> na categoria <strong>portfolio</strong>, com URL própria. A Home lista essas páginas automaticamente, na ordem do campo “Ordem”.</p>
		<p style="max-width:760px;color:#b32d2e"><strong>Atenção:</strong> “Atualizar” substitui o conteúdo e os dados do card da página pelo conteúdo da biblioteca do tema. Edições feitas à mão nessas páginas serão sobrescritas (o WordPress guarda a versão anterior em Revisões).</p>
		<?php if ( $imported >= 0 ) : ?>
			<div class="notice notice-success"><p><?php echo esc_html( sprintf( '%d case(s) importado(s).', $imported ) ); ?></p></div>
		<?php endif; ?>

		<table class="widefat striped" style="max-width:1000px;margin-top:16px">
			<thead><tr><th>#</th><th>Case</th><th>URL</th><th>Status</th><th style="width:360px">Ações</th></tr></thead>
			<tbody>
			<?php foreach ( sera_starter_cases() as $case ) : ?>
				<?php $page = get_page_by_path( $case['slug'], OBJECT, 'page' ); ?>
				<tr>
					<td><?php echo (int) $case['order']; ?></td>
					<td><strong><?php echo esc_html( $case['title'] ); ?></strong><br><span style="color:#646970"><?php echo esc_html( $case['meta']['_sera_company'] ); ?></span></td>
					<td><code>/<?php echo esc_html( $case['slug'] ); ?>/</code><?php if ( $page ) : ?><br><a href="<?php echo esc_url( get_permalink( $page ) ); ?>" target="_blank">Ver</a> · <a href="<?php echo esc_url( get_edit_post_link( $page ) ); ?>">Editar</a><?php endif; ?></td>
					<td><?php echo $page ? esc_html( get_post_status_object( $page->post_status )->label ) : '—'; ?></td>
					<td>
						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:flex;gap:6px;flex-wrap:wrap">
							<?php wp_nonce_field( 'sera_import' ); ?>
							<input type="hidden" name="action" value="sera_import">
							<input type="hidden" name="slug" value="<?php echo esc_attr( $case['slug'] ); ?>">
							<?php if ( $page ) : ?>
								<button class="button" name="status" value="keep">Atualizar conteúdo</button>
								<?php if ( 'publish' !== $page->post_status ) : ?><button class="button button-primary" name="status" value="publish">Atualizar e publicar</button><?php endif; ?>
							<?php else : ?>
								<button class="button" name="status" value="draft">Importar como rascunho</button>
								<button class="button button-primary" name="status" value="publish">Importar e publicar</button>
							<?php endif; ?>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			<?php foreach ( sera_retired_cases() as $slug => $title ) : ?>
				<?php $page = get_page_by_path( $slug, OBJECT, 'page' ); ?>
				<?php if ( $page && sera_is_case( $page->ID ) ) : ?>
					<tr style="opacity:.8">
						<td>—</td>
						<td><strong><?php echo esc_html( $title ); ?></strong><br><span style="color:#b32d2e">Saiu da biblioteca</span></td>
						<td><code>/<?php echo esc_html( $slug ); ?>/</code></td>
						<td><?php echo esc_html( get_post_status_object( $page->post_status )->label ); ?></td>
						<td>
							<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
								<?php wp_nonce_field( 'sera_import' ); ?>
								<input type="hidden" name="action" value="sera_import">
								<input type="hidden" name="op" value="retire">
								<input type="hidden" name="slug" value="<?php echo esc_attr( $slug ); ?>">
								<button class="button">Tirar da Home (vira rascunho)</button>
							</form>
						</td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
			</tbody>
		</table>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin-top:20px;display:flex;gap:8px">
			<?php wp_nonce_field( 'sera_import' ); ?>
			<input type="hidden" name="action" value="sera_import">
			<input type="hidden" name="slug" value="all">
			<button class="button" name="status" value="keep">Importar/atualizar todos (mantém status)</button>
			<button class="button button-primary" name="status" value="publish">Importar e publicar todos</button>
		</form>
	</div>
	<?php
}
