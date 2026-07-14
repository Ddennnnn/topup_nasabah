(function () {
  function qs(sel) {
    return document.querySelector(sel);
  }

  function qsa(sel) {
    return Array.prototype.slice.call(document.querySelectorAll(sel));
  }

  // Navbar shadow on scroll
  function initNavbarShadow() {
    var nav = qs('.landing-navbar');
    if (!nav) return;

    var onScroll = function () {
      if (window.scrollY > 8) nav.classList.add('is-scrolled');
      else nav.classList.remove('is-scrolled');
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  // Smooth scroll for anchor links (Bootstrap can do it if data-bs; we ensure it)
  function initSmoothScroll() {
    qsa('a[data-scroll-to]').forEach(function (a) {
      a.addEventListener('click', function (e) {
        var targetId = a.getAttribute('data-scroll-to');
        if (!targetId) return;
        var el = document.getElementById(targetId);
        if (!el) return;

        e.preventDefault();
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  }

  // Fade-in reveal
  function initReveal() {
    if (!('IntersectionObserver' in window)) {
      qsa('.reveal').forEach(function (el) {
        el.classList.add('is-visible');
      });
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );

    qsa('.reveal').forEach(function (el) {
      observer.observe(el);
    });
  }

  // Counter animation
  function initCounters() {
    var nodes = qsa('[data-counter]');
    if (!nodes.length) return;

    function animate(el, duration) {
      var target = parseFloat(el.getAttribute('data-counter')) || 0;
      var suffix = el.getAttribute('data-counter-suffix') || '';
      var decimals = parseInt(el.getAttribute('data-counter-decimals') || '0', 10);
      var start = 0;
      var startTime = null;

      function tick(ts) {
        if (!startTime) startTime = ts;
        var progress = Math.min((ts - startTime) / duration, 1);

        // Ease out
        var eased = 1 - Math.pow(1 - progress, 3);
        var value = start + (target - start) * eased;

        var formatted = value.toFixed(decimals);
        if (decimals === 0) formatted = String(Math.round(value));

        el.textContent = formatted + suffix;

        if (progress < 1) requestAnimationFrame(tick);
      }

      requestAnimationFrame(tick);
    }

    if (!('IntersectionObserver' in window)) {
      nodes.forEach(function (el) {
        animate(el, 900);
      });
      return;
    }

    var obs = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            animate(entry.target, 1000);
            obs.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.25 }
    );

    nodes.forEach(function (el) {
      obs.observe(el);
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    initNavbarShadow();
    initSmoothScroll();
    initReveal();
    initCounters();
  });
})();

