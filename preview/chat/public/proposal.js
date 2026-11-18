const pin = document.getElementById('code');
if (pin) {
  const wrapper = pin.closest('.pin-wrap');
  const cells = Array.from(wrapper.querySelectorAll('.pin-cells i'));
  function reflect() {
    pin.value = pin.value.replace(/[^0-9]/g, '').slice(0, 4);
    cells.forEach((cell, index) => {
      cell.classList.toggle('filled', index < pin.value.length);
      cell.classList.toggle('next', index === Math.min(pin.value.length, 3));
    });
  }
  wrapper.classList.add('enhanced');
  pin.addEventListener('input', reflect);
  window.addEventListener('pageshow', reflect);
  reflect();
}
for (const form of document.forms) {
  form.addEventListener('submit', event => {
    const button = event.submitter;
    if (!button || !button.dataset.busy) return;
    if (form.dataset.sending) { event.preventDefault(); return; }
    form.dataset.sending = '1';
    button.dataset.original = button.innerHTML;
    button.textContent = button.dataset.busy;
    button.setAttribute('aria-busy', 'true');
  });
}
window.addEventListener('pageshow', () => {
  for (const button of document.querySelectorAll('button[data-original]')) {
    button.innerHTML = button.dataset.original;
    delete button.dataset.original;
    delete button.form.dataset.sending;
    button.removeAttribute('aria-busy');
  }
});
const notice = document.querySelector('.success');
if (notice) notice.focus({preventScroll:true});
