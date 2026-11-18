<?php
if (!defined('CHAT_PREVIEW')) { http_response_code(404); exit; }
function h($s) { return esc_html((string)$s); }
function attr($s) { return esc_attr((string)$s); }
function icon($name) {
    $paths = [
        'arrow'=>'<path d="M4 10h12m-5-5 5 5-5 5"/>',
        'external'=>'<path d="M5 15 15 5M5 5h10v10"/>',
        'lock'=>'<rect x="4.5" y="9" width="11" height="8.5" rx="2"/><path d="M7 9V6a3 3 0 0 1 6 0v3"/>',
        'down'=>'<path d="M10 3v14m-6-6 6 6 6-6"/>',
        'check'=>'<path d="m3 10 4 4 10-10"/>',
        'message'=>'<path d="M16.5 12V5a1.5 1.5 0 0 0-1.5-1.5H5A1.5 1.5 0 0 0 3.5 5v10l3-2H15a1.5 1.5 0 0 0 1.5-1z"/>'
    ];
    echo '<svg class="icon" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.$paths[$name].'</svg>';
}
function secret_fields($doc) { ?>
  <input type="hidden" name="csrf" value="<?=attr($_SESSION['csrf'])?>">
  <input type="hidden" name="proposal" value="<?=attr($doc['id'])?>">
  <input type="hidden" name="version" value="<?=attr($doc['version'])?>">
<?php }
function artwork($open, $service, $client) { ?>
<div class="artboard <?=$open ? 'open-art' : ''?>" aria-hidden="true">
 <div class="drawing-grid"></div>
 <div class="folder"><div class="back-sheet"></div><div class="leaf leaf-one"></div><div class="leaf leaf-two"></div>
   <div class="front-sheet">
    <div class="cover-top"><span>Matheus Serafim</span><span>Studio files</span></div>
    <div class="cover-title"><?=$open ? h($service) : 'Project<br>proposal'?></div>
    <img class="drawing" src="<?=CHAT_PATH?>structure.svg" alt="" width="430" height="255">
    <div class="cover-bottom"><span><?=$open ? h($client) : 'Private edition'?></span><span>MS.</span></div>
   </div><i class="band"></i>
 </div>
</div>
<?php }
$asset = '/wp-content/themes/sera-v1/assets/';
$rev = (string) filemtime(__DIR__.'/proposal.css');
$full = $authorised;
?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover"><meta name="robots" content="noindex,nofollow,noarchive,nosnippet"><meta name="theme-color" content="#f7f6f0">
<title><?=$full ? h($doc['client']).' · Project proposal' : 'Private proposal'?> | Matheus Serafim</title>
<link rel="icon" href="<?=$asset?>img/favicon.svg" type="image/svg+xml">
<link rel="preload" href="<?=$asset?>fonts/geist.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="<?=CHAT_PATH?>proposal.css?v=<?=attr($rev)?>">
<script defer src="<?=CHAT_PATH?>proposal.js?v=<?=attr((string)filemtime(__DIR__.'/proposal.js'))?>"></script>
<?php if ($full): ?>
<link rel="stylesheet" href="<?=CHAT_PATH?>fintech-work.css?v=<?=attr((string)filemtime(__DIR__.'/fintech-work.css'))?>">
<script defer src="<?=CHAT_PATH?>fintech-work.js?v=<?=attr((string)filemtime(__DIR__.'/fintech-work.js'))?>"></script>
<?php endif;?>
</head><body class="<?=$full ? 'document' : 'gate'?>">
<a class="skip" href="#main">Skip to content</a>
<header class="mast"><div class="wrap mast-in"><a class="identity" href="https://matheusserafim.com/" aria-label="Matheus Serafim, portfolio"><img src="<?=$asset?>img/logo-serafim.svg" alt="" width="62" height="20"><span>Matheus Serafim</span></a>
<?php if ($full): ?><nav class="top-links" aria-label="Proposal sections"><a href="#scope">Scope</a><a href="#schedule">Schedule</a><a href="#investment">Investment</a><a href="#respond">Respond</a></nav>
<form method="post" action="<?=CHAT_PATH?>" class="lockform"><input type="hidden" name="csrf" value="<?=attr($_SESSION['csrf'])?>"><button name="action" value="lock" class="status" aria-label="Lock proposal"><?php icon('lock');?> Lock<span class="long-label"> proposal</span></button></form>
<?php else: ?><span class="status static"><?php icon('lock');?> Private access</span><?php endif;?></div></header>

