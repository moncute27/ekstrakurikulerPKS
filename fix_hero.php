<?php
$file = 'public/css/public.css';
$content = file_get_contents($file);

// Replace hero background
$content = preg_replace('/\.hero\s*\{\s*position:\s*relative;\s*min-height:\s*68vh;\s*display:\s*grid;\s*align-items:\s*center;\s*color:\s*#fff;\s*overflow:\s*hidden;\s*background:\s*var\(--navy-900\);\s*\}/s', ".hero {\n    position: relative;\n    min-height: 68vh;\n    display: grid;\n    align-items: center;\n    color: #fff;\n    overflow: hidden;\n    background: linear-gradient(135deg, rgba(153, 27, 27, 0.95) 0%, rgba(220, 38, 38, 0.85) 100%);\n}", $content);

// Replace footer background
$content = preg_replace('/\.site-footer\s*\{\s*background:\s*var\(--navy-900\);/s', ".site-footer {\n    background: var(--navy-900);\n    border-top: 4px solid var(--navy-600);", $content);

file_put_contents($file, $content);
?>
