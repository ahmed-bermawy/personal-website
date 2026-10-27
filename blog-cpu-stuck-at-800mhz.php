<?php
/**
 * Blog post: "the CPU was stuck at 800 MHz".
 *
 * The body is data: lang/blog.<lang>.php returns a list of blocks, and the
 * small renderer below turns each block into markup. Adding another post means
 * copying this file and pointing it at a different 'post' entry.
 *
 * Charts are hand-drawn SVG (no libraries) so they inherit the theme colours
 * and stay sharp at any size.
 */
$lang = (isset($_GET['lang']) && $_GET['lang'] === 'ar') ? 'ar' : 'en';
$T = require __DIR__ . '/lang/' . $lang . '.php';
$B = require __DIR__ . '/lang/blog.' . $lang . '.php';
$P = $B['post'];
$C = $B['charts'];
$isRtl = $T['dir'] === 'rtl';

$homeUrl    = $lang === 'ar' ? '/ar' : '/';
$blogUrl    = $lang === 'ar' ? '/ar/blog' : '/blog';

// Slug is derived from the filename: blog-cpu-stuck-at-800mhz.php -> cpu-stuck-at-800mhz
$slug       = preg_replace('/^blog-/', '', basename(__FILE__, '.php'));
$altLangUrl = ($lang === 'ar' ? '/blog/' : '/ar/blog/') . $slug;
$arrow      = $isRtl ? '&larr;' : '&rarr;';

/* ─────────────────────────────────────────────────────────
   Charts
   ───────────────────────────────────────────────────────── */

/**
 * Bar chart: 800 MHz (locked) vs base / after / turbo.
 */
function chart_speed(array $C, bool $rtl): string
{
    $rows = [
        ['label' => $C['bar_locked'], 'mhz' => 800,  'cls' => 'is-bad'],
        ['label' => $C['bar_base'],   'mhz' => 2600, 'cls' => 'is-muted'],
        ['label' => $C['bar_after'],  'mhz' => 3100, 'cls' => 'is-good'],
        ['label' => $C['bar_turbo'],  'mhz' => 4500, 'cls' => 'is-accent'],
    ];
    $max = 4500.0;
    $x0 = 200.0;
    $barMax = 470.0;
    $dir = $rtl ? ' direction="rtl"' : '';

    $s  = '<svg viewBox="0 0 720 285" role="img" aria-label="' . htmlspecialchars($C['speed_title'], ENT_QUOTES) . '">';

    // grid + tick labels
    foreach ([0, 1500, 3000, 4500] as $g) {
        $x = $x0 + ($g / $max) * $barMax;
        $s .= '<line class="chart-grid" x1="' . $x . '" y1="18" x2="' . $x . '" y2="244"/>';
        $s .= '<text class="chart-axis" x="' . $x . '" y="262" text-anchor="middle">' . $g . '</text>';
    }
    $s .= '<text class="chart-axis" x="700" y="18" text-anchor="end">' . htmlspecialchars($C['axis_mhz']) . '</text>';

    $y = 24;
    foreach ($rows as $row) {
        $w = ($row['mhz'] / $max) * $barMax;
        $s .= '<text class="chart-label" x="' . ($x0 - 14) . '" y="' . ($y + 20) . '" text-anchor="end"' . $dir . '>'
            . htmlspecialchars($row['label']) . '</text>';
        $s .= '<rect class="chart-bar ' . $row['cls'] . '" x="' . $x0 . '" y="' . $y . '" width="' . $w . '" height="30" rx="4"/>';
        $s .= '<text class="chart-value" x="' . ($x0 + $w + 10) . '" y="' . ($y + 20) . '">' . $row['mhz'] . '</text>';
        $y += 56;
    }

    $s .= '<line class="chart-axis-line" x1="' . $x0 . '" y1="244" x2="' . ($x0 + $barMax) . '" y2="244"/>';
    $s .= '</svg>';
    return $s;
}