<?php if (!$full): ?>
<main id="main" class="gate-main wrap">
 <div class="gate-layout">
  <div class="gate-copy">
   <p class="kicker"><i></i> Private correspondence</p>
   <h1>Open your<br><em>proposal.</em></h1>
   <p class="gate-intro" id="code-hint">Enter your four-digit access code to view the project details.</p>
   <form class="gate-form" method="post" action="<?=CHAT_PATH?>">
    <input type="hidden" name="csrf" value="<?=attr($_SESSION['csrf'])?>"><input type="hidden" name="action" value="unlock">
    <label for="code">Access code</label>
    <div class="code-row"><div class="pin-wrap"><input type="password" pattern="[0-9]{4}" maxlength="4" inputmode="numeric" autocomplete="one-time-code" enterkeyhint="go" id="code" name="code" required aria-describedby="code-hint<?=$error ? ' gate-error' : ''?>" <?=$error ? 'aria-invalid="true" autofocus' : ''?>>
     <div class="pin-cells" aria-hidden="true"><i></i><i></i><i></i><i></i></div></div>
    <button class="primary" data-busy="Opening…">View proposal <?php icon('arrow');?></button></div>
    <?php if ($error): ?><p class="error" id="gate-error" role="alert"><?=h($error)?></p><?php endif;?>
   </form>
  </div>
  <?php artwork(false,'',''); ?>
 </div>
