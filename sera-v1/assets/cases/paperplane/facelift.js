/* Facelift do case: rótulo do capítulo, grifo que dobra e tema por zona. Roda antes do pp-case.js. */
(function () {
  document.querySelectorAll('.pp-case .pp-kicker').forEach(function (k) {
    var m = /^(\d{2})\s·\s(.+)$/.exec(k.textContent.trim()); if (!m) return
    k.innerHTML = '<span class="pp-kn">' + m[1] + '</span><span class="pp-kl"></span>'; k.lastChild.textContent = m[2]
  })
  var GRIFOS = { 'cenario-t': ['a fatura no escuro', 'the bill in the dark'], 'produto-t': ['dez etapas', 'ten steps'], 'preco-t': ['antes do clique', 'before the click'], 'redesign-t': ['sério por baixo do capô', 'serious under the hood'], 'micro-t': ['o seu dinheiro', 'your money'], 'dobra-t': ['o estúdio inteiro', 'the whole studio'], 'site-t': ['a mesma língua', 'the studio’s language'], 'celular-t': ['no seu bolso', 'in your pocket'], 'turno-t': ['eu escolho', 'I choose'], 'numeros-t': ['oito números', 'eight numbers'], 'aprendi-t': ['o que vem agora', 'what comes next'], 'fecho-t': ['já está no ar', 'is live'] }
  Object.keys(GRIFOS).forEach(function (id) {
    var h = document.getElementById(id); if (!h) return
    GRIFOS[id].some(function (txt) {
      var i = h.innerHTML.lastIndexOf(txt); if (i < 0) return false
      h.innerHTML = h.innerHTML.slice(0, i) + '<span class="grifo-pp" data-dobra="' + txt + '">' + txt + '</span>' + h.innerHTML.slice(i + txt.length); return true
    })
  })
  var kw = document.getElementById('kw'); if (kw) kw.setAttribute('data-dobra', kw.textContent.trim())
})();
/* Tema pela zona que está no meio da tela: recalcula a cada rolagem, sem depender de posições guardadas. */
(function () {
  var root = document.documentElement, pedido = 0
  function aplicar() {
    pedido = 0
    var meio = innerHeight * 0.5, zonas = document.querySelectorAll('.pp-case .pp-zone')
    for (var i = 0; i < zonas.length; i++) {
      var r = zonas[i].getBoundingClientRect()
      if (r.top <= meio && r.bottom > meio) {
        var t = zonas[i].dataset.theme
        if (root.dataset.theme !== t) root.dataset.theme = t
        var h = document.querySelector('.site-header')
        if (h) { h.classList.toggle('v2-dark', t === 'dark'); h.classList.toggle('hdr-escuro', t === 'dark') }
        return
      }
    }
  }
  function pedir() { if (!pedido) pedido = requestAnimationFrame(aplicar) }
  addEventListener('scroll', pedir, { passive: true })
  addEventListener('resize', pedir)
  addEventListener('load', function () { pedir(); setTimeout(pedir, 500); if (window.ScrollTrigger) { ScrollTrigger.refresh(); setTimeout(function () { ScrollTrigger.refresh() }, 2000) } })
  setInterval(pedir, 400)
})()
