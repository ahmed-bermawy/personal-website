<?php
/**
 * Blog strings - English.
 *
 * Kept separate from lang/en.php so the article body does not bloat the main
 * translation file. Shape mirrors lang/blog.ar.php, keep the two in sync.
 *
 * The article body is a list of blocks rendered by blog-cpu-stuck-at-800mhz.php.
 * Supported block types: p, h2, ul, ol, code, note, table, steps, stats, chart.
 */
return [
    /* ── shared labels ──────────────────────────────── */
    'index_title'  => 'Blog',
    'index_meta'   => 'Field notes on debugging, performance and backend engineering, by Ahmed Bermawy.',
    'index_sub'    => 'Field notes: mostly bugs that took longer to find than to fix.',
    'nav_blog'     => 'Blog',
    'nav_about'    => 'About me',
    'nav_file'     => 'blog.md',
    'read_post'    => 'Read post',
    'back_blog'    => 'back to blog',
    'back_home'    => 'back to home',
    'posted_on'    => 'Posted on',
    'min_read'     => 'min read',
    'empty'        => 'No posts yet, the first one is being typed.',

    /* ── index cards ────────────────────────────────── */
    'posts' => [
        [
            'title'     => 'My laptop felt slow: the CPU was stuck at 800 MHz',
            'slug'      => 'cpu-stuck-at-800mhz',
            'date_label'=> 'October 27, 2026',
            'read_time' => '9 min read',
            'excerpt'   => 'Chrome stuttered, and so did everything else. RAM was free, the SSD was idle and the CPU was cool, because a firmware signal had pinned a 4.5 GHz processor to its slowest possible state. How I found it, and how you can check the same thing on your machine.',
            'tags'      => ['Linux', 'Hardware', 'Performance', 'Debugging'],
        ],
    ],

    /* ── chart labels ───────────────────────────────── */
    'charts' => [
        'speed_title'   => 'Clock speed compared: what the CPU did vs. what it is rated for',
        'bar_locked'    => 'Locked (before)',
        'bar_base'      => 'Base clock',
        'bar_after'     => 'After fix (full load)',
        'bar_turbo'     => 'Max turbo',
        'axis_mhz'      => 'MHz',

        'time_title'    => 'Clock speed over 60 s of full load, before vs. after',
        'time_note'     => 'Same machine, same stress test. Before, the clock never moved. After, it tracks the load and pulls back only when it gets hot.',
        'legend_before' => 'Before: pinned by PROCHOT',
        'legend_after'  => 'After: free to boost',
        'axis_seconds'  => 'seconds under load',

        'flow_title'    => 'How an external pin overrides the operating system',
        'flow_note'     => 'The OS asks for 4.5 GHz. The pin wins.',
        'flow_ec'       => 'Embedded controller / VRM',
        'flow_ec_sub'   => 'pulls the pin',
        'flow_signal'   => 'PROCHOT#',
        'flow_cpu'      => 'CPU',
        'flow_cpu_sub'  => 'forced to minimum',
        'flow_result'   => '800 MHz',
        'flow_result_sub' => 'until the pin is released',
    ],

    /* ── the article ────────────────────────────────── */
    'post' => [
        'title'     => 'My laptop felt slow: the CPU was stuck at 800 MHz',
        'subtitle'  => 'Five minutes of measurement turned “my laptop is slow” into a firmware bug pinning a 4.5 GHz processor to its slowest state.',
        'file'      => 'cpu-800mhz.diag',
        'date_label'=> 'October 27, 2026',
        'read_time' => '9 min read',
        'tags'      => ['Linux', 'Hardware', 'Performance', 'Debugging'],

        'blocks' => [

            ['type' => 'p', 'html' =>
                'My laptop had become painful to use. Chrome was sluggish, switching tabs stuttered, and even opening a terminal felt heavy. So I did what I should have done on day one: I stopped guessing and measured. The answer had nothing to do with RAM, disk or Chrome.'],

            ['type' => 'stats', 'items' => [
                ['num' => '800', 'suffix' => 'MHz', 'label' => 'actual clock under full load'],
                ['num' => '4,500', 'suffix' => 'MHz', 'label' => 'what the CPU is rated for'],
                ['num' => '5×', 'suffix' => '', 'label' => 'faster after the fix'],
                ['num' => '52', 'suffix' => '°C', 'label' => 'temperature while it “throttled”'],
            ]],

            ['type' => 'h2', 'text' => 'The symptom'],
            ['type' => 'p', 'html' =>
                'The usual suspects were easy to check, and all of them were innocent:'],
            ['type' => 'ul', 'items' => [
                '<strong>Memory</strong>: 30 GB installed, 26 GB free, zero bytes in swap.',
                '<strong>Disk</strong>: an SSD with ~0% I/O wait.',
                '<strong>Load</strong>: a few dev tools running, but the machine was over 80% idle.',
            ]],
            ['type' => 'p', 'html' =>
                'Nothing was obviously broken. The one number I had not looked at was the one that explains everything: <strong>how fast the CPU is actually running</strong>.'],

            ['type' => 'h2', 'text' => 'Step 1: read the current clock'],
            ['type' => 'p', 'html' => 'Two commands are enough on any Linux machine:'],
            ['type' => 'code', 'caption' => 'current clock', 'code' => <<<'SH'
grep MHz /proc/cpuinfo
lscpu | grep -E 'Model name|MHz'
SH,
            ],
            ['type' => 'p', 'html' =>
                'Mine answered <code>800 MHz</code>, on all twelve threads. The processor is an Intel Core i7-9750H: a 2.6 GHz part that boosts to 4.5 GHz. It was running at about <strong>one third of its base clock</strong>.'],
            ['type' => 'p', 'html' =>
                'An idle CPU sitting at 800 MHz is completely normal, that is power saving. The fault only becomes visible once you put it under load.'],

            ['type' => 'h2', 'text' => 'Step 2: find the ceiling the CPU is allowed to reach'],
            ['type' => 'p', 'html' =>
                'Before blaming the hardware, rule out the operating system. Linux exposes both the hardware limits and the limits it is currently enforcing:'],
            ['type' => 'code', 'caption' => 'what the hardware allows', 'code' => <<<'SH'
# what the CPU says it can do (kHz)
cat /sys/devices/system/cpu/cpu0/cpufreq/cpuinfo_max_freq
# what the OS currently allows (kHz)
cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_max_freq
# Intel P-state limits, as a percentage of the maximum
cat /sys/devices/system/cpu/intel_pstate/{min_perf_pct,max_perf_pct,no_turbo}
SH,
            ],
            ['type' => 'p', 'html' =>
                'Every one of those answered <em>go ahead</em>: a 4,500,000 kHz ceiling, <code>max_perf_pct=100</code>, turbo not disabled. On paper the CPU was free to run at full speed.'],
            ['type' => 'table',
                'head' => ['Layer', 'Reading', 'Verdict'],
                'rows' => [
                    ['CPU rated maximum', '4,500 MHz', 'hardware is capable'],
                    ['OS frequency ceiling', '4,500 MHz', 'not restricted'],
                    ['Actual clock, full load', '800 MHz', '🔴 the anomaly'],
                ],
            ],

            ['type' => 'h2', 'text' => 'Step 3: prove it under load'],
            ['type' => 'p', 'html' =>
                'Put every core to work for a few seconds and read the clock again. This is the test that separates a power-saving illusion from a real fault:'],
            ['type' => 'code', 'caption' => 'saturate all cores, then read the clock', 'code' => <<<'SH'
for i in $(seq 1 $(nproc)); do yes > /dev/null & done
sleep 5
grep MHz /proc/cpuinfo
pkill yes
SH,
            ],
            ['type' => 'p', 'html' =>
                'Mine stayed at <strong>800 MHz with 100% CPU utilisation and a load average of 11</strong>, while the package temperature was only <strong>52 °C</strong>.'],
            ['type' => 'p', 'html' =>
                'That combination is the whole diagnosis: <strong>maximum load, minimum clock, low temperature</strong>. A genuinely hot CPU throttles because it is approaching 100 °C. This one was cool and still refused to run. Something outside the scheduler was holding it down.'],
            ['type' => 'chart', 'name' => 'time'],

            ['type' => 'h2', 'text' => 'Step 4: ask the CPU why'],
            ['type' => 'p', 'html' =>
                'Intel processors publish the reason they are being limited in a model-specific register (MSR). Install <code>msr-tools</code> and read them:'],
            ['type' => 'code', 'caption' => 'read the limiting reason straight from the CPU', 'code' => <<<'SH'
sudo apt install msr-tools        # rdmsr / wrmsr
sudo modprobe msr

sudo rdmsr -p 0 0x64F   # PERF_LIMIT_REASONS: why am I being limited?
sudo rdmsr -p 0 0x1FC   # POWER_CTL:          do I listen to PROCHOT?
sudo rdmsr -p 0 0x198   # PERF_STATUS:        what ratio am I running at?
sudo rdmsr -p 0 0x199   # PERF_CTL:           what ratio was requested?
SH,
            ],
            ['type' => 'p', 'html' => 'Mine answered:'],
            ['type' => 'table',
                'head' => ['Register', 'Value', 'Meaning'],
                'rows' => [
                    ['0x64F, PERF_LIMIT_REASONS', '0x00010001', 'bit 0 set, <strong>PROCHOT</strong> is the active limiter'],
                    ['0x1FC, POWER_CTL', '0x002c005d', 'bit 0 = 1, listening to the external PROCHOT pin'],
                    ['0x198, PERF_STATUS', '0x…0800', 'current ratio 8, so 800 MHz'],
                    ['0x199, PERF_CTL', '0x…2d00', 'requested ratio 45, so 4.5 GHz'],
                ],
            ],
            ['type' => 'p', 'html' =>
                'Requested 4.5 GHz, delivered 0.8 GHz, and the CPU named the reason itself: <strong>PROCHOT</strong>.'],

            ['type' => 'h2', 'text' => 'What PROCHOT actually is'],
            ['type' => 'p', 'html' =>
                '<strong>PROCHOT#</strong> (Processor Hot) is a physical pin on the CPU package. When it is pulled low, the processor drops to its minimum P-state immediately, with no negotiation and no involvement from the operating system. Intel also implements <em>Bi-Directional PROCHOT</em> (BD PROCHOT): the CPU listens to that pin not only for its own temperature, but for signals from <em>other</em> components, such as voltage regulators, the embedded controller and the battery.'],
            ['type' => 'p', 'html' =>
                'In principle that is a good safety feature: if power delivery cannot sustain the CPU, something must slow it down. It becomes a bug when the signal is held down while nothing is hot.'],
            ['type' => 'chart', 'name' => 'flow'],

            ['type' => 'h2', 'text' => 'Step 5: rule out the cheap causes'],
            ['type' => 'p', 'html' =>
                'Before reaching for a workaround, work out <em>why</em> the signal is being pulled. In rough order of likelihood:'],
            ['type' => 'steps', 'items' => [
                ['title' => 'The power adapter or the battery',
                 'html'  => 'On many laptops a failing battery or an underpowered adapter makes the embedded controller assert PROCHOT to protect the voltage regulators. Test it: repeat the load test with the charger unplugged.'],
                ['title' => 'Real thermals',
                 'html'  => 'Run <code>sensors</code>. The package should sit well under its critical temperature. If it reads 95 to 100 °C, the CPU is genuinely hot, so clean the fans and repaste instead.'],
                ['title' => 'Power profile or governor',
                 'html'  => 'Check <code>powerprofilesctl</code> or <code>cpupower frequency-info</code>. A <code>powersave</code> governor with a low <code>max_perf_pct</code> can look similar, but it will respond to load.'],
                ['title' => 'A latched embedded controller',
                 'html'  => 'A full power drain resets it: shut down, unplug the charger, hold the power button for 30 to 60 seconds, plug back in and boot.'],
                ['title' => 'Firmware',
                 'html'  => 'An outdated BIOS/EC is a very common source of spurious PROCHOT on gaming laptops. Check your vendor support page for a BIOS newer than the one you run.'],
            ]],
            ['type' => 'p', 'html' =>
                'In my case the pin stayed asserted on both AC and battery, the battery reported 97% health with 83 charge cycles, and the BIOS was seven years old. That pointed at the embedded controller and firmware rather than a dying cell.'],
            ['type' => 'note', 'kind' => 'warn', 'title' => 'Important',
                'html' => 'If unplugging the charger immediately clears the throttling, the problem is the adapter or the battery. Replace it, do not work around it.'],

            ['type' => 'h2', 'text' => 'Step 6: the workaround that gave me the speed back'],
            ['type' => 'p', 'html' =>
                'Once the real faults are ruled out and the signal is still firing, you can tell the CPU to stop listening to BD PROCHOT by clearing <strong>bit 0 of MSR 0x1FC</strong>. Every core keeps its own copy, so write all of them:'],
            ['type' => 'code', 'caption' => 'disable BD PROCHOT listening', 'code' => <<<'SH'
sudo rdmsr -a 0x1FC              # read, usually ends in 5d or 5b
sudo wrmsr -a 0x1FC 0x2c005c    # clear bit 0, ...5d becomes ...5c
SH,
            ],
            ['type' => 'p', 'html' =>
                'The change takes effect immediately but does not survive a reboot, so make it persistent with a small systemd unit:'],
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
            ['type' => 'code', 'caption' => 'enable it', 'code' => <<<'SH'
sudo systemctl daemon-reload
sudo systemctl enable --now bd-prochot-fix.service
SH,
            ],
            ['type' => 'note', 'kind' => 'warn', 'title' => 'This is a workaround, not a repair',
                'html' => 'You are disabling a safety response. Do it only after ruling out a failing battery or adapter. If the machine ever shuts down abruptly under load afterwards, write the original value back (or disable the unit) and replace the battery.'],

            ['type' => 'h2', 'text' => 'The result'],
            ['type' => 'p', 'html' =>
                'Immediately after clearing the bit, the same full-load test reported <strong>3.1 GHz across all twelve threads at 94 °C</strong>, and normal desktop work now boosts to around 4 GHz. Chrome stopped stuttering. Idle still drops back to 800 MHz, so power saving is intact; only the artificial ceiling is gone.'],
            ['type' => 'chart', 'name' => 'speed'],

            ['type' => 'h2', 'text' => 'If you are on Windows'],
            ['type' => 'ul', 'items' => [
                'ThrottleStop: untick <strong>BD PROCHOT</strong> in the main window. That is the same bit, wrapped in a GUI.',
                'HWiNFO64: watch <em>Core Clocks</em>, <em>CPU Package Power</em> and the <em>PROCHOT</em> flag.',
                '<code>powercfg /qh</code> lists the processor performance limits Windows is applying.',
                'AMD systems use different registers, so look at <em>Ryzen Master</em> or <code>ryzen_monitor</code> for PROCHOT/HTC flags.',
            ]],

            ['type' => 'h2', 'text' => 'TL;DR checklist'],
            ['type' => 'ol', 'items' => [
                'Read the current clock: <code>grep MHz /proc/cpuinfo</code>.',
                'Stress every core for five seconds and read it again. Low at idle is normal; low under load is not.',
                'Check the ceiling the OS allows: <code>cpuinfo_max_freq</code>, <code>scaling_max_freq</code>, <code>max_perf_pct</code>.',
                'If the OS allows full speed but the clock will not move, read <code>rdmsr 0x64F</code>. The CPU will name the reason.',
                'If the reason is PROCHOT while temperatures are low: test the adapter and battery, reset the embedded controller, then update the BIOS.',
                'Only then consider clearing BD PROCHOT (bit 0 of <code>0x1FC</code>) as a workaround.',
            ]],

            ['type' => 'note', 'kind' => 'tip', 'title' => 'Measure first',
                'html' => 'The most useful number on a “slow computer” is almost never CPU percentage or RAM usage. It is the clock speed <em>under load</em>.'],
        ],
    ],
];
