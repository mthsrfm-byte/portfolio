<?php
if (!defined('CHAT_PREVIEW') || empty($authorised)) { http_response_code(404); exit; }
?>
<section class="fintech" id="selected-work" aria-labelledby="fintech-heading">
  <div class="wrap fintech-wrap">
    <div class="fintech-head">
      <h2 id="fintech-heading">Why work <em>with me?</em></h2>
      <p>Before someone commits to financing, they need to trust the figures in front of them. I’ve designed for that moment across credit, banking and debt negotiation.</p>
    </div>
    <ul class="fintech-cards" id="fintech-cards" aria-label="Selected financial product work">
      <li class="fintech-card">
        <a href="https://matheusserafim.com/will-bank-switching-the-brain/" target="_blank" rel="noopener noreferrer" aria-labelledby="work-will-brand work-will-title">
          <div class="work-art art-bill" aria-hidden="true">
            <img class="work-logo will-logo" src="<?=$asset?>logos/will-bank.svg" alt="">
            <div class="bill-sheet"><b>Simular compra</b><div class="bill-value">R$ 960,00</div><div class="bill-sub">6 parcelas de R$ 160,00</div>
              <div class="bill-months"><span><i></i>fev</span><span><i></i>mar</span><span><i></i>abr</span></div>
            </div>
            <span class="bill-slip"><small>Fatura de fevereiro</small><b>R$ 772,40</b></span>
          </div>
          <div class="work-text"><span id="work-will-brand" class="work-brand">will bank</span>
            <h3 id="work-will-title">See the next bill before buying.</h3>
            <p>I designed a simulator that showed how a purchase would change each monthly bill. The rollout group opened <strong>fewer support tickets</strong> than the control group.</p>
            <span class="work-link">Read the case <?php icon('external'); ?></span>
          </div>
        </a>
      </li>
      <li class="fintech-card">
        <a href="https://matheusserafim.com/western-union-onboarding/" target="_blank" rel="noopener noreferrer" aria-labelledby="work-wu-brand work-wu-title">
          <div class="work-art art-id" aria-hidden="true">
            <img class="work-logo wu-logo" src="<?=$asset?>logos/western-union.svg" alt="">
            <div class="id-pair">
              <div class="id-step id-front"><small>01 / Frente</small><?php echo sera_wu_id_svg('front'); ?></div>
              <div class="id-step id-back"><small>02 / Verso</small><?php echo sera_wu_id_svg('back'); ?></div>
            </div>
          </div>
          <div class="work-text"><span id="work-wu-brand" class="work-brand">Western Union</span>
            <h3 id="work-wu-title">Catch the ID error at the camera.</h3>
            <p>People were sending the front of their ID twice. I gave each side its own capture step. The new onboarding reached <strong>record conversion</strong>.</p>
            <span class="work-link">Read the case <?php icon('external'); ?></span>
          </div>
        </a>
      </li>
      <li class="fintech-card">
        <a href="https://matheusserafim.com/acordo-certo-homepage/" target="_blank" rel="noopener noreferrer" aria-labelledby="work-ac-brand work-ac-title">
          <div class="work-art art-atlas" aria-hidden="true">
            <img class="work-logo ac-logo" src="<?=$asset?>logos/acordo-certo.svg" alt="">
            <div class="atlas-palette"><i></i><i></i><i></i><i></i><i></i></div>
            <div class="atlas-sheet"><span class="atlas-type">Aa</span><div class="atlas-copy"><small>Como funciona</small><b>Consulte seu CPF.</b><span>Ver ofertas <i>→</i></span></div></div>
          </div>
          <div class="work-text"><span id="work-ac-brand" class="work-brand">Acordo Certo</span>
            <h3 id="work-ac-title">Earn trust before asking for an ID.</h3>
            <p>I led a redesign that showed the negotiation steps upfront. We built the pages with our Atlas design system. Homepage and landing page <strong>conversion rose 15%</strong>.</p>
            <span class="work-link">Read the case <?php icon('external'); ?></span>
          </div>
        </a>
      </li>
    </ul>
    <div class="work-foot">
      <a class="work-return" href="#respond">Back to proposal <span aria-hidden="true">↑</span></a>
      <div class="work-controls" hidden>
        <button type="button" data-step="-1" aria-label="Previous case" aria-controls="fintech-cards">←</button>
        <output aria-live="polite" aria-atomic="true">1 / 3</output>
        <button type="button" data-step="1" aria-label="Next case" aria-controls="fintech-cards">→</button>
      </div>
    </div>
  </div>
</section>
