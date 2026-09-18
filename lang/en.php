<?php
/**
 * English strings. Every visible sentence lives here so content can be edited
 * in one place — see lang/ar.php for the Arabic mirror.
 */
return [
    'code'    => 'en',
    'label'   => 'English',
    'dir'     => 'ltr',
    'other'   => 'ar',
    'other_label' => 'العربية',

    /* ── shared ─────────────────────────────────────── */
    'site_title'      => 'Ahmed Bermawy',
    'footer_tagline'  => 'built with a typewriter mindset ⌨️',
    'footer_back'     => 'back to home',
    'theme_toggle'    => 'Switch theme',

    /* ── home ───────────────────────────────────────── */
    'home_meta'       => 'Ahmed Bermawy — Software Development Lead & Senior Backend Developer based in Cairo, Egypt. PHP · Laravel · Symfony · Shopware · AWS.',
    'hero_hello'      => 'Hello, World!',
    'hero_skip'       => 'Skip Intro',
    'home_cta'        => 'More about me',
    'home_cta_hint'   => '13+ years of backend engineering, team leadership & the full story',

    /* ── promo cards ────────────────────────────────── */
    'card_mentor_title' => '🎯 Mentorship Services',
    'card_mentor_lead'  => 'Get personalized guidance from Ahmed',
    'card_mentor_items' => [
        '🚀 Web Development Mentoring',
        '💼 Career Guidance & Consulting',
        '🔧 Technical Problem Solving',
        '📈 Project Review & Code Optimization',
    ],
    'card_mentor_cta'   => 'Book a Session',
    'card_tree_title'   => '🌳 Family Tree',
    'card_tree_lead'    => 'Build & share your family history',
    'card_tree_items'   => [
        '👨‍👩‍👧‍👦 Create your family tree visually',
        '📸 Add photos & profile pictures',
        '🔗 Share with relatives via link',
        '🌐 Available in English & العربية',
    ],
    'card_tree_cta'     => '🌳 Try Family Tree',

    /* ── about page ─────────────────────────────────── */
    'about_title'     => 'About me',
    'about_meta'      => 'About Ahmed Bermawy — Tech Lead & Senior Backend Developer with 13+ years of experience in PHP, Laravel, Symfony, Shopware, microservices and AWS.',
    'about_sub'       => 'The full story — experience, stack and how to reach me.',
    'nav_home'        => 'Home',
    'nav_file'        => 'about.md',

    /* ── whoami ─────────────────────────────────────── */
    'sec_whoami'      => '$ whoami',
    'whoami_p1'       => 'Tech Lead with <strong>13+ years</strong> of experience in backend development, team leadership and scalable system design. Expert in <strong>PHP, Laravel, Symfony and Shopware</strong>, with a proven track record in microservices architecture, CI/CD, cloud deployment (AWS) and database design.',
    'whoami_p2'       => 'Passionate about clean code, mentorship and Agile development — currently leading the team behind <strong>elcinema.com</strong>, the largest Arabic movies &amp; series database.',
    'stat_years'      => 'years experience',
    'stat_companies'  => 'companies',
    'stat_leading'    => 'years leading teams',
    'stat_countries'  => 'countries worked with',

    /* ── experience ─────────────────────────────────── */
    'sec_experience'  => '$ experience --all',
    'exp' => [
        [
            'role'    => 'Software Development Lead',
            'date'    => 'Dec 2025 — Present',
            'company' => 'Damlag',
            'place'   => 'Cairo, Egypt',
            'points'  => [
                'Leading and mentoring the development team',
                'Designing and scaling the application architecture',
                'Driving technical decisions and best practices',
                'Working on <strong>elcinema.com</strong> — the largest Arabic database for movies &amp; series — and building its first mobile app (iOS &amp; Android)',
            ],
        ],
        [
            'role'    => 'Tech Lead',
            'date'    => 'May 2024 — Nov 2025',
            'company' => 'Sure',
            'place'   => 'Saudi Arabia',
            'points'  => [
                'Directed a cross-functional team of <strong>10+ engineers</strong> (backend, frontend, QA)',
                'Boosted collaboration and efficiency by <strong>25%</strong> with structured Git workflows and Jira practices',
                'Increased code quality by <strong>30%</strong> through code reviews and technical mentoring',
                'Reduced critical-issue resolution time by <strong>30%</strong> by streamlining debugging workflows',
            ],
        ],
        [
            'role'    => 'Senior Backend Developer',
            'date'    => 'Jun 2023 — Apr 2024',
            'company' => 'Strix',
            'place'   => 'Germany (Remote)',
            'points'  => [
                'Managed and enhanced a B2B e-commerce platform with a large client base',
                'Refactored the pricing module → <strong>20% performance gain</strong> and fewer customer-reported bugs',
                'Spearheaded the transition from B2B to B2C while keeping the platform scalable',
            ],
        ],
        [
            'role'    => 'Senior Backend Developer',
            'date'    => 'Dec 2022 — Jun 2023',
            'company' => 'Awaed',
            'place'   => 'Saudi Arabia',
            'points'  => [
                'Integrated <strong>Odoo ERP</strong> with Laravel microservices',
                'Developed and maintained a microservices architecture using Laravel and <strong>Kafka</strong>',
                'Expanded test coverage by <strong>60%</strong> across critical modules',
            ],
        ],
        [
            'role'    => 'Senior Full Stack Developer',
            'note'    => '→ Team Lead',
            'date'    => 'Feb 2018 — Sep 2022',
            'company' => 'ACID21',
            'place'   => 'Germany',
            'points'  => [
                'Led the Cairo team and mentored developers (Team Lead from Jan 2020)',
                'Resolved <strong>90%</strong> of stakeholder-reported issues within 48 hours',
                'Established code-quality and performance best practices',
            ],
            'projects_label' => 'Selected projects:',
            'projects' => [
                'Motorola — Shopware 6 portals (DE/IT)',
                'Rausch — Shopware 4→5 upgrade',
                'Plug &amp; Shine — Laravel API',
                'Neumann — ERP↔Shopware sync',
                'Finkid — Shopware plugins',
                'Boxlab — ordering system',
                'BJB — XML/ERP imports',
                'Glysantin — Drupal 8',
            ],
        ],
        [
            'role'    => 'Senior Full Stack Developer',
            'date'    => 'Dec 2015 — Jan 2018',
            'company' => 'WiFi Metropolis',
            'place'   => 'United States',
            'points'  => [
                'Launched the company website <strong>wifimetropolis.com</strong>',
                'Built a big-data dashboard processing <strong>200,000+ XPS logs daily</strong>',
                'Designed and deployed geofence maps and captive portals',
                'Developed backend &amp; API services for Medifi (patient–hospital–insurance workflows)',
            ],
        ],
        [
            'role'    => 'PHP Developer',
            'note'    => '→ Senior',
            'date'    => 'Jul 2012 — Nov 2015',
            'company' => 'Media &amp; More',
            'place'   => 'Egypt',
            'points'  => [
                'Wrote tailored client proposals and led a team of <strong>5 developers</strong>',
                'Onboarded and mentored 3 junior developers, boosting productivity by <strong>20%</strong>',
                'Reduced delivery time by <strong>30%</strong> by adopting modern tooling',
            ],
        ],
    ],

    /* ── skills ─────────────────────────────────────── */
    'sec_skills'      => '$ skills --all',
    'skill_groups' => [
        ['title' => '⚙️ Backend', 'tags' => ['PHP','Laravel','Symfony','Shopware','Ruby on Rails','Node.js','REST APIs','GraphQL','Microservices','OOP','SOLID','Design Patterns','PHPUnit','WebSockets','Pusher']],
        ['title' => '☁️ Cloud &amp; DevOps', 'tags' => ['AWS','CDK','EC2','ECS','Lambda','S3','ElastiCache','ECR','Docker','CI/CD','GitHub Actions','Jenkins','Ubuntu','CentOS']],
        ['title' => '🗄️ Databases &amp; Messaging', 'tags' => ['MySQL','PostgreSQL','SQL Server','MongoDB','Elasticsearch','Redis','RabbitMQ','Kafka']],
        ['title' => '🎨 Frontend', 'tags' => ['JavaScript','React','HTML','CSS','jQuery','Bootstrap']],
        ['title' => '🤖 AI &amp; Other', 'tags' => ['ChatGPT','AI Agents','Git','Bash','WordPress','Drupal','YouTube API','Google Maps API']],
    ],

    /* ── projects ───────────────────────────────────── */
    'sec_projects' => '$ projects --showcase',
    'badge_live'   => '● Live',
    'badge_ongoing'=> '● Ongoing',
    'projects' => [
        [
            'title' => '🌳 Family Tree',
            'badge' => 'live',
            'desc'  => 'A full-stack family tree builder with a visual graph editor, photo uploads, shareable links and complete Arabic/English support with RTL. Built around real family rules — polygamous households, spouse limits and per-person relationship menus.',
            'tags'  => ['React 19','TypeScript','React Flow','NestJS','Prisma','PostgreSQL','JWT','i18n / RTL','Traefik'],
            'link_label' => 'Visit',
            'url'   => 'https://family-tree.bermawy.tech',
        ],
        [
            'title' => '🌐 This Website',
            'badge' => 'live',
            'desc'  => 'The site you are reading. A hand-built, dependency-free experience: a typewriter that types the story out loud, a favicon generated on the fly from the browser, and a terminal-styled CV — no frameworks, no build step, just the platform.',
            'tags'  => ['PHP','Vanilla JS','CSS','nginx',"Let's Encrypt",'GitHub Actions'],
            'link_label' => 'Source',
            'url'   => 'https://github.com/ahmed-bermawy/personal-website',
        ],
        [
            'title' => '🎯 Mentorship',
            'badge' => 'ongoing',
            'desc'  => 'One-to-one mentoring for developers: web development guidance, career consulting, technical problem solving and project code reviews — booked through Topmate.',
            'tags'  => ['Mentoring','Career Guidance','Code Review','Architecture'],
            'link_label' => 'Book a session',
            'url'   => 'https://topmate.io/ahmed_bermawy',
        ],
    ],

    /* ── education ──────────────────────────────────── */
    'sec_education'   => '$ education --show',
    'edu_degree'      => '🎓 Bachelor of Computer Engineering',
    'edu_school'      => 'Faculty of Engineering, Tanta University — Egypt',
    'edu_dates'       => 'Oct 2004 – Aug 2009 <span class="dot">·</span> Grade: Good',
    'edu_project'     => 'Graduation project: Smart RFID Inventory System <em>(Excellent)</em>',
    'edu_langs'       => '🌍 Languages',
    'lang_arabic'     => 'Arabic',
    'lang_native'     => 'Native',
    'lang_english'    => 'English',
    'lang_professional'=> 'Professional',
    'lang_german'     => 'German',
    'lang_basic'      => 'Basic',
    'edu_courses'     => '📚 Courses',
    'course_pmp'      => 'PMP',
    'course_php'      => 'PHP &amp; MySQL',
    'course_german'   => 'German A1',

    /* ── contact ────────────────────────────────────── */
    'sec_contact'     => '$ contact --me',
    'contact_email'   => 'Email',
    'contact_cv'      => 'Download CV',
    'closing'         => 'Open to remote roles with German &amp; Middle-East companies.',
];