/**
 * Line chart: clock over 60 s of full load, before vs after.
 */
function chart_time(array $C, bool $rtl): string
{
    $maxV = 4500.0;
    $x0 = 72.0;
    $x1 = 690.0;
    $yTop = 30.0;
    $yBot = 200.0;

    $yFor = function ($v) use ($maxV, $yTop, $yBot) {
        return $yBot - ($v / $maxV) * ($yBot - $yTop);
    };
    $xFor = function ($t) use ($x0, $x1) {
        return $x0 + ($t / 60.0) * ($x1 - $x0);
    };

    // measured-ish samples: before is a flat line, after ramps and oscillates
    $after = [
        0 => 800, 2 => 800, 4 => 2400, 6 => 3000, 8 => 3100, 10 => 3050,
        12 => 2950, 14 => 3120, 16 => 3000, 18 => 3150, 20 => 3000, 22 => 3100,
        24 => 3050, 26 => 3900, 28 => 3950, 30 => 3850, 32 => 4000, 34 => 3900,
        36 => 3000, 38 => 3050, 40 => 3100, 42 => 2950, 44 => 3050, 46 => 3900,
        48 => 4000, 50 => 3900, 52 => 3850, 54 => 3000, 56 => 3050, 58 => 3100,
        60 => 3050,
    ];

    $s  = '<svg viewBox="0 0 720 268" role="img" aria-label="' . htmlspecialchars($C['time_title'], ENT_QUOTES) . '">';

    // horizontal grid + y labels
    foreach ([0, 1500, 3000, 4500] as $g) {
        $y = $yFor($g);
        $s .= '<line class="chart-grid" x1="' . $x0 . '" y1="' . $y . '" x2="' . $x1 . '" y2="' . $y . '"/>';
        $s .= '<text class="chart-axis" x="' . ($x0 - 10) . '" y="' . ($y + 4) . '" text-anchor="end">' . $g . '</text>';
    }

    // x ticks
    foreach ([0, 15, 30, 45, 60] as $t) {
        $x = $xFor($t);
        $s .= '<text class="chart-axis" x="' . $x . '" y="' . ($yBot + 20) . '" text-anchor="middle">' . $t . '</text>';
    }
    $s .= '<text class="chart-axis" x="' . $x1 . '" y="' . ($yBot + 38) . '" text-anchor="end">'
        . htmlspecialchars($C['axis_seconds']) . '</text>';

    // before: flat 800
    $s .= '<polyline class="chart-line is-bad" points="'
        . $x0 . ',' . $yFor(800) . ' ' . $x1 . ',' . $yFor(800) . '"/>';

    // after
    $pts = [];
    foreach ($after as $t => $v) {
        $pts[] = round($xFor($t), 1) . ',' . round($yFor($v), 1);
    }
    $s .= '<polyline class="chart-line is-good" points="' . implode(' ', $pts) . '"/>';

    $s .= '</svg>';
    return $s;
}

/**
 * Flow diagram: external pin overrides the OS.
 */
function chart_flow(array $C, bool $rtl): string
{
    $dir = $rtl ? ' direction="rtl"' : '';
    $s = '<svg viewBox="0 0 720 170" role="img" aria-label="' . htmlspecialchars($C['flow_title'], ENT_QUOTES) . '">';

    $box = function ($x, $w, $title, $sub, $cls) use ($dir) {
        $out  = '<rect class="flow-box ' . $cls . '" x="' . $x . '" y="45" width="' . $w . '" height="78" rx="10"/>';
        $out .= '<text class="flow-title" x="' . ($x + $w / 2) . '" y="78" text-anchor="middle"' . $dir . '>'
            . htmlspecialchars($title) . '</text>';
        $out .= '<text class="flow-sub" x="' . ($x + $w / 2) . '" y="100" text-anchor="middle"' . $dir . '>'
            . htmlspecialchars($sub) . '</text>';
        return $out;
    };

    $s .= $box(10, 200, $C['flow_ec'], $C['flow_ec_sub'], '');
    $s .= $box(270, 170, $C['flow_cpu'], $C['flow_cpu_sub'], '');
    $s .= $box(500, 210, $C['flow_result'], $C['flow_result_sub'], 'is-bad');

    // arrows
    $s .= '<line class="flow-arrow" x1="214" y1="84" x2="262" y2="84"/>';
    $s .= '<path class="flow-head" d="M262,84 l-8,-5 l0,10 z"/>';
    $s .= '<text class="flow-signal" x="238" y="70" text-anchor="middle">' . htmlspecialchars($C['flow_signal']) . '</text>';

    $s .= '<line class="flow-arrow" x1="444" y1="84" x2="492" y2="84"/>';
    $s .= '<path class="flow-head" d="M492,84 l-8,-5 l0,10 z"/>';

    $s .= '</svg>';
    return $s;
}

