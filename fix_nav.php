<?php
$file = 'public/css/public.css';
$content = file_get_contents($file);

$fixedNav = <<< 'EOD'
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

/* ================= HERO */
EOD;

$content = preg_replace('/\.site-header\s*\{.*?\/\*\s*=================\s*HERO\s*\*\//s', $fixedNav, $content);
file_put_contents($file, $content);
echo "Fixed navigation CSS\n";
?>
