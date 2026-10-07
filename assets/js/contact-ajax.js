// /assets/js/contact-ajax.js
(function () {
  'use strict';

  // ---------- SweetAlert helpers ----------
  const sw = (opts) => {
    if (window.Swal && Swal.fire) return Swal.fire(opts);
    // graceful fallback
    alert((opts.icon ? opts.icon.toUpperCase() + ': ' : '') + (opts.title || opts.text || ''));
  };
  const swError = (title, text) => sw({ icon: 'error', title: title || 'Error', text: text || 'Something went wrong.' });
  const swWarn  = (title, text) => sw({ icon: 'warning', title: title || 'Warning', text: text || '' });
  const swOk    = (title, text) => sw({ icon: 'success', title: title || 'Success', text: text || '', timer: 2200, showConfirmButton: false });

  // ---------- Optional: global error catchers ----------
  window.addEventListener('error', (e) => {
    // Avoid double-alerts from same error
    if (e.__handled) return;
    e.__handled = true;
    swError('Script error', `${e.message || 'Unknown error'}\n${e.filename || ''}:${e.lineno || ''}`);
  });

  window.addEventListener('unhandledrejection', (e) => {
    const r = e.reason || {};
    const msg = (r && (r.message || r.statusText)) || String(r);
    swError('Unhandled error', msg);
  });

  // ---------- Spinner helpers (keeps your theme markup) ----------
  function setLoading(btn, on) {
    if (!btn) return;
    const textSpan = btn.querySelector('.thm-btn-text') || btn;
    const iconBox  = btn.querySelector('.thm-btn-icon-box');
    if (on) {
      btn.disabled = true;
      btn.setAttribute('aria-busy', 'true');
      btn.dataset._origHtml = textSpan.innerHTML;
      const loadingText = btn.dataset.loadingText || 'Loading';
      textSpan.innerHTML = `<span class="btn-loading-spinner" aria-hidden="true"></span>${loadingText}`;
      if (iconBox) iconBox.style.display = 'none';
    } else {
      btn.disabled = false;
      btn.removeAttribute('aria-busy');
      if (btn.dataset._origHtml) {
        (btn.querySelector('.thm-btn-text') || btn).innerHTML = btn.dataset._origHtml;
        delete btn.dataset._origHtml;
      }
      const iconBox2 = btn.querySelector('.thm-btn-icon-box');
      if (iconBox2) iconBox2.style.display = '';
    }
  }

  function attachAjaxHandler(form) {
    const endpoint = form.dataset.endpoint || form.getAttribute('action') || '/send_mail.php';
    const method   = (form.dataset.method || 'POST').toUpperCase();
    const submitBtn = form.querySelector('[type="submit"]');
    const debug = form.dataset.debug === 'true'; // set data-debug="true" on form to see snippets

    // Tolerant selectors (handles Name/name, Phone/phone, etc.)
 const S = {
  name:    '[name="name"],[name="Name"]',
  email:   '[name="email"],[name="Email"]',
  phone:   '[name="phone"],[name="Phone"],[name="PHONE"]',
  subject: '[name="subject"],[name="Subject"],[name="SUBJECT"]',
  message: '[name="message"],[name="Message"]'
};
    async function handleSubmit(e) {
      e.preventDefault();

      // Basic required checks
      const required = ['name','email','phone','subject','message'];
      for (const f of required) {
        const el = form.querySelector(S[f]);
        if (!el || !el.value.trim()) {
          swWarn('Missing info', `Please provide ${f}.`);
          el && el.focus();
          return;
        }
      }

      setLoading(submitBtn, true);

      try {
        const formData = new FormData(form);
        const res = await fetch(endpoint, { method, body: formData });

        const ct = (res.headers.get('content-type') || '').toLowerCase();
        let data = null, text = null;

        if (ct.includes('application/json')) {
          data = await res.json().catch(() => null);
        } else {
          text = await res.text().catch(() => '');
        }

        // If HTTP status is not OK, show detailed error
        if (!res.ok) {
          const msgFromJson = data && (data.message || data.error || data.errors && JSON.stringify(data.errors));
          const msgFromHtml = text && text.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
          const snippet = (msgFromJson || msgFromHtml || '').slice(0, 300);
          swError(`${res.status} ${res.statusText || 'Request failed'}`, snippet || 'Please try again later.');
          return;
        }

        // If JSON says ok:false, show its message
        if (data && data.ok === false) {
          swError('Something went wrong', data.message || 'Please try again later.');
          return;
        }

        // Success case (JSON ok:true OR non-JSON 200 we assume success if your endpoint always returns JSON—prefer JSON)
        if (data && data.ok) {
          swOk('Email sent!', form.dataset.success || 'Thanks! We’ll get back to you soon.');
          form.reset();
        } else {
          // If server returned 200 but not JSON, optionally show snippet in debug
          if (debug && text) {
            swOk('Request completed', `Non-JSON response (first 200 chars): ${text.slice(0,200)}`);
          } else {
            // If your endpoint always returns JSON, reaching here means unexpected format
            swOk('Email sent!', form.dataset.success || 'Thanks! We’ll get back to you soon.');
            form.reset();
          }
        }
      } catch (err) {
        const msg = (err && (err.message || err.statusText)) ? String(err.message || err.statusText) : 'Network error';
        swError('Network error', msg);
        console.error(err);
      } finally {
        setLoading(submitBtn, false);
      }
    }

    // Use capture so we beat other submit listeners that might stop propagation
    form.addEventListener('submit', handleSubmit, { capture: true });
  }

  function initAjaxContactForms() {
    document.querySelectorAll('form.ajax-contact').forEach(attachAjaxHandler);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAjaxContactForms);
  } else {
    initAjaxContactForms();
  }

  window.initAjaxContactForms = initAjaxContactForms;
})();
