<?php
/**
 * Home — typewriter intro + the two promo cards.
 * Language comes from ?lang=ar (or the /ar rewrite); see lang/.
 */
$lang = (isset($_GET['lang']) && $_GET['lang'] === 'ar') ? 'ar' : 'en';
$T = require __DIR__ . '/lang/' . $lang . '.php';
$altLangUrl = $lang === 'ar' ? '/' : '/ar';
$aboutUrl   = $lang === 'ar' ? '/ar/about' : '/about';
?>
<!DOCTYPE html>
<html lang="<?= $T['code'] ?>" dir="<?= $T['dir'] ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $T['site_title'] ?></title>
    <meta name="description" content="<?= htmlspecialchars($T['home_meta'], ENT_QUOTES) ?>">
    <meta name="author" content="Ahmed Bermawy">
    <meta name="theme-color" content="#667eea">

    <meta property="og:type" content="profile">
    <meta property="og:title" content="<?= $T['site_title'] ?>">
    <meta property="og:description" content="<?= htmlspecialchars($T['home_meta'], ENT_QUOTES) ?>">
    <meta property="og:url" content="https://bermawy.tech/">
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
        } catch (e) { /* private mode — stay on the default theme */ }
    })();
    </script>

    <link rel="stylesheet" href="/assets/css/styles.css?v=12">
</head>
<body>
    <!-- Theme + language switches -->
    <div class="prefs">
        <button id="themeToggle" class="pref-btn" type="button"
                aria-label="<?= $T['theme_toggle'] ?>" title="<?= $T['theme_toggle'] ?>">&#127769;</button>
        <a class="pref-btn" href="<?= $altLangUrl ?>" title="<?= $T['other_label'] ?>"><?= $T['other_label'] ?></a>
    </div>

    <!-- Mentorship Service Card -->
    <div id="mentorshipCard" class="mentorship-card">
        <div class="card-header">
            <h3><?= $T['card_mentor_title'] ?></h3>
            <span class="close-btn" onclick="closeCard('mentorshipCard')">&#x2715;</span>
        </div>
        <div class="card-content">
            <p>&#x1f4a1; <strong><?= $T['card_mentor_lead'] ?></strong></p>
            <ul>
                <?php foreach ($T['card_mentor_items'] as $item): ?>
                <li><?= $item ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="https://topmate.io/ahmed_bermawy" target="_blank" rel="noopener" class="cta-button">
                <?= $T['card_mentor_cta'] ?>
            </a>
        </div>
    </div>

    <!-- Family Tree Card -->
    <div id="familyTreeCard" class="family-tree-card">
        <div class="card-header tree-header">
            <h3><?= $T['card_tree_title'] ?></h3>
            <span class="close-btn" onclick="closeCard('familyTreeCard')">&#x2715;</span>
        </div>
        <div class="card-content">
            <p>&#x1f49a; <strong><?= $T['card_tree_lead'] ?></strong></p>
            <ul>
                <?php foreach ($T['card_tree_items'] as $item): ?>
                <li><?= $item ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="https://family-tree.bermawy.tech" target="_blank" rel="noopener" class="cta-button tree-button">
                <?= $T['card_tree_cta'] ?>
            </a>
        </div>
    </div>

    <!-- ═══════════ HERO (typewriter intro) ═══════════ -->
    <div class="container hero">
        <h1><?= $T['hero_hello'] ?></h1>
        <button id="skipButton"><?= $T['hero_skip'] ?></button>
        <audio id="typewriterSound" src="/assets/sounds/typewriter.mp3"></audio>
        <h2 id="paragraph1"></h2>
    </div>

    <!-- ═══════════ GO TO ABOUT ═══════════ -->
    <div class="home-cta">
        <a class="about-link" href="<?= $aboutUrl ?>">
            <span class="about-link-icon">&#128100;</span>
            <span><?= $T['home_cta'] ?></span>
            <span class="about-link-arrow"><?= $T['dir'] === 'rtl' ? '&larr;' : '&rarr;' ?></span>
        </a>
        <p class="home-cta-hint"><?= $T['home_cta_hint'] ?></p>
    </div>

    <footer class="site-footer">
        <p>&copy; <span id="year"></span> <?= $T['site_title'] ?> — <?= $T['footer_tagline'] ?></p>
    </footer>

    <script>
    function closeCard(id) {
        var card = document.getElementById(id);
        if (card) {
            card.classList.remove('show');
            card.classList.add('hide');
        }
    }
    document.getElementById('year').textContent = new Date().getFullYear();
    </script>
    <script src="/assets/js/dynamicFavicon.js"></script>
    <script src="/assets/js/typeWriter.js"></script>
    <script src="/assets/js/mentorshipCard.js"></script>
    <script src="/assets/js/familyTreeCard.js"></script>
    <script src="/assets/js/prefs.js"></script>
    <script src="/assets/js/main.js"></script>
</body>
</html>