</main>
<?php else:
$total = chat_price($doc['amount']); $cur = h($doc['currency']); $half = chat_price($doc['deposit'],true);
$brand = h($doc['client']); $contact = h($doc['contact']);
$question_open = $error_area === 'question' || $message === 'question';
?>
<main id="main">
 <section class="intro wrap"><div class="hero-grid">
  <div><p class="kicker"><i></i> Private project proposal</p>
   <h1>A stronger foundation for <em><?=$brand?>.</em></h1>
   <p class="lede"><?=h($doc['focus'])?></p>
   <a class="text-link" href="#scope">Explore the sprint <?php icon('down');?></a>
  </div>
  <?php artwork(true,$doc['service'],$doc['client']);?></div>
  <dl class="facts"><div><dt>Prepared for</dt><dd><?=$brand?></dd></div><div><dt>Duration</dt><dd>Two weeks</dd></div><div><dt>Engagement</dt><dd>Design + implementation</dd></div><div><dt>Fixed investment</dt><dd><?=h($total)?> <?=$cur?></dd></div></dl>
 </section>
 <section class="letter wrap" aria-labelledby="note-heading">
   <aside class="author"><img src="<?=$asset?>img/headshot.webp" alt="" loading="lazy" width="56" height="56"><div><b>Matheus Serafim</b><small>Staff Product Designer</small></div></aside>
   <div><h2 id="note-heading">Hi <?=$contact?>,</h2><?php foreach($doc['letter'] as $para):?><p><?=h($para)?></p><?php endforeach;?><span class="signature">Matheus</span></div>
 </section>
 <section class="scope-section" id="scope"><div class="wrap section-grid"><div class="section-title">
  <p class="kicker"><i></i> Scope of work</p><h2>Inside <br>the <em>sprint.</em></h2><p>Three stages, each with a deliverable and a decision we’ll make together.</p></div>
  <div class="stages"><?php foreach($doc['stages'] as $i=>$stage):?><article class="stage"><div class="stage-meta"><span class="stage-index">0<?=($i+1)?></span><span><?=h($stage['days'])?></span></div><h3><?=h($stage['title'])?></h3>
   <p><?=h($stage['description'])?></p><dl><div><dt>Deliverable</dt><dd><?=h($stage['deliverable'])?></dd></div><div><dt>Checkpoint</dt><dd><?=h($stage['checkpoint'])?></dd></div></dl></article><?php endforeach;?></div>
 </div></section>
 <section class="schedule wrap section-grid" id="schedule"><div class="section-title"><p class="kicker"><i></i> Collaboration</p><h2>Two weeks, <br><em>in practice.</em></h2></div>
 <div class="schedule-copy"><div><h3>Daily checkpoints</h3><p><?=h($doc['collaboration'])?></p></div><div><h3>What you can reuse</h3><p><?=h($doc['foundation'])?></p></div>
  <details><summary>Start date and dependencies <span>+</span></summary><p><?=h($doc['timing'])?></p></details><details><summary>Scope and release approval <span>+</span></summary><p><?=h($doc['scope'])?></p><p><?=h($doc['delivery'])?></p></details></div></section>
 <section class="investment" id="investment"><div class="wrap investment-in"><div><p class="kicker"><i></i> Fixed investment</p><h2><?=h($doc['service'])?></h2><p>Two weeks of focused design and implementation.</p></div><div class="price-block"><div class="price"><?=h($total)?><small><?=$cur?></small></div><dl><div><dt>50% before kickoff</dt><dd><?=h($half)?></dd></div><div><dt>50% on delivery</dt><dd><?=h(chat_price($doc['balance'],true))?></dd></div></dl><p>Additional work is <?=h(chat_price($doc['hourly']))?> per hour and requires your prior approval.</p></div></div></section>
 <section class="respond wrap section-grid" id="respond"><div class="section-title"><p class="kicker"><i></i> Your response</p><h2>Ready to <br><em>get started?</em></h2><p>After acceptance, I’ll confirm the kickoff, send payment instructions and share the access checklist.</p></div>
 <div class="response-box"><p class="preview-note"><i></i> Test edition · responses are saved as tests.</p>
 <?php if ($message):?><div class="success" tabindex="-1" role="status"><?php icon('check');?><div><strong><?=$message === 'accept' ? 'Test acceptance recorded.' : 'Test question received.'?></strong><p><?=$message === 'accept' ? 'Your response and the terms of this edition have been saved.' : 'Your message has been saved with your email.'?></p></div></div><?php endif;?>
 <form id="accept-form" method="post" action="<?=CHAT_PATH?>#respond"><?php secret_fields($doc);?><input type="hidden" name="action" value="accept">
 <label for="full-name">Full name <span>(optional)</span></label><input type="text" autocomplete="name" id="full-name" name="full_name" maxlength="130" value="<?=attr($error_area === 'accept' ? chat_value('full_name') : '')?>">
 <label for="email">Work email</label><input type="email" name="email" id="email" maxlength="254" autocomplete="email" required value="<?=attr($error_area === 'accept' ? chat_value('email') : '')?>">
 <label class="consent"><input type="checkbox" name="confirmed" value="yes" required <?=($error_area === 'accept' && chat_value('confirmed') === 'yes')?'checked':''?>><span>I’m authorised to accept this proposal on behalf of <?=$brand?>, including the <?=h($total)?> <?=$cur?> investment, payment terms and scope described above.</span></label>
 <?php if ($error && $error_area==='accept'):?><p class="error" role="alert"><?=h($error)?></p><?php endif;?><button class="primary wide" data-busy="Saving…">Accept proposal <?php icon('arrow');?></button></form>
 <details id="questions" class="question-box" <?=$question_open?'open':''?>><summary><?php icon('message');?><span>I have questions</span><b>+</b></summary><form method="post" action="<?=CHAT_PATH?>#questions"><?php secret_fields($doc);?><input type="hidden" name="action" value="question"><input type="hidden" name="request" value="<?=attr($_SESSION['question_key'])?>">
 <label for="q-email">Your email</label><input type="email" id="q-email" name="email" maxlength="254" autocomplete="email" required value="<?=attr($error_area==='question' ? chat_value('email') : '')?>">
 <label for="question">What would you like to discuss?</label><textarea id="question" name="question" rows="4" maxlength="2000" required><?=h($error_area==='question' ? chat_value('question') : '')?></textarea>
 <?php if ($error && $error_area==='question'):?><p class="error" role="alert"><?=h($error)?></p><?php endif;?><button class="secondary" data-busy="Sending…">Send message <?php icon('arrow');?></button></form></details>
 </div></section>
<?php require __DIR__ . '/fintech-work.php'; ?>
</main>
<?php endif;?>
<footer><div class="wrap footer-in"><span>Matheus Serafim <i>/</i> Product design</span><a href="https://matheusserafim.com/">Portfolio <?php icon('external');?></a></div></footer>
</body></html>