/* ─────────────────────────────────────────────────────────
   Block renderer
   ───────────────────────────────────────────────────────── */

function render_blocks(array $blocks, array $C, bool $rtl, string $arrow): void
{
    foreach ($blocks as $b) {
        $type = isset($b['type']) ? $b['type'] : 'p';

        switch ($type) {
            case 'h2':
                echo '<h2 class="post-h2">' . $b['text'] . '</h2>';
                break;

            case 'p':
                echo '<p class="post-p">' . $b['html'] . '</p>';
                break;

            case 'ul':
                echo '<ul class="post-list">';
                foreach ($b['items'] as $item) {
                    echo '<li>' . $item . '</li>';
                }
                echo '</ul>';
                break;

            case 'ol':
                echo '<ol class="post-list post-list-num">';
                foreach ($b['items'] as $item) {
                    echo '<li>' . $item . '</li>';
                }
                echo '</ol>';
                break;

            case 'code':
                echo '<figure class="code-block">';
                if (!empty($b['caption'])) {
                    echo '<figcaption>' . htmlspecialchars($b['caption']) . '</figcaption>';
                }
                echo '<pre><code>' . htmlspecialchars($b['code']) . '</code></pre>';
                echo '</figure>';
                break;

            case 'note':
                $kind = isset($b['kind']) ? $b['kind'] : 'info';
                echo '<aside class="post-note ' . $kind . '">';
                if (!empty($b['title'])) {
                    echo '<strong>' . htmlspecialchars($b['title']) . '</strong>';
                }
                echo '<span>' . $b['html'] . '</span>';
                echo '</aside>';
                break;

            case 'table':
                echo '<div class="table-wrap"><table class="post-table">';
                if (!empty($b['head'])) {
                    echo '<thead><tr>';
                    foreach ($b['head'] as $th) {
                        echo '<th>' . $th . '</th>';
                    }
                    echo '</tr></thead>';
                }
                echo '<tbody>';
                foreach ($b['rows'] as $row) {
                    echo '<tr>';
                    foreach ($row as $td) {
                        echo '<td>' . $td . '</td>';
                    }
                    echo '</tr>';
                }
                echo '</tbody></table></div>';
                break;

            case 'steps':
                echo '<ol class="steps-list">';
                foreach ($b['items'] as $step) {
                    echo '<li><strong>' . htmlspecialchars($step['title']) . '</strong>' . $step['html'] . '</li>';
                }
                echo '</ol>';
                break;

            case 'stats':
                echo '<div class="stats post-stats">';
                foreach ($b['items'] as $stat) {
                    echo '<div class="stat">';
                    echo '<span class="stat-num">' . htmlspecialchars($stat['num']) . '<span class="stat-suffix">' . htmlspecialchars(isset($stat['suffix']) ? $stat['suffix'] : '') . '</span></span>';
                    echo '<span class="stat-label">' . htmlspecialchars($stat['label']) . '</span>';
                    echo '</div>';
                }
                echo '</div>';
                break;

            case 'chart':
                $name = $b['name'];
                if ($name === 'speed') {
                    $title = $C['speed_title'];
                    $svg = chart_speed($C, $rtl);
                    $legend = '';
                } elseif ($name === 'time') {
                    $title = $C['time_title'];
                    $svg = chart_time($C, $rtl);
                    $legend = '<div class="chart-legend">'
                        . '<span><i class="swatch is-bad"></i>' . htmlspecialchars($C['legend_before']) . '</span>'
                        . '<span><i class="swatch is-good"></i>' . htmlspecialchars($C['legend_after']) . '</span>'
                        . '</div>';
                } else {
                    $title = $C['flow_title'];
                    $svg = chart_flow($C, $rtl);
                    $legend = '';
                }
                echo '<figure class="chart">';
                echo '<figcaption class="chart-title">' . htmlspecialchars($title) . '</figcaption>';
                echo $svg;
                echo $legend;
                if (!empty($C['time_note']) && $name === 'time') {
                    echo '<p class="chart-note">' . htmlspecialchars($C['time_note']) . '</p>';
                }
                if (!empty($C['flow_note']) && $name === 'flow') {
                    echo '<p class="chart-note">' . htmlspecialchars($C['flow_note']) . '</p>';
                }
                echo '</figure>';
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $T['code'] ?>" dir="<?= $T['dir'] ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($P['title']) ?> | <?= $T['site_title'] ?></title>
    <meta name="description" content="<?= htmlspecialchars($P['subtitle'], ENT_QUOTES) ?>">
    <meta name="author" content="Ahmed Bermawy">
    <meta name="theme-color" content="#667eea">

    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= htmlspecialchars($P['title'], ENT_QUOTES) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($P['subtitle'], ENT_QUOTES) ?>">
    <meta property="og:url" content="https://bermawy.tech/blog/<?= htmlspecialchars($slug, ENT_QUOTES) ?>">
    <meta property="article:published_time" content="2026-10-27">
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
<body class="page-post">
    <!-- Theme + language switches -->
    <div class="prefs">
        <button id="themeToggle" class="pref-btn" type="button"
                aria-label="<?= $T['theme_toggle'] ?>" title="<?= $T['theme_toggle'] ?>">&#127769;</button>
        <a class="pref-btn" href="<?= $altLangUrl ?>" title="<?= $T['other_label'] ?>"><?= $T['other_label'] ?></a>
    </div>

    <!-- Back to blog -->
    <nav class="top-nav">
        <div class="nav-links">
            <a href="<?= $blogUrl ?>" class="nav-back"><?= $arrow ?> <?= $B['back_blog'] ?></a>
            <a href="<?= $homeUrl ?>" class="nav-back"><?= $arrow ?> <?= $B['back_home'] ?></a>
        </div>
        <span class="nav-file"><?= htmlspecialchars($P['file']) ?></span>
    </nav>

    <header class="page-head post-head">
        <div class="post-meta">
            <span>&#128197; <?= htmlspecialchars($P['date_label']) ?></span>
            <span class="dot">&middot;</span>
            <span>&#9201; <?= htmlspecialchars($P['read_time']) ?></span>
        </div>
        <h1><?= htmlspecialchars($P['title']) ?></h1>
        <p class="page-sub"><span class="cursor">&#9614;</span> <?= htmlspecialchars($P['subtitle']) ?></p>
        <div class="tags post-tags">
            <?php foreach ($P['tags'] as $tag): ?>
            <span class="tag tag-sm"><?= htmlspecialchars($tag) ?></span>
            <?php endforeach; ?>
        </div>
    </header>

    <article class="section post-body" id="post">
        <?php render_blocks($P['blocks'], $C, $isRtl, $arrow); ?>

        <div class="post-footer-nav">
            <a class="about-link" href="<?= $blogUrl ?>"><?= $B['back_blog'] ?> <span class="about-link-arrow"><?= $arrow ?></span></a>
        </div>
    </article>

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
