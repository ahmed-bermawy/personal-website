# Running this site

Flat PHP — no build step, no framework, no Composer. You need PHP 8+ and a web
server. There is one thing to get right: **the clean URLs**.

## The URLs

| URL | Renders | Language |
|---|---|---|
| `/` | `index.php` | English |
| `/about` | `about.php` | English |
| `/blog` | `blog.php` | English |
| `/blog/<slug>` | `blog-<slug>.php` | English |
| `/ar` | `index.php?lang=ar` | Arabic (RTL) |
| `/ar/about` | `about.php?lang=ar` | Arabic (RTL) |
| `/ar/blog` | `blog.php?lang=ar` | Arabic (RTL) |
| `/ar/blog/<slug>` | `blog-<slug>.php?lang=ar` | Arabic (RTL) |

`/about.php`, `/index.php` and the `blog-*.php` files also work directly — useful
while developing, and they keep older links alive.

A post's slug is its filename without the `blog-` prefix and `.php` suffix:
`blog.php` links to `blog-<slug>.php` as `/blog/<slug>`.

---

## Production — nginx

The live site runs **nginx**. nginx ignores `.htaccess`, so the rewrites live in
the server block instead:

```nginx
server {
    listen 127.0.0.1:8080;
    server_name bermawy.tech www.bermawy.tech;

    root /home/production/personal-website;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Clean URLs — English default + Arabic mirror
    location = /about     { rewrite ^ /about.php last; }
    location = /ar        { rewrite ^ /index.php?lang=ar last; }
    location = /ar/about  { rewrite ^ /about.php?lang=ar last; }

    # Blog: /blog, /ar/blog and /blog/<slug>
    location = /blog      { rewrite ^ /blog.php last; }
    location = /ar/blog   { rewrite ^ /blog.php?lang=ar last; }
    location ~ ^/ar/blog/([a-z0-9-]+)/?$ { rewrite ^ /blog-$1.php?lang=ar last; }
    location ~ ^/blog/([a-z0-9-]+)/?$    { rewrite ^ /blog-$1.php last; }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Apply with `nginx -t && nginx -s reload`.

**Traefik** terminates TLS in front of it (`bermawy.tech` → `127.0.0.1:8080`).

---

## Local development — pick one

### A) PHP's built-in server (no Apache needed)

```bash
cd personal-website
php -S localhost:8000 router.php
```

Open <http://localhost:8000>. `router.php` maps the clean URLs to the right
script and language, exactly like nginx does. Without it, `php -S` serves
`index.php` for everything and `/about` silently shows the home page.

### B) Apache / XAMPP / MAMP

`.htaccess` in the project root carries the same rules. Apache reads it
automatically when `AllowOverride` is enabled (XAMPP and MAMP enable it by
default). If `/about` still drops back to the home page, `mod_rewrite` is off or
`AllowOverride` is set to `None`.

### C) Point Apache/XAMPP at the folder as a virtual host

```apache
<VirtualHost *:80>
    ServerName personal-website.local
    DocumentRoot "/path/to/personal-website"
    <Directory "/path/to/personal-website">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Then add `127.0.0.1 personal-website.local` to your hosts file.

---

## Why the links break in a subfolder

Both pages build their navigation with **root-relative** paths (`/about`, `/ar`,
`/`). That is correct for production, where the site owns the domain root.

If you serve it from a subfolder — `http://localhost/personal-website/` — those
links resolve to `http://localhost/about`, which is outside the project. Use a
virtual host (option C) or the built-in server (option A) instead of a subfolder.

---

## Files

| File | Purpose |
|---|---|
| `index.php` | home page |
| `about.php` | the detailed CV |
| `blog.php` | blog index |
| `blog-<slug>.php` | one file per post (e.g. `blog-cpu-stuck-at-800mhz.php`) |
| `lang/en.php`, `lang/ar.php` | every string, keyed — both files must define the same keys |
| `lang/blog.en.php`, `lang/blog.ar.php` | blog strings + post bodies, keyed — must stay in sync |
| `assets/css/styles.css` | styles, CSS variables for the theme |
| `assets/js/prefs.js` | theme + language, applied before first paint |
| `assets/js/typeWriter.js` | the typing effect on the home page |
| `router.php` | **local only** — clean URLs for `php -S` |
| `.htaccess` | **local only** — clean URLs for Apache |

Language is chosen by the `/ar/...` path or by `?lang=ar`; `$_GET['lang']` is the
only input the pages read for it.

---

## Cache busting

`assets/css/styles.css?v=N` and `assets/js/*.js?v=N` — bump `N` in both PHP files
whenever you change those assets, otherwise browsers keep the old copy.
