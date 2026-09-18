/**
 * Section reveal on scroll.
 * Sections fade + slide in the first time they enter the viewport,
 * matching the typewriter feel of the landing hero.
 */
(function () {
  var sections = document.querySelectorAll('.section');

  if (!('IntersectionObserver' in window)) {
    // No observer support — just show everything.
    sections.forEach(function (el) { el.classList.add('visible'); });
    return;
  }

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
  );

  sections.forEach(function (el) { observer.observe(el); });

  // The hero is above the fold — reveal it immediately.
  var hero = document.querySelector('.hero');
  if (hero) { requestAnimationFrame(function () { hero.classList.add('visible'); }); }
})();
