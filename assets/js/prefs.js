/**
 * Theme preference.
 *
 * The theme is applied before paint by a tiny inline script in <head>
 * (see the pages), so there is never a light flash on a dark-mode visit.
 * This file only wires up the toggle button.
 */
(function () {
  var html = document.documentElement;
  var btn = document.getElementById('themeToggle');
  if (!btn) return;

  function icon(theme) { return theme === 'dark' ? '\u2600\uFE0F' : '\uD83C\uDF19'; }

  // Reflect whichever theme the head script already applied.
  btn.textContent = icon(html.getAttribute('data-theme'));

  btn.addEventListener('click', function () {
    var next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    btn.textContent = icon(next);
    try { localStorage.setItem('ab-theme', next); } catch (e) { /* private mode */ }
  });
})();
