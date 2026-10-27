<?php
/**
 * نصوص المدونة باللهجة المصرية.
 *
 * نسخة مطابقة لـ lang/blog.en.php، أي تعديل في المحتوى لازم يتعمل في الملفين.
 * المصطلحات التقنية بتتكتب بالإنجليزي زي ما هي (CPU, RAM, disk, firmware).
 */
return [
    /* ── عناوين مشتركة ──────────────────────────────── */
    'index_title'  => 'المدونة',
    'index_meta'   => 'ملاحظات ميدانية في تتبع الأخطاء والأداء وهندسة الـ Backend، بقلم أحمد البرماوي.',
    'index_sub'    => 'ملاحظات ميدانية، أغلبها أخطاء خدت وقت أطول في اكتشافها من إصلاحها.',
    'nav_blog'     => 'المدونة',
    'nav_about'    => 'عني',
    'nav_file'     => 'blog.md',
    'read_post'    => 'اقرا المقال',
    'back_blog'    => 'ارجع للمدونة',
    'back_home'    => 'ارجع للرئيسية',
    'posted_on'    => 'اتنشر في',
    'min_read'     => 'دقايق قراءة',
    'empty'        => 'لسه مفيش مقالات، أول واحد بيتكتب.',

    /* ── كروت الفهرس ────────────────────────────────── */
    'posts' => [
        [
            'title'     => 'اللابتوب بتاعي بقى بطيء: الـ CPU كان مثبت على 800 ميجاهرتز',
            'slug'      => 'cpu-stuck-at-800mhz',
            'date_label'=> '27 أكتوبر 2026',
            'read_time' => '9 دقايق قراءة',
            'excerpt'   => 'Chrome بقى بطيء، وكل حاجة معاه. الـ RAM فاضية، والـ disk مش مشغول، وحرارة الـ CPU منخفضة. السبب كان إشارة من الـ firmware مثبتة الـ CPU على أبطأ سرعة ممكنة مع إنه بيوصل لـ 4.5 جيجاهرتز. إزاي اكتشفتها، وإزاي تتأكد من نفس الحاجة على جهازك.',
            'tags'      => ['Linux', 'Hardware', 'Performance', 'Debugging'],
        ],
    ],

    /* ── عناوين الرسوم البيانية ─────────────────────── */
    'charts' => [
        'speed_title'   => 'مقارنة سرعة الـ CPU: اللي كان بيعمله فعلًا مقابل اللي اتصمم عشانه',
        'bar_locked'    => 'مثبت (قبل)',
        'bar_base'      => 'السرعة الأساسية',
        'bar_after'     => 'بعد الإصلاح (تحت الحمل)',
        'bar_turbo'     => 'أقصى Turbo',
        'axis_mhz'      => 'ميجاهرتز',

        'time_title'    => 'سرعة الـ CPU خلال 60 ثانية من الحمل الكامل: قبل وبعد',
        'time_note'     => 'نفس الجهاز ونفس الاختبار. قبل: السرعة عمرها ما اتحركت. بعد: بتمشي مع الحمل وبتنزل بس لما تسخن.',
        'legend_before' => 'قبل: مثبت بإشارة PROCHOT',
        'legend_after'  => 'بعد: حر يسرع',
        'axis_seconds'  => 'ثواني تحت الحمل',

        'flow_title'    => 'إزاي pin خارجي بيتجاوز الـ OS بالكامل',
        'flow_note'     => 'الـ OS بيطلب 4.5 جيجاهرتز، بس الإشارة هي اللي بتحكم.',
        'flow_ec'       => 'embedded controller / voltage regulator',
        'flow_ec_sub'   => 'بيسحب الـ pin',
        'flow_signal'   => 'PROCHOT#',
        'flow_cpu'      => 'الـ CPU',
        'flow_cpu_sub'  => 'بيتجبر على الحد الأدنى',
        'flow_result'   => '800 ميجاهرتز',
        'flow_result_sub' => 'لحد ما الإشارة تترفع',
    ],

    /* ── المقال ─────────────────────────────────────── */
    'post' => [
        'title'     => 'اللابتوب بتاعي بقى بطيء: الـ CPU كان مثبت على 800 ميجاهرتز',
        'subtitle'  => 'خمس دقايق قياس حولوا «اللابتوب بطيء» لخلل في الـ firmware بيثبت الـ CPU على أبطأ حالة ممكنة.',
        'file'      => 'cpu-800mhz.diag',
        'date_label'=> '27 أكتوبر 2026',
        'read_time' => '9 دقايق قراءة',
        'tags'      => ['Linux', 'Hardware', 'Performance', 'Debugging'],

        'blocks' => [

            ['type' => 'p', 'html' =>
                'اللابتوب بتاعي بقى استخدامه متعب. Chrome بقى بطيء، والتنقل بين التابات بيتقطع، حتى فتح الـ terminal بقى تقيل. فعملت اللي كان لازم أعمله من أول يوم: بطلت تخمين وقست. والإجابة مالهاش أي علاقة بالـ RAM ولا الـ disk ولا Chrome.'],

            ['type' => 'stats', 'items' => [
                ['num' => '800', 'suffix' => 'MHz', 'label' => 'السرعة الفعلية تحت الحمل الكامل'],
                ['num' => '4,500', 'suffix' => 'MHz', 'label' => 'السرعة اللي الـ CPU مصمم عليها'],
                ['num' => '5×', 'suffix' => '', 'label' => 'أسرع بعد الإصلاح'],
                ['num' => '52', 'suffix' => '°C', 'label' => 'الحرارة وقت الـ throttling'],
            ]],

            ['type' => 'h2', 'text' => 'الأعراض'],
            ['type' => 'p', 'html' =>
                'المشتبه فيهم المعتادين كان سهل فحصهم، وكلهم كانوا أبرياء:'],
            ['type' => 'ul', 'items' => [
                '<strong>RAM</strong>:&#8207; 30 جيجا مركبة، و26 جيجا فاضية، وصفر بايت في الـ swap.',
                '<strong>disk</strong>:&#8207; SSD ونسبة الانتظار بتاع الإدخال/الإخراج حوالي 0%.',
                '<strong>load</strong>:&#8207; كام أداة تطوير شغالة، بس الجهاز خامل أكتر من 80% من الوقت.',
            ]],
            ['type' => 'p', 'html' =>
                'مكانش فيه عطل واضح. الرقم الوحيد اللي مافحصتوش هو اللي يفسر كل حاجة: <strong>الـ CPU شغال بسرعة قد إيه فعلًا</strong>.'],

            ['type' => 'h2', 'text' => 'الخطوة 1: اقرا السرعة الحالية'],
            ['type' => 'p', 'html' => 'أمرين كفاية على أي جهاز لينكس:'],
            ['type' => 'code', 'caption' => 'السرعة الحالية', 'code' => <<<'SH'
grep MHz /proc/cpuinfo
lscpu | grep -E 'Model name|MHz'
SH,
            ],
            ['type' => 'p', 'html' =>
                'الإجابة عندي كانت <code>800 MHz</code> على الـ 12 thread كلهم. الـ CPU هو Intel Core i7-9750H: أساسي 2.6 جيجاهرتز وبيوصل لـ 4.5 جيجاهرتز. يعني كان شغال على حوالي <strong>تلت سرعته الأساسية</strong>.'],
            ['type' => 'p', 'html' =>
                'الـ CPU وهو خامل على 800 ميجاهرتز ده طبيعي خالص، ده توفير طاقة. الخلل بيبان بس لما تحمله.'],

            ['type' => 'h2', 'text' => 'الخطوة 2: اعرف السقف المسموح للـ CPU'],
            ['type' => 'p', 'html' =>
                'قبل ما تلوم الـ hardware، استبعد الـ OS. لينكس بيوضح حدود الـ hardware والحدود اللي هو مفعلها حاليًا:'],
            ['type' => 'code', 'caption' => 'الحدود المسموح بيها', 'code' => <<<'SH'
# أقصى سرعة بيدعمها الـ CPU (بالكيلوهرتز)
cat /sys/devices/system/cpu/cpu0/cpufreq/cpuinfo_max_freq
# أقصى سرعة الـ OS بيسمح بيها دلوقتي
cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_max_freq
# حدود Intel P-state كنسبة من الأقصى
cat /sys/devices/system/cpu/intel_pstate/{min_perf_pct,max_perf_pct,no_turbo}
SH,
            ],
            ['type' => 'p', 'html' =>
                'كلهم ردوا بـ<em>اتفضل</em>: سقف 4,500,000 كيلوهرتز، و<code>max_perf_pct=100</code>، والـ Turbo مش متعطل. على الورق الـ CPU كان حر يشتغل بأقصى سرعة.'],
            ['type' => 'table',
                'head' => ['الطبقة', 'القراءة', 'الحكم'],
                'rows' => [
                    ['أقصى سرعة للـ CPU', '4,500 ميجاهرتز', 'الـ hardware قادر'],
                    ['سقف الـ OS', '4,500 ميجاهرتز', 'مش مقيد'],
                    ['السرعة الفعلية تحت الحمل', '800 ميجاهرتز', '🔴 هنا الشذوذ'],
                ],
            ],

            ['type' => 'h2', 'text' => 'الخطوة 3: أثبتها تحت الحمل'],
            ['type' => 'p', 'html' =>
                'حمل كل الـ cores كام ثانية وبعدين اقرا السرعة تاني. ده الاختبار اللي بيفرق بين وهم توفير الطاقة والعطل الحقيقي:'],
            ['type' => 'code', 'caption' => 'تحميل كل الـ cores وبعدين قراءة السرعة', 'code' => <<<'SH'
for i in $(seq 1 $(nproc)); do yes > /dev/null & done
sleep 5
grep MHz /proc/cpuinfo
pkill yes
SH,
            ],
            ['type' => 'p', 'html' =>
                'عندي فضلت ثابتة على <strong>800 ميجاهرتز مع استخدام 100% للـ CPU وload average = 11</strong>، وفي نفس الوقت حرارة الـ package كانت <strong>52 °C</strong> بس.'],
            ['type' => 'p', 'html' =>
                'الخلطة دي هي التشخيص كله: <strong>أقصى حمل، وأقل سرعة، وحرارة منخفضة</strong>. الـ CPU السخان فعلًا بيتخنق عشان قريب من 100 °C. إنما ده كان بارد وبرضه رافض يشتغل. حاجة بره الـ scheduler كانت ماسكاه.'],
            ['type' => 'chart', 'name' => 'time'],

            ['type' => 'h2', 'text' => 'الخطوة 4: اسأل الـ CPU عن السبب'],
            ['type' => 'p', 'html' =>
                'الـ CPUs بتاعة Intel بتنشر سبب الـ throttling في register خاص بالموديل (MSR). ثبت <code>msr-tools</code> واقراها:'],
            ['type' => 'code', 'caption' => 'اقرا سبب الـ throttling من الـ CPU على طول', 'code' => <<<'SH'
sudo apt install msr-tools        # rdmsr / wrmsr
sudo modprobe msr

sudo rdmsr -p 0 0x64F   # PERF_LIMIT_REASONS: أنا متقيد ليه؟
sudo rdmsr -p 0 0x1FC   # POWER_CTL:          بسمع إشارة PROCHOT؟
sudo rdmsr -p 0 0x198   # PERF_STATUS:        شغال على أي ratio؟
sudo rdmsr -p 0 0x199   # PERF_CTL:           مطلوب مني أي ratio؟
SH,
            ],
            ['type' => 'p', 'html' => 'الإجابة كانت:'],
            ['type' => 'table',
                'head' => ['الـ register', 'القيمة', 'المعنى'],
                'rows' => [
                    ['0x64F, PERF_LIMIT_REASONS', '0x00010001', 'الـ bit 0 شغال، يعني <strong>PROCHOT</strong> هو سبب الـ throttling'],
                    ['0x1FC, POWER_CTL', '0x002c005d', 'الـ bit 0 = 1، يعني بيسمع لـ pin الـ PROCHOT الخارجي'],
                    ['0x198, PERF_STATUS', '0x…0800', 'الـ ratio الحالي 8، يعني 800 ميجاهرتز'],
                    ['0x199, PERF_CTL', '0x…2d00', 'المطلوب ratio 45، يعني 4.5 جيجاهرتز'],
                ],
            ],
            ['type' => 'p', 'html' =>
                'مطلوب 4.5 جيجاهرتز، واللي اتسلم 0.8 جيجاهرتز. والـ CPU نفسه قال السبب: <strong>PROCHOT</strong>.'],

            ['type' => 'h2', 'text' => 'إيه هو PROCHOT أصلًا؟'],
            ['type' => 'p', 'html' =>
                '<strong>PROCHOT#</strong> (Processor Hot) ده pin كهربائي حقيقي على الـ CPU package. لما يتسحب للأرضي، الـ CPU بينزل لأقل حالة طاقة (P-state) على طول، من غير تفاوض ومن غير أي تدخل من الـ OS. وIntel كمان مطبقة حاجة اسمها <em>Bi-Directional PROCHOT</em> (BD PROCHOT): يعني الـ CPU بيسمع الـ pin ده مش بس لحرارته، كمان لإشارات من مكونات <em>تانية</em>، زي الـ voltage regulators، والـ embedded controller، والبطارية.'],
            ['type' => 'p', 'html' =>
                'في الأصل دي ميزة أمان كويسة: لو الـ power delivery مش قادر يتحمل الـ CPU، لازم حاجة تبطأه. بس بتبقى خلل لما الإشارة تفضل مسحوبة ومافيش حاجة سخنة.'],
            ['type' => 'chart', 'name' => 'flow'],

            ['type' => 'h2', 'text' => 'الخطوة 5: استبعد الأسباب الرخيصة'],
            ['type' => 'p', 'html' =>
                'قبل ما تلجأ لحل ترقيعي، اعرف <em>ليه</em> الإشارة مسحوبة. بترتيب الاحتمالات تقريبًا:'],
            ['type' => 'steps', 'items' => [
                ['title' => 'الشاحن أو البطارية',
                 'html'  => 'في لابتوبات كتير، بطارية ضعيفة أو شاحن أقل من المطلوب بيخلوا الـ embedded controller يسحب إشارة PROCHOT عشان يحمي الـ voltage regulators. الاختبار: كرر تحميل الـ CPU بعد ما تفصل الشاحن.'],
                ['title' => 'الحرارة الحقيقية',
                 'html'  => 'شغل <code>sensors</code>. حرارة الـ package المفروض تبقى أقل بكتير من حرارة الخطر. لو بتقرا من 95 لـ 100 °C يبقى الـ CPU سخان بجد، نظف المراوح وغير الـ thermal paste بدل كده.'],
                ['title' => 'وضع الطاقة أو الـ governor',
                 'html'  => 'بص على <code>powerprofilesctl</code> أو <code>cpupower frequency-info</code>. ممكن يكون governor من نوع <code>powersave</code> ومعاه <code>max_perf_pct</code> واطي، فتبان زي نفس الحالة، بس ده هيستجيب للحمل.'],
                ['title' => 'embedded controller معلق',
                 'html'  => 'power drain كامل بيرجعه: اقفل الجهاز خالص، افصل الشاحن، دوس على زرار الباور من 30 لـ 60 ثانية، وبعدين وصل الشاحن وشغله.'],
                ['title' => 'الـ firmware',
                 'html'  => 'BIOS/EC قديم جدًا سبب شائع جدًا لإشارات PROCHOT الكدابة في لابتوبات الجيمنج. بص على صفحة دعم الشركة على إصدار أحدث من اللي عندك.'],
            ]],
            ['type' => 'p', 'html' =>
                'في حالتي الإشارة فضلت مسحوبة على الكهرباء وعلى البطارية، والبطارية كانت بتقول صحة 97% و83 دورة شحن، والـ BIOS كان عنده سبع سنين. ده بيرجح الـ embedded controller والـ firmware مش خلية بطارية تالفة.'],
            ['type' => 'note', 'kind' => 'warn', 'title' => 'مهم',
                'html' => 'لو فصل الشاحن خلى الـ throttling يروح على طول، يبقى المشكلة في الشاحن أو البطارية. غيره، وما تلجأش لحل ترقيعي.'],

            ['type' => 'h2', 'text' => 'الخطوة 6: الحل اللي رجعلي السرعة'],
            ['type' => 'p', 'html' =>
                'بعد ما استبعدت الأعطال الحقيقية، لو الإشارة لسه شغالة، تقدر تقول للـ CPU ما يسمعش BD PROCHOT بأنك تصفر <strong>الـ bit 0 من MSR 0x1FC</strong>. كل core عندها نسختها، فاكتب في كلهم:'],
            ['type' => 'code', 'caption' => 'تعطيل الاستماع لـ BD PROCHOT', 'code' => <<<'SH'
sudo rdmsr -a 0x1FC              # اقرا، غالبًا بينتهي بـ 5d أو 5b
sudo wrmsr -a 0x1FC 0x2c005c    # صفر الـ bit 0، يعني ...5d تبقى ...5c
SH,
            ],
            ['type' => 'p', 'html' =>
                'التغيير بيتطبق على طول بس مش بيفضل بعد restart، فخليه دايم بوحدة systemd صغيرة:'],
            ['type' => 'code', 'caption' => '/usr/local/bin/fix-bd-prochot.sh', 'code' => <<<'SH'
sudo tee /usr/local/bin/fix-bd-prochot.sh >/dev/null <<'EOF'
#!/bin/bash
modprobe msr 2>/dev/null || true
for i in $(seq 0 $(( $(nproc) - 1 ))); do
  cur=$(rdmsr -p "$i" 0x1FC 2>/dev/null) || continue
  if (( 0x$cur & 1 )); then
    wrmsr -p "$i" 0x1FC "$(printf '0x%x' $(( 0x$cur & ~1 )))"
  fi
done
EOF
sudo chmod 755 /usr/local/bin/fix-bd-prochot.sh
SH,
            ],
            ['type' => 'code', 'caption' => '/etc/systemd/system/bd-prochot-fix.service', 'code' => <<<'SH'
[Unit]
Description=Disable BD PROCHOT (workaround: CPU pinned at 800MHz)
After=multi-user.target

[Service]
Type=oneshot
ExecStart=/usr/local/bin/fix-bd-prochot.sh
RemainAfterExit=yes

[Install]
WantedBy=multi-user.target
SH,
            ],
            ['type' => 'code', 'caption' => 'تفعيل الوحدة', 'code' => <<<'SH'
sudo systemctl daemon-reload
sudo systemctl enable --now bd-prochot-fix.service
SH,
            ],
            ['type' => 'note', 'kind' => 'warn', 'title' => 'ده حل ترقيعي مش إصلاح',
                'html' => 'أنت بتعطل استجابة أمان. ما تعملهاش غير بعد ما تستبعد بطارية أو شاحن بايظ. ولو الجهاز بقى يقفل فجأة تحت الحمل بعد كده، رجع القيمة الأصلية (أو عطل الوحدة) وغير البطارية.'],

            ['type' => 'h2', 'text' => 'النتيجة'],
            ['type' => 'p', 'html' =>
                'على طول بعد تصفير الـ bit، نفس اختبار الحمل الكامل أدى <strong>3.1 جيجاهرتز على الـ 12 thread كلهم عند 94 °C</strong>، والشغل المكتبي العادي بقى يسرع لحدود 4 جيجاهرتز. Chrome بطل بيتقطع. وفي الخمول لسه بينزل لـ 800 ميجاهرتز، فتوفير الطاقة سليم. اللي اختفى هو السقف المصطنع بس.'],
            ['type' => 'chart', 'name' => 'speed'],

            ['type' => 'h2', 'text' => 'لو أنت على ويندوز'],
            ['type' => 'ul', 'items' => [
                'ThrottleStop: شيل علامة <strong>BD PROCHOT</strong> من النافذة الرئيسية. ده نفس الـ bit بس بواجهة رسومية.',
                'HWiNFO64: راقب <em>Core Clocks</em> و<em>CPU Package Power</em> ومؤشر <em>PROCHOT</em>.',
                '<code>powercfg /qh</code> بيوريك حدود أداء الـ CPU اللي ويندوز مفعلها.',
                'أجهزة AMD بتستخدم registers مختلفة. بص على <em>Ryzen Master</em> أو <code>ryzen_monitor</code> لمؤشرات PROCHOT/HTC.',
            ]],

            ['type' => 'h2', 'text' => 'قائمة مختصرة'],
            ['type' => 'ol', 'items' => [
                'اقرا السرعة الحالية: <code>grep MHz /proc/cpuinfo</code>.',
                'حمل كل الـ cores خمس ثواني واقراها تاني. النزول في الخمول طبيعي، إنما في الحمل مش طبيعي.',
                'افحص السقف المسموح: <code>cpuinfo_max_freq</code> و<code>scaling_max_freq</code> و<code>max_perf_pct</code>.',
                'لو الـ OS بيسمح بالسرعة الكاملة والسرعة مش بتتحرك، اقرا <code>rdmsr 0x64F</code>. الـ CPU هيقولك السبب.',
                'لو السبب PROCHOT مع حرارة منخفضة: اختبر الشاحن والبطارية، وبعدين اعمل power drain على الـ embedded controller، وبعدين حدث الـ BIOS.',
                'وبعد كده بس فكر تصفر BD PROCHOT (الـ bit 0 من <code>0x1FC</code>) كحل ترقيعي.',
            ]],

            ['type' => 'note', 'kind' => 'tip', 'title' => 'قس الأول',
                'html' => 'أهم رقم في «جهاز بطيء» غالبًا مش نسبة استخدام الـ CPU ولا الـ RAM. المهم هو <em>سرعة الـ CPU تحت الحمل</em>.'],
        ],
    ],
];
