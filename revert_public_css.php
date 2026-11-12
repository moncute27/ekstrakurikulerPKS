<?php
$file = 'public/css/public.css';
$content = file_get_contents($file);

$newTop = <<< 'EOD'
/* =====================================================
   PKS SMKN 2 PURWAKARTA ?" Design System (Halaman Publik)
   ===================================================== */

:root {
    --navy-900: #4c0b0b;
    --navy-800: #681010;
    --navy-700: #8c1515;
    --navy-600: #b91c1c;
    --navy-500: #e55050;

    --gold-500: #f20505;
    --gold-400: #ff3333;
    --gold-100: #ffdcdc;

    --ink: #2e1616;
    --muted: #7f5b5b;
    --line: #efe3e3;
    --surface: #ffffff;
    --bg: #fbf5f5;

    --success: #128a56;
    --danger: #c0392b;

    --radius-sm: 8px;
    --radius: 14px;
    --radius-lg: 22px;

    --shadow-sm: 0 1px 2px rgba(15, 30, 55, .06), 0 2px 8px rgba(15, 30, 55, .05);
    --shadow: 0 8px 24px rgba(15, 30, 55, .09);
    --shadow-lg: 0 20px 48px rgba(15, 30, 55, .16);

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
    background: rgba(11, 27, 51, .96);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, .08);
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
    color: #fff;
    flex-shrink: 0;
}

.brand img {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--gold-500);
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
    color: #d6a9a9;
    letter-spacing: .04em;
}

.main-nav {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: .15rem;
}

.main-nav a {
    color: #eed3d3;
    padding: .5rem .8rem;
    border-radius: 999px;
    font-size: .88rem;
    font-weight: 500;
    transition: background .18s, color .18s;
    white-space: nowrap;
}

.main-nav a:hover {
    background: rgba(255, 255, 255, .1);
    color: #fff;
}

.main-nav a.is-active {
    background: var(--gold-500);
    color: var(--navy-900);
    font-weight: 600;
}

.nav-login {
    margin-left: .5rem;
    border: 1px solid rgba(255, 255, 255, .28);
    color: #fff !important;
}

.nav-login:hover {
    border-color: var(--gold-500);
}

.nav-toggle {
    display: none;
    margin-left: auto;
    background: rgba(255, 255, 255, .12);
    border: 0;
    color: #fff;
    width: 42px;
    height: 42px;
    border-radius: 10px;
    font-size: 1.2rem;
    cursor: pointer;
}

/* ================= HERO ================= */

.hero {
    position: relative;
    min-height: 68vh;
    display: grid;
    align-items: center;
    color: #fff;
    overflow: hidden;
    background: var(--navy-900);
}

.hero__bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: .38;
}
EOD;

// Replace the top part up to .hero__bg
$content = preg_replace('/^\/\* =====================================================.*?\.hero__bg\s*\{\s*position:\s*absolute;\s*inset:\s*0;\s*width:\s*100%;\s*height:\s*100%;\s*object-fit:\s*cover;\s*opacity:\s*\.[0-9]+;\s*mix-blend-mode:\s*multiply;\s*\}/s', $newTop, $content);

// In case the above regex failed (because the hero__bg might have been altered differently):
// Let's do a more robust replace:
$content = preg_replace('/^\/\* =====================================================.*?(?=\.hero__content)/s', $newTop . "\n\n", $content);


// Restore the footer background
$content = preg_replace('/\.site-footer\s*\{\s*background:\s*var\(--navy-900\);\s*border-top:\s*4px\s*solid\s*var\(--navy-600\);/s', ".site-footer {\n    background: var(--navy-900);\n    color: #fff;\n    padding: 4rem 0 2rem;\n    border-top: 4px solid var(--navy-600);", $content);

// Restore the mobile nav inside @media
$mobileNavOriginal = <<< 'EOD'
    .main-nav {
        position: absolute;
        top: var(--header-h);
        left: 0;
        right: 0;
        background: var(--navy-900);
        flex-direction: column;
        padding: 1rem;
        gap: .5rem;
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
        color: #fff;
    }
EOD;

$content = preg_replace('/@media\s*\(\s*max-width\s*:\s*768px\s*\)\s*\{[\s\S]*?(\.main-nav\s*\{[\s\S]*?\.main-nav\.is-open\s*\{[\s\S]*?\})/s', 
    str_replace('', $mobileNavOriginal, ''), $content);


file_put_contents($file, $content);
echo "Reverted CSS successfully\n";
?>
