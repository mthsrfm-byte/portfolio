/* Sera · private proposals. Progressive enhancement only: every form also works without JS.
   The access check, records and terms all live on the server (inc/proposals.php). */
(function () {
  'use strict';
  var root = document.documentElement;
  root.classList.remove('no-js');
  root.classList.add('js');

  var PREVIEW = root.hasAttribute('data-preview');
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var MSG = {
    code: "That code doesn't match. Please try again.",
    locked: 'Too many attempts. Please try again later.',
    unavailable: "This proposal isn't available right now.",
    session: 'Your session has ended. Reload the page and enter your code again.',
    token: 'Your session has ended. Reload the page and enter your code again.',
    origin: 'This request was blocked. Reload the page and try again.',
    email: 'Enter a valid work email, like name@company.com.',
    name: 'Enter your full name.',
    confirm: 'Tick the confirmation box to accept the proposal.',
    version: 'This proposal was updated. Reload the page to review the current version.',
    save: "Your acceptance wasn't saved. Please try again.",
    busy: 'Too many requests. Please wait a moment and try again.',
    'q-email': 'Enter a valid email so I can reply.',
    'q-message': 'Write a message before sending.',
    'q-long': 'Keep the message under 4,000 characters.',
    'q-save': "Your message wasn't sent. Please try again.",
    network: "Couldn't reach the server. Check your connection and try again.",
    unknown: 'Something went wrong. Please try again.'
  };
  var EMAIL = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

  function $(sel, ctx) { return (ctx || document).querySelector(sel); }
  function $$(sel, ctx) { return Array.prototype.slice.call((ctx || document).querySelectorAll(sel)); }

  /* ---------- network (real endpoint, or a stand-in in the static preview) ---------- */
  function send(form) {
    if (PREVIEW) { return previewSend(form); }
    return fetch(form.getAttribute('action').split('#')[0], {
      method: 'POST',
      body: new FormData(form),
      credentials: 'same-origin',
      headers: { Accept: 'application/json' },
      cache: 'no-store'
    }).then(function (r) {
      return r.json().catch(function () { return { ok: false, error: 'unknown' }; });
    }, function () { return { ok: false, error: 'network' }; });
  }

  function previewSend(form) {
    var fd = new FormData(form);
    var act = fd.get('sera_action');
    return new Promise(function (done) {
      setTimeout(function () {
        if (act === 'unlock') {
          done(String(fd.get('code')) === '0000' ? { ok: false, error: 'code' } : { ok: true });
        } else {
          done({ ok: true });
        }
      }, 650);
    });
  }

  function busy(btn, on) {
    if (!btn) { return; }
    btn.classList.toggle('is-busy', on);
    btn.disabled = on;
    btn.setAttribute('aria-busy', on ? 'true' : 'false');
  }

  /* ---------- gate ---------- */
  var gate = $('[data-prop-form="unlock"]');
  if (gate) {
    var code = $('#gate-code', gate);
    var msg = $('#gate-msg', gate);
    var card = gate.closest('.gate-card');
    code.addEventListener('input', function () {
      var v = code.value.replace(/\D/g, '').slice(0, 4);
      if (v !== code.value) { code.value = v; }
      code.removeAttribute('aria-invalid');
      if (msg.classList.contains('is-error')) { msg.textContent = ''; msg.classList.remove('is-error'); }
      if (v.length === 4 && !code.disabled) { gate.requestSubmit ? gate.requestSubmit() : gate.submit(); }
    });
    gate.addEventListener('submit', function (e) {
      e.preventDefault();
      var btn = $('button[type="submit"]', gate);
      if (!/^\d{4}$/.test(code.value)) {
        fail('Enter all four digits.');
        return;
      }
      busy(btn, true);
      send(gate).then(function (res) {
        if (res.ok) {
          msg.textContent = 'Opening the proposal…';
          if (PREVIEW) { previewOpen(); busy(btn, false); return; }
          window.location.reload();
          return;
        }
        busy(btn, false);
        fail(MSG[res.error] || MSG.unknown);
        if (res.error === 'locked' || res.error === 'unavailable') {
          code.disabled = true;
          btn.disabled = true;
        }
      });
    });
    function fail(text) {
      msg.textContent = text;
      msg.classList.add('is-error');
      code.setAttribute('aria-invalid', 'true');
      code.select();
      if (!reduce && card) {
        card.classList.remove('gate-shake');
        void card.offsetWidth;
        card.classList.add('gate-shake');
      }
    }
  }

  function previewOpen() {
    var g = $('[data-preview-gate]');
    var p = $('[data-preview-page]');
    if (!g || !p) { return; }
    g.hidden = true;
    p.hidden = false;
    document.title = p.getAttribute('data-title') || document.title;
    window.scrollTo(0, 0);
    var h = $('#hero-title');
    if (h) { h.setAttribute('tabindex', '-1'); h.focus({ preventScroll: true }); }
    initPage();
  }

  /* ---------- proposal page ---------- */
  var started = false;
  function initPage() {
    if (started || !$('.p-hero')) { return; }
    started = true;
    if (PREVIEW && $('[data-preview-page]') && $('[data-preview-page]').hidden) { started = false; return; }

    // Sticky bar state: scrolled, dark over the investment block, current section.
    var bar = $('[data-prop-bar]');
    var darks = $$('[data-dark]');
    var links = $$('.p-bar-nav a');
    function onScroll() {
      if (!bar) { return; }
      bar.classList.toggle('is-scrolled', window.scrollY > 8);
      bar.classList.toggle('is-dark', darks.some(function (d) {
        var r = d.getBoundingClientRect();
        return r.top < 40 && r.bottom > 40;
      }));
      var here = null;
      links.forEach(function (a) {
        var s = $(a.getAttribute('href'));
        if (s && s.getBoundingClientRect().top < window.innerHeight * 0.35) { here = a; }
      });
      links.forEach(function (a) {
        var on = a === here;
        a.classList.toggle('is-here', on);
        if (on) { a.setAttribute('aria-current', 'true'); } else { a.removeAttribute('aria-current'); }
      });
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // The one orchestrated moment: the ten-day ruler draws in when it reaches the viewport.
    var ruler = $('.p-ruler');
    if (ruler) {
      if (reduce || !('IntersectionObserver' in window)) {
        ruler.classList.add('is-in');
      } else {
        var io = new IntersectionObserver(function (entries) {
          entries.forEach(function (en) {
            if (en.isIntersecting) { ruler.classList.add('is-in'); io.disconnect(); }
          });
        }, { threshold: 0.35 });
        io.observe(ruler);
      }
    }

    // Work deck: cards are dealt into the row once, then lean towards the pointer a little.
    var deck = $('[data-deck]');
    if (deck) {
      var deal = function () {
        deck.classList.add('is-in');
        setTimeout(function () { deck.classList.add('is-dealt'); }, reduce ? 0 : 1500);
      };
      if (reduce || !('IntersectionObserver' in window)) {
        deal();
      } else {
        var dio = new IntersectionObserver(function (entries) {
          entries.forEach(function (en) {
            if (en.isIntersecting) { deal(); dio.disconnect(); }
          });
        }, { threshold: 0.3 });
        dio.observe(deck);
      }
      var fine = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;
      if (fine && !reduce) {
        $$('.p-card', deck).forEach(function (card) {
          card.addEventListener('pointermove', function (e) {
            var r = card.getBoundingClientRect();
            var x = (e.clientX - r.left) / r.width;
            var y = (e.clientY - r.top) / r.height;
            card.style.setProperty('--ry', ((x - 0.5) * 10).toFixed(2) + 'deg');
            card.style.setProperty('--rx', ((0.5 - y) * 8).toFixed(2) + 'deg');
            card.style.setProperty('--mx', (x * 100).toFixed(1) + '%');
            card.style.setProperty('--my', (y * 100).toFixed(1) + '%');
          });
          card.addEventListener('pointerleave', function () {
            card.style.setProperty('--rx', '0deg');
            card.style.setProperty('--ry', '0deg');
          });
        });
      }
    }

    // Token demo.
    var demo = $('[data-prop-demo]');
    if (demo) {
      var screens = $('.p-demo-screens', demo);
      $$('.p-sw', demo).forEach(function (b) {
        b.addEventListener('click', function () {
          $$('.p-sw', demo).forEach(function (o) {
            var on = o === b;
            o.classList.toggle('is-on', on);
            o.setAttribute('aria-pressed', on ? 'true' : 'false');
          });
          screens.setAttribute('data-demo-theme', b.getAttribute('data-theme'));
        });
      });
    }

    // Questions: collapsed behind "I have questions" until asked for (always open without JS).
    var qs = $('[data-questions]');
    var opener = $('[data-open-questions]');
    var qOk = $('[data-q-ok]');
    var keepOpen = !opener || location.hash === '#questions' || (qOk && qOk.classList.contains('is-on')) || ($('[data-err]', qs) && $('[data-err]', qs).textContent.trim() !== '');
    if (qs && !keepOpen) {
      qs.classList.add('is-closed');
      opener.setAttribute('aria-expanded', 'false');
    }
    if (opener && qs) {
      opener.addEventListener('click', function (e) {
        e.preventDefault();
        qs.classList.remove('is-closed');
        opener.setAttribute('aria-expanded', 'true');
        qs.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'start' });
        var t = $('#q-msg');
        if (t) { setTimeout(function () { t.focus({ preventScroll: true }); }, reduce ? 0 : 350); }
      });
    }

    $$('[data-prop-form="accept"], [data-prop-form="question"]').forEach(wireForm);
  }

  function wireForm(form) {
    var kind = form.getAttribute('data-prop-form');
    var err = $('[data-err]', form);
    var btn = $('button[type="submit"]', form);
    var sending = false;

    $$('input, textarea', form).forEach(function (el) {
      el.addEventListener('input', function () { el.removeAttribute('aria-invalid'); });
      el.addEventListener('change', function () { el.removeAttribute('aria-invalid'); });
    });

    function show(code, field) {
      err.textContent = MSG[code] || MSG.unknown;
      $$('[aria-invalid]', form).forEach(function (el) { el.removeAttribute('aria-invalid'); });
      if (field) {
        field.setAttribute('aria-invalid', 'true');
        field.focus();
      }
    }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (sending) { return; }
      err.textContent = '';
      var email = $('[name="email"]', form);
      if (kind === 'accept') {
        var name = $('[name="name"]', form);
        var ok = $('[name="confirm"]', form);
        if (!name.value.trim()) { return show('name', name); }
        if (!EMAIL.test(email.value.trim())) { return show('email', email); }
        if (!ok.checked) { return show('confirm', ok); }
      } else {
        var m = $('[name="message"]', form);
        if (!EMAIL.test(email.value.trim())) { return show('q-email', email); }
        if (!m.value.trim()) { return show('q-message', m); }
        if (m.value.length > 4000) { return show('q-long', m); }
      }
      sending = true;
      busy(btn, true);
      send(form).then(function (res) {
        sending = false;
        busy(btn, false);
        if (!res.ok) {
          var map = { email: email, 'q-email': email, name: $('[name="name"]', form), confirm: $('[name="confirm"]', form), 'q-message': $('[name="message"]', form), 'q-long': $('[name="message"]', form) };
          show(res.error, map[res.error] || null);
          return;
        }
        if (kind === 'accept') {
          var done = $('[data-done]');
          form.remove();
          done.hidden = false;
          done.classList.add('is-on', 'is-new');
          done.focus();
          var cta = $('.p-bar-cta');
          if (cta) { cta.textContent = 'Accepted'; }
          var qs = $('[data-questions]');
          if (qs) { qs.classList.remove('is-closed'); }
        } else {
          var qOk = $('[data-q-ok]');
          qOk.textContent = 'Your message has been received. I’ll get back to you shortly.';
          qOk.classList.add('is-on');
          $('[name="message"]', form).value = '';
          qOk.setAttribute('tabindex', '-1');
          qOk.focus();
        }
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPage);
  } else {
    initPage();
  }
})();
