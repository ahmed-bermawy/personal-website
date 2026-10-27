<?php
/**
 * Blog index: the list of posts.
 * Language comes from ?lang=ar; the article strings live in lang/blog.<lang>.php
 */
$lang = (isset($_GET['lang']) && $_GET['lang'] === 'ar') ? 'ar' : 'en';
$T = require __DIR__ . '/lang/' . $lang . '.php';
$B = require __DIR__ . '/lang/blog.' . $lang . '.php';

$homeUrl    = $lang === 'ar' ? '/ar' : '/';
$altLangUrl = $lang === 'ar' ? '/blog' : '/ar/blog';
$aboutUrl   = $lang === 'ar' ? '/ar/about' : '/about';
$arrow      = $T['dir'] === 'rtl' ? '&larr;' : '&rarr;';

/** Build the clean URL for a post slug. */
function post_url(array $post, string $lang): string
{
    return ($lang === 'ar' ? '/ar/blog/' : '/blog/') . $post['slug'];
}
?>
<!DOCTYPE html>
<html lang="<?= $T['code'] ?>" dir="<?= $T['dir'] ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $B['index_title'] ?> | <?= $T['site_title'] ?></title>
    <meta name="description" content="<?= htmlspecialchars($B['index_meta'], ENT_QUOTES) ?>">
    <meta name="author" content="Ahmed Bermawy">
    <meta name="theme-color" content="#667eea">

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $B['index_title'] ?> | <?= $T['site_title'] ?>">
    <meta property="og:description" content="<?= htmlspecialchars($B['index_meta'], ENT_QUOTES) ?>">
    <meta property="og:url" content="https://bermawy.tech/blog">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Apply the stored theme before first paint (no light flash on dark visits) -->
    <script>
    (function () {
        try {
            var t = localStorage.getItem('ab-theme');
            if (!t) {
                t = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-theme', t);
        } catch (e) { /* private mode: stay on the default theme */ }
    })();
    </script>

    <link rel="stylesheet" href="/assets/css/styles.css?v=14">
</head>
<body class="page-blog">
    <!-- Theme + language switches -->
    <div class="prefs">
        <button id="themeToggle" class="pref-btn" type="button"
                aria-label="<?= $T['theme_toggle'] ?>" title="<?= $T['theme_toggle'] ?>">&#127769;</button>
        <a class="pref-btn" href="<?= $altLangUrl ?>" title="<?= $T['other_label'] ?>"><?= $T['other_label'] ?></a>
    </div>

    <!-- Back to home -->
    <nav class="top-nav">
        <div class="nav-links">
            <a href="<?= $homeUrl ?>" class="nav-back"><?= $arrow ?> <?= $T['nav_home'] ?></a>
            <a href="<?= $aboutUrl ?>" class="nav-back"><?= $B['nav_about'] ?></a>
        </div>
        <span class="nav-file"><?= $B['nav_file'] ?></span>
    </nav>

    <header class="page-head">
        <h1><?= $B['index_title'] ?></h1>
        <p class="page-sub"><span class="cursor">&#9614;</span> <?= $B['index_sub'] ?></p>
    </header>

    <!-- ═══════════ POSTS ═══════════ -->
    <section class="section" id="posts">
        <?php if (empty($B['posts'])): ?>
        <p class="lead muted"><?= $B['empty'] ?></p>
        <?php else: ?>
        <div class="blog-grid">
            <?php foreach ($B['posts'] as $post): ?>
            <article class="post-card">
                <div class="post-meta">
                    <span>&#128197; <?= htmlspecialchars($post['date_label']) ?></span>
                    <span class="dot">&middot;</span>
                    <span>&#9201; <?= htmlspecialchars($post['read_time']) ?></span>
                </div>
                <h3><a href="<?= post_url($post, $lang) ?>"><?= $post['title'] ?></a></h3>
                <p class="post-excerpt"><?= htmlspecialchars($post['excerpt']) ?></p>
                <div class="tags">
                    <?php foreach ($post['tags'] as $tag): ?>
                    <span class="tag tag-sm"><?= htmlspecialchars($tag) ?></span>
                    <?php endforeach; ?>
                </div>
                <a class="project-link" href="<?= post_url($post, $lang) ?>">
                    <?= $B['read_post'] ?> <span class="project-arrow"><?= $arrow ?></span>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>

    <footer class="site-footer">
        <p>&copy; <span id="year"></span> <?= $T['site_title'] ?>, <a href="<?= $homeUrl ?>"><?= $B['back_home'] ?></a></p>
    </footer>

    <script>
    document.getElementById('year').textContent = new Date().getFullYear();
    </script>
    <noscript><style>.section{opacity:1;transform:none}</style></noscript>
    <script src="/assets/js/sections.js?v=13"></script>
    <script src="/assets/js/prefs.js"></script>
</body>
</html>
