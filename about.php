<?php
/**
 * About page — the full CV: whoami, experience, skills, projects, education, contact.
 * Language comes from ?lang=ar (or the /ar/about rewrite); see lang/.
 */
$lang = (isset($_GET['lang']) && $_GET['lang'] === 'ar') ? 'ar' : 'en';
$T = require __DIR__ . '/lang/' . $lang . '.php';
$homeUrl    = $lang === 'ar' ? '/ar' : '/';
$altLangUrl = $lang === 'ar' ? '/about' : '/ar/about';
$arrow      = $T['dir'] === 'rtl' ? '&larr;' : '&rarr;';
?>
<!DOCTYPE html>
<html lang="<?= $T['code'] ?>" dir="<?= $T['dir'] ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $T['about_title'] ?> — <?= $T['site_title'] ?></title>
    <meta name="description" content="<?= htmlspecialchars($T['about_meta'], ENT_QUOTES) ?>">
    <meta name="author" content="Ahmed Bermawy">
    <meta name="theme-color" content="#667eea">

    <meta property="og:type" content="profile">
    <meta property="og:title" content="<?= $T['about_title'] ?> — <?= $T['site_title'] ?>">
    <meta property="og:description" content="<?= htmlspecialchars($T['about_meta'], ENT_QUOTES) ?>">
    <meta property="og:url" content="https://bermawy.tech/about">
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
<body class="page-about">
    <!-- Theme + language switches -->
    <div class="prefs">
        <button id="themeToggle" class="pref-btn" type="button"
                aria-label="<?= $T['theme_toggle'] ?>" title="<?= $T['theme_toggle'] ?>">&#127769;</button>
        <a class="pref-btn" href="<?= $altLangUrl ?>" title="<?= $T['other_label'] ?>"><?= $T['other_label'] ?></a>
    </div>

    <!-- Back to home -->
    <nav class="top-nav">
        <a href="<?= $homeUrl ?>" class="nav-back"><?= $arrow ?> <?= $T['nav_home'] ?></a>
        <span class="nav-file"><?= $T['nav_file'] ?></span>
    </nav>

    <header class="page-head">
        <h1><?= $T['about_title'] ?></h1>
        <p class="page-sub"><span class="cursor">&#9614;</span> <?= $T['about_sub'] ?></p>
    </header>

    <!-- ═══════════ WHOAMI ═══════════ -->
    <section class="section" id="about">
        <h2 class="section-title"><?= $T['sec_whoami'] ?></h2>
        <p class="lead"><?= $T['whoami_p1'] ?></p>
        <p class="lead muted"><?= $T['whoami_p2'] ?></p>

        <div class="stats">
            <div class="stat"><span class="stat-num">13+</span><span class="stat-label"><?= $T['stat_years'] ?></span></div>
            <div class="stat"><span class="stat-num">7</span><span class="stat-label"><?= $T['stat_companies'] ?></span></div>
            <div class="stat"><span class="stat-num">5+</span><span class="stat-label"><?= $T['stat_leading'] ?></span></div>
            <div class="stat"><span class="stat-num">4</span><span class="stat-label"><?= $T['stat_countries'] ?></span></div>
        </div>
    </section>

    <!-- ═══════════ EXPERIENCE ═══════════ -->
    <section class="section" id="experience">
        <h2 class="section-title"><?= $T['sec_experience'] ?></h2>

        <div class="timeline">
            <?php foreach ($T['exp'] as $job): ?>
            <article class="timeline-item">
                <div class="timeline-head">
                    <h3>
                        <?= $job['role'] ?>
                        <?php if (!empty($job['note'])): ?>
                        <span class="role-note"><?= $job['note'] ?></span>
                        <?php endif; ?>
                    </h3>
                    <span class="timeline-date"><?= $job['date'] ?></span>
                </div>
                <div class="timeline-company">
                    <?= $job['company'] ?> <span class="dot">&middot;</span> <?= $job['place'] ?>
                </div>
                <ul>
                    <?php foreach ($job['points'] as $point): ?>
                    <li><?= $point ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php if (!empty($job['projects'])): ?>
                <div class="projects">
                    <span class="projects-label"><?= $job['projects_label'] ?></span>
                    <?php foreach ($job['projects'] as $project): ?>
                    <span class="tag tag-sm"><?= $project ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ═══════════ SKILLS ═══════════ -->
    <section class="section" id="skills">
        <h2 class="section-title"><?= $T['sec_skills'] ?></h2>

        <div class="skills-grid">
            <?php foreach ($T['skill_groups'] as $group): ?>
            <div class="skill-card">
                <h3><?= $group['title'] ?></h3>
                <div class="tags">
                    <?php foreach ($group['tags'] as $tag): ?>
                    <span class="tag"><?= $tag ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ═══════════ PROJECTS ═══════════ -->
    <section class="section" id="projects">
        <h2 class="section-title"><?= $T['sec_projects'] ?></h2>

        <div class="projects-grid">
            <?php foreach ($T['projects'] as $project): ?>
            <article class="project-card">
                <div class="project-head">
                    <h3><?= $project['title'] ?></h3>
                    <span class="badge badge-<?= $project['badge'] ?>">
                        <?= $project['badge'] === 'live' ? $T['badge_live'] : $T['badge_ongoing'] ?>
                    </span>
                </div>
                <p class="project-desc"><?= $project['desc'] ?></p>
                <div class="tags">
                    <?php foreach ($project['tags'] as $tag): ?>
                    <span class="tag tag-sm"><?= $tag ?></span>
                    <?php endforeach; ?>
                </div>
                <a class="project-link" href="<?= $project['url'] ?>" target="_blank" rel="noopener">
                    <?= $project['link_label'] ?> <span class="project-arrow"><?= $arrow ?></span>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ═══════════ EDUCATION ═══════════ -->
    <section class="section" id="education">
        <h2 class="section-title"><?= $T['sec_education'] ?></h2>

        <div class="edu-grid">
            <div class="edu-card">
                <h3><?= $T['edu_degree'] ?></h3>
                <p class="edu-meta"><?= $T['edu_school'] ?></p>
                <p class="edu-meta"><?= $T['edu_dates'] ?></p>
                <p class="edu-note"><?= $T['edu_project'] ?></p>
            </div>

            <div class="edu-card">
                <h3><?= $T['edu_langs'] ?></h3>
                <ul class="lang-list">
                    <li><span><?= $T['lang_arabic'] ?></span><span class="lang-lvl"><?= $T['lang_native'] ?></span></li>
                    <li><span><?= $T['lang_english'] ?></span><span class="lang-lvl"><?= $T['lang_professional'] ?></span></li>
                    <li><span><?= $T['lang_german'] ?></span><span class="lang-lvl"><?= $T['lang_basic'] ?></span></li>
                </ul>
            </div>

            <div class="edu-card">
                <h3><?= $T['edu_courses'] ?></h3>
                <ul class="lang-list">
                    <li><span><?= $T['course_pmp'] ?></span><span class="lang-lvl">2014</span></li>
                    <li><span><?= $T['course_php'] ?></span><span class="lang-lvl">2012</span></li>
                    <li><span><?= $T['course_german'] ?></span><span class="lang-lvl">2016</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ═══════════ CONTACT ═══════════ -->
    <section class="section" id="contact">
        <h2 class="section-title"><?= $T['sec_contact'] ?></h2>

        <div class="contact-grid">
            <a class="contact-link" href="https://linkedin.com/in/ahmed-bermawy" target="_blank" rel="noopener">
                <span class="contact-icon">&#128188;</span>
                <span class="contact-label">LinkedIn</span>
            </a>
            <a class="contact-link" href="https://github.com/ahmed-bermawy" target="_blank" rel="noopener">
                <span class="contact-icon">&#128025;</span>
                <span class="contact-label">GitHub</span>
            </a>
            <a class="contact-link" href="mailto:ahmed_bermawy@yahoo.com">
                <span class="contact-icon">&#9993;&#65039;</span>
                <span class="contact-label"><?= $T['contact_email'] ?></span>
            </a>
            <a class="contact-link" href="/Ahmed%20Bermawy%20-%20Tech%20Lead.pdf" download>
                <span class="contact-icon">&#128196;</span>
                <span class="contact-label"><?= $T['contact_cv'] ?></span>
            </a>
        </div>

        <p class="closing"><span class="cursor">&#9614;</span> <?= $T['closing'] ?></p>
    </section>

    <footer class="site-footer">
        <p>&copy; <span id="year"></span> <?= $T['site_title'] ?> — <a href="<?= $homeUrl ?>"><?= $T['footer_back'] ?></a></p>
    </footer>

    <script>
    document.getElementById('year').textContent = new Date().getFullYear();
    </script>
    <script src="/assets/js/sections.js"></script>
    <script src="/assets/js/prefs.js"></script>
</body>
</html>
