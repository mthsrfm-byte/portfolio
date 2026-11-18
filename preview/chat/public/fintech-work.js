(() => {
  const rail = document.getElementById('fintech-cards');
  if (!rail) return;

  const cards = Array.from(rail.children);
  const controls = rail.parentElement.querySelector('.work-controls');
  const previous = controls.querySelector('[data-step="-1"]');
  const next = controls.querySelector('[data-step="1"]');
  const progress = controls.querySelector('output');
  const compact = window.matchMedia('(max-width: 760px)');
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)');

  if ('IntersectionObserver' in window && !reduced.matches) {
    const entrance = new IntersectionObserver(entries => {
      for (const entry of entries) {
        if (entry.isIntersecting) {
          entry.target.classList.add('work-seen');
          entrance.unobserve(entry.target);
        }
      }
    }, {threshold: 0.4});
    cards.forEach(card => entrance.observe(card));
  }

  function positions() {
    const first = cards[0].getBoundingClientRect().left;
    const end = rail.scrollWidth - rail.clientWidth;
    return cards.map(card => Math.min(end, card.getBoundingClientRect().left - first));
  }

  function current() {
    const stops = positions();
    return stops.reduce((nearest, stop, index) =>
      Math.abs(stop - rail.scrollLeft) < Math.abs(stops[nearest] - rail.scrollLeft) ? index : nearest, 0);
  }

  function sync() {
    controls.hidden = !compact.matches;
    if (controls.hidden) return;
    const index = current();
    const label = (index + 1) + ' / ' + cards.length;
    if (progress.value !== label) progress.value = label;
    previous.disabled = index === 0;
    next.disabled = index === cards.length - 1;
  }

  controls.addEventListener('click', event => {
    const button = event.target.closest('button[data-step]');
    if (!button) return;
    const index = Math.max(0, Math.min(cards.length - 1, current() + Number(button.dataset.step)));
    rail.scrollTo({left: positions()[index], behavior: reduced.matches ? 'auto' : 'smooth'});
  });
  rail.addEventListener('scroll', sync, {passive:true});
  window.addEventListener('resize', sync);
  sync();
})();
