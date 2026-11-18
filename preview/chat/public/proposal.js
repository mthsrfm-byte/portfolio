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
function showFeedback(form, success, text) {
  let notice = form.querySelector('.client-feedback');
  if (!notice) {
    notice = document.createElement('p');
    notice.tabIndex = -1;
    form.appendChild(notice);
  }
  notice.className = 'client-feedback ' + (success ? 'success' : 'error');
  notice.setAttribute('role', success ? 'status' : 'alert');
  notice.textContent = text;
  notice.focus({preventScroll:true});
  return notice;
}

for (const form of document.forms) {
  form.addEventListener('submit', async event => {
    const button = event.submitter;
    if (!button || !button.dataset.busy) return;
    if (form.dataset.sending) { event.preventDefault(); return; }
    const action = form.elements.namedItem('action').value;
    const isReply = (action === 'question' || action === 'accept') && window.fetch;
    if (isReply) event.preventDefault();
    form.dataset.sending = '1';
    button.dataset.original = button.innerHTML;
    button.textContent = button.dataset.busy;
    button.setAttribute('aria-busy', 'true');
    if (!isReply) return;
    try {
      const response = await fetch(form.action, {
        method:'POST', credentials:'same-origin', headers:{Accept:'application/json'},
        body:new URLSearchParams(new FormData(form))
      });
      const result = await response.json();
      if (!response.ok || result.saved !== true) {
        const notice = showFeedback(form, false, result.error || 'We couldn’t confirm the save. Please try again.');
        if (result.unlock) {
          const link = document.createElement('a');
          link.href = location.pathname;
          link.textContent = 'Open the access gate';
          notice.append(' ',link);
        }
        return;
      }
      form.reset();
      if (action === 'question') {
        form.elements.namedItem('request').value = result.next;
        showFeedback(form,true,'Test question received. Your message has been saved with your email.');
      } else {
        showFeedback(form,true,'Test acceptance recorded. Your response and the terms of this edition have been saved.');
      }
    } catch {
      showFeedback(form,false,'We couldn’t confirm the save. Your details are still here. Check your connection and try again.');
    } finally {
      restoreButton(button);
    }
  });
}

function restoreButton(button) {
  button.innerHTML = button.dataset.original;
  delete button.dataset.original;
  delete button.form.dataset.sending;
  button.removeAttribute('aria-busy');
}
window.addEventListener('pageshow', () => {
  document.querySelectorAll('button[data-original]').forEach(restoreButton);
});
const notice = document.querySelector('.success');
if (notice) notice.focus({preventScroll:true});
