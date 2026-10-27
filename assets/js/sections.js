/**
 * Section reveal on scroll.
 * Sections fade + slide in the first time they enter the viewport,
 * matching the typewriter feel of the landing hero.
 *
 * IMPORTANT: the threshold stays at 0.
 * A section can be taller than the viewport, a long blog post is a single
 * .section, and a fractional threshold is unreachable for those: the visible
 * share never reaches it, so the observer never fires and the whole article
 * stays at opacity 0. That looks exactly like "the page is blank until I
 * scroll". Threshold 0 fires as soon as any part of the section is on screen.
 */
(function () {
  var sections = document.querySelectorAll('.section');

  function reveal(el) { el.classList.add('visible'); }

  if (!('IntersectionObserver' in window)) {
    // No observer support, just show everything.
    sections.forEach(reveal);
    return;
  }

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          reveal(entry.target);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0, rootMargin: '0px 0px -40px 0px' }
  );

  sections.forEach(function (el) { observer.observe(el); });

  // Anything already on screen at load shows straight away. This also covers a
  // restored scroll position, where a section starts above the viewport and so
  // would never intersect.
  sections.forEach(function (el) {
    var rect = el.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom > 0) {
      requestAnimationFrame(function () { reveal(el); });
    }
  });

  // The hero is above the fold, reveal it immediately.
  var hero = document.querySelector('.hero');
  if (hero) { requestAnimationFrame(function () { reveal(hero); }); }
})();
