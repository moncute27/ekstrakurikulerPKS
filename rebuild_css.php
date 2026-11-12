<?php
$file = 'public/css/public.css';
$content = file_get_contents($file);

$newTop = <<< 'EOD'
/* =====================================================
   PKS SMKN 2 PURWAKARTA ?" Design System (Halaman Publik)
   ===================================================== */

:root {
    --navy-900: #0F172A;
    --navy-800: #1E293B;
    --navy-700: #334155;
    --navy-600: #DC2626; /* Vibrant PKS Red */
    --navy-500: #EF4444;

    --gold-500: #F59E0B;
    --gold-400: #FBBF24;
    --gold-100: #FEF3C7;

    --ink: #111827;
    --muted: #64748B;
    --line: #E2E8F0;
    --surface: #ffffff;
    --bg: #F8FAFC;

    --success: #10B981;
    --danger: #EF4444;

    --radius-sm: 8px;
    --radius: 14px;
    --radius-lg: 22px;

    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.04);
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 12px 30px rgba(220, 38, 38, 0.12);

    --container: 1180px;
    --header-h: 76px;
}

*,
*::before,
*::after {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    margin: 0;
    font-family: 'Poppins', 'Segoe UI', system-ui, -apple-system, sans-serif;
    color: var(--ink);
    background: var(--bg);
    line-height: 1.65;
    -webkit-font-smoothing: antialiased;
}

img {
    max-width: 100%;
    display: block;
}

a {
    color: inherit;
    text-decoration: none;
}

h1, h2, h3, h4 {
    margin: 0 0 .5rem;
    line-height: 1.25;
    font-weight: 700;
    letter-spacing: -.01em;
}

p {
    margin: 0 0 1rem;
}

.container {
    width: min(100% - 2.5rem, var(--container));
    margin-inline: auto;
}

/* ================= NAVBAR ================= */

.site-header {
    position: sticky;
    top: 0;
    z-index: 60;
    background: rgba(255, 255, 255, .98);
    backdrop-filter: blur(10px);
    border-bottom: 2px solid var(--navy-600);
    box-shadow: var(--shadow-sm);
}

.site-header__inner {
    display: flex;
    align-items: center;
    gap: 1rem;
    height: var(--header-h);
}

.brand {
    display: flex;
    align-items: center;
    gap: .75rem;
    color: var(--navy-900);
    flex-shrink: 0;
}

.brand img {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--navy-600);
    background: #fff;
    padding: 2px;
}

.brand__text strong {
    display: block;
    font-size: .95rem;
    line-height: 1.2;
    letter-spacing: .02em;
}

.brand__text span {
    display: block;
    font-size: .72rem;
    color: var(--muted);
    letter-spacing: .04em;
    text-transform: uppercase;
}

.main-nav {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: .15rem;
}

.main-nav a {
    color: var(--navy-800);
    padding: .5rem .8rem;
    border-radius: 999px;
    font-size: .88rem;
    font-weight: 600;
    transition: background .18s, color .18s;
    white-space: nowrap;
}

.main-nav a:hover {
    background: rgba(220, 38, 38, .08);
    color: var(--navy-600);
}

.main-nav a.is-active {
    background: var(--navy-600);
    color: #fff;
    font-weight: 700;
}

.nav-login {
    margin-left: .5rem;
    border: 1px solid var(--navy-600);
    color: var(--navy-600) !important;
}

.nav-login:hover {
    background: var(--navy-600);
    color: #fff !important;
}

.nav-toggle {
    display: none;
    margin-left: auto;
    background: rgba(220, 38, 38, .1);
    border: 0;
    color: var(--navy-600);
    width: 42px;
    height: 42px;
    border-radius: 10px;
    font-size: 1.2rem;
    cursor: pointer;
}

/* ================= HERO ================= */

.hero {
EOD;

$content = preg_replace('/^\/\* =====================================================.*?\.hero\s*\{/s', $newTop, $content);

// We need to restore the mobile nav inside the @media (max-width: 768px) block correctly.
// Let's find the media query at the end.
$mobileNavReplacement = <<< 'EOD'
    .main-nav {
        position: absolute;
        top: var(--header-h);
        left: 0;
        right: 0;
        background: #ffffff;
        flex-direction: column;
        padding: 1rem;
        gap: .5rem;
        border-bottom: 3px solid var(--navy-600);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        display: none;
        align-items: stretch;
    }

    .main-nav.is-open {
        display: flex;
    }

    .main-nav a {
        width: 100%;
        text-align: center;
        padding: .75rem;
        border-radius: 8px;
        color: var(--navy-800);
    }
EOD;

// Look for .main-nav inside the media query and replace it
$content = preg_replace('/@media\s*\(\s*max-width\s*:\s*768px\s*\)\s*\{[\s\S]*?(\.main-nav\s*\{[\s\S]*?\.main-nav\.is-open\s*\{[\s\S]*?\})/s', 
    str_replace('', $mobileNavReplacement, ''), $content);

file_put_contents($file, $content);
echo "Perfectly rebuilt CSS\n";
?>
