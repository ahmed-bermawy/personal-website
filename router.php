<?php
/**
 * Router for PHP's built-in web server — a local stand-in for the nginx
 * rewrites that production uses.
 *
 *   php -S localhost:8000 router.php
 *
 * Then http://localhost:8000/about and http://localhost:8000/ar/about behave
 * exactly like the live site. PRODUCTION NEVER USES THIS FILE: the live site is
 * served by nginx, which maps the same four URLs in its server block
 * (see DEPLOY.md).
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$root = __DIR__;

// Real files are served untouched — assets, and .php scripts requested by name
// (so /about.php keeps working during development).
$candidate = $root . $path;
if ($path !== '/' && is_file($candidate)) {
    return false;
}

// Clean URL => [script, language]
$routes = [
    '/'         => ['index.php', null],
    '/about'    => ['about.php', null],
    '/ar'       => ['index.php', 'ar'],
    '/ar/about' => ['about.php', 'ar'],
];

$key = rtrim($path, '/');
if ($key === '') {
    $key = '/';
}

if (isset($routes[$key])) {
    [$script, $lang] = $routes[$key];
    if ($lang !== null) {
        $_GET['lang'] = $lang;
    }
    require $root . '/' . $script;
    return true;
}

// Unknown path — render the home page, matching nginx's try_files fallback.
require $root . '/index.php';
return true;
