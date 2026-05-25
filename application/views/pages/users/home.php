<style>
:root {
    --cream: #faf7f2;
    --card-bg: #ffffff;
    --radius: 24px;
    --radius-sm: 16px;
    --radius-xl: 32px;
    --shadow: 0 8px 30px rgba(0,0,0,.06);
    --shadow-hover: 0 16px 48px rgba(0,0,0,.1);
    --accent: #d4a853;
    --text: #1a1a1a;
    --text-light: #8a8a8a;

    --hero-bg: #111111;
    --gold-dim: rgba(212,168,83,0.12);
    --ease-smooth: cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

/* =============================
   HERO — Editorial Fashion
   ============================= */

.hero {
    position: relative;
    width: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: var(--hero-bg);
}

.hero-split {
    display: grid;
    grid-template-columns: 40fr 60fr;
    width: 100%;
    min-height: 100vh;
}

/* --- Content (Left) --- */
.hero-content {
    position: relative;
    z-index: 5;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 7rem 3.5rem 4rem 5rem;
    background: var(--hero-bg);
}

@media (min-width: 1400px) {
    .hero-content {
        padding-left: 8rem;
    }
}

/* --- Visual (Right) --- */
.hero-visual {
    position: relative;
    overflow: hidden;
}

.hero-visual .parallax-layer {
    width: 100%;
    height: 115%;
    object-fit: cover;
    will-change: transform;
    position: relative;
    top: -7.5%;
}

.hero-visual .overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        105deg,
        rgba(17,17,17,0.88) 0%,
        rgba(17,17,17,0.45) 25%,
        rgba(17,17,17,0.08) 50%,
        transparent 75%
    );
    z-index: 1;
}

.hero-visual .vignette {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center, transparent 50%, rgba(0,0,0,0.5) 100%);
    z-index: 2;
    pointer-events: none;
}

/* --- Accent vertical line --- */
.hero-accent {
    position: absolute;
    top: 0;
    left: 40%;
    width: 1px;
    height: 100%;
    background: linear-gradient(
        to bottom,
        transparent 5%,
        rgba(212,168,83,0.3) 30%,
        rgba(212,168,83,0.15) 60%,
        transparent 95%
    );
    z-index: 4;
    pointer-events: none;
}

/* --- Badge --- */
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 3.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
    margin-bottom: 2.5rem;
}

.hero-badge::before {
    content: '';
    width: 20px;
    height: 1px;
    background: var(--accent);
    flex-shrink: 0;
}

/* --- Heading --- */
.hero-content h1 {
    font-size: clamp(2.4rem, 4.2vw, 3.8rem);
    font-weight: 800;
    color: #fff;
    line-height: 1.1;
    letter-spacing: -2.5px;
    margin: 0;
}

.hero-content h1 .line-light {
    display: block;
    font-weight: 300;
    font-style: italic;
    letter-spacing: -0.5px;
    color: rgba(255,255,255,0.75);
    margin-top: 0.1em;
    font-size: 0.85em;
}

.hero-content h1 .highlight {
    position: relative;
    display: inline-block;
}

.hero-content h1 .highlight::after {
    content: '';
    position: absolute;
    bottom: 3px;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--accent);
    opacity: 0.5;
    border-radius: 1px;
}

.hero-content h1 .highlight-line {
    display: block;
    margin-top: 0.05em;
}

/* --- Description --- */
.hero-content .sub {
    color: rgba(255,255,255,0.45);
    font-size: 0.9rem;
    line-height: 1.8;
    margin: 1.5rem 0 2.5rem;
    max-width: 380px;
}

/* --- CTAs --- */
.hero-actions {
    display: flex;
    gap: 1.25rem;
    align-items: center;
    flex-wrap: wrap;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: #fff;
    color: var(--hero-bg);
    font-weight: 700;
    font-size: 0.8rem;
    letter-spacing: 0.75px;
    padding: 1.05rem 2.5rem;
    border-radius: 2px;
    text-decoration: none;
    transition: all 0.4s var(--ease-smooth);
    border: none;
    cursor: pointer;
    text-transform: uppercase;
    position: relative;
    overflow: hidden;
}

.btn-primary:hover {
    background: var(--accent);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 16px 40px rgba(212,168,83,0.25);
}

.btn-primary svg {
    transition: transform 0.35s var(--ease-smooth);
}

.btn-primary:hover svg {
    transform: translateX(5px);
}

.btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: transparent;
    color: rgba(255,255,255,0.5);
    font-weight: 500;
    font-size: 0.8rem;
    padding: 1.05rem 0;
    text-decoration: none;
    border: none;
    border-bottom: 1px solid rgba(255,255,255,0.15);
    transition: all 0.35s ease;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 0.75px;
}

.btn-outline:hover {
    color: #fff;
    border-color: #fff;
    gap: 0.85rem;
}

/* --- Stats / Social Proof --- */
.hero-stats {
    display: flex;
    gap: 3rem;
    margin-top: 3rem;
    padding-top: 2.5rem;
    border-top: 1px solid rgba(255,255,255,0.06);
}

.hero-stat {
    position: relative;
}

.hero-stat:not(:last-child)::after {
    content: '';
    position: absolute;
    right: -1.5rem;
    top: 50%;
    transform: translateY(-50%);
    width: 1px;
    height: 28px;
    background: rgba(255,255,255,0.08);
}

.hero-stat h4 {
    font-size: 1.35rem;
    font-weight: 800;
    color: #fff;
    margin: 0;
    letter-spacing: -0.5px;
}

.hero-stat p {
    font-size: 0.68rem;
    color: rgba(255,255,255,0.3);
    margin: 0.3rem 0 0;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

/* --- Category Shortcuts --- */
.hero-categories {
    display: flex;
    gap: 0.6rem;
    margin-top: 2.5rem;
}

.cat-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem 1.3rem;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 2px;
    color: rgba(255,255,255,0.5);
    font-size: 0.68rem;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    transition: all 0.3s ease;
}

.cat-chip:hover {
    border-color: var(--accent);
    color: var(--accent);
    background: var(--gold-dim);
}

/* --- Floating Card --- */
.hero-card {
    position: absolute;
    z-index: 3;
    bottom: 3rem;
    right: 2rem;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 3px;
    padding: 1rem;
    min-width: 150px;
    pointer-events: none;
    animation: fadeInUp 0.8s 0.65s ease both;
}

.hero-card__label {
    font-size: 0.52rem;
    color: rgba(255,255,255,0.3);
    text-transform: uppercase;
    letter-spacing: 2.5px;
    margin-bottom: 0.5rem;
}

.hero-card__preview {
    width: 100%;
    aspect-ratio: 1/1;
    background: rgba(255,255,255,0.03);
    margin-bottom: 0.65rem;
    overflow: hidden;
    border-radius: 2px;
}

.hero-card__preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.hero-card:hover .hero-card__preview img {
    transform: scale(1.05);
}

.hero-card__title {
    font-size: 0.7rem;
    color: #fff;
    font-weight: 600;
    letter-spacing: 0.3px;
}

.hero-card__sub {
    font-size: 0.6rem;
    color: var(--accent);
    margin-top: 0.2rem;
    letter-spacing: 0.5px;
}

/* =============================
   ANIMATIONS
   ============================= */

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(24px); }
    to { opacity: 1; transform: translateY(0); }
}

.hero-badge { animation: fadeInUp 0.7s ease both; }
.hero-content h1 { animation: fadeInUp 0.7s 0.1s ease both; }
.hero-content .sub { animation: fadeInUp 0.7s 0.2s ease both; }
.hero-actions { animation: fadeInUp 0.7s 0.3s ease both; }
.hero-stats { animation: fadeInUp 0.7s 0.4s ease both; }
.hero-categories { animation: fadeInUp 0.7s 0.5s ease both; }
.hero-visual .parallax-layer { animation: fadeInUp 1s 0.15s ease both; }

/* =============================
   NAVBAR HERO INTEGRATION
   ============================= */

body.hero-mode #mainNav {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: rgba(17,17,17,0.45) !important;
    backdrop-filter: blur(14px) !important;
    -webkit-backdrop-filter: blur(14px) !important;
    border-bottom: 1px solid rgba(255,255,255,0.06) !important;
    box-shadow: none !important;
}

/* --- Brand --- */
body.hero-mode #mainNav .navbar-brand {
    color: #fff !important;
}

body.hero-mode #mainNav.scrolled .navbar-brand {
    color: var(--text) !important;
}

/* --- Toggler --- */
body.hero-mode #mainNav:not(.scrolled) .navbar-toggler span {
    background: rgba(255,255,255,0.85) !important;
}

body.hero-mode #mainNav.scrolled .navbar-toggler span {
    background: var(--text) !important;
}

/* --- Search Box --- */
body.hero-mode #mainNav:not(.scrolled) .nav-search-box {
    background: rgba(255,255,255,0.08) !important;
    border-color: rgba(255,255,255,0.12) !important;
}

body.hero-mode #mainNav:not(.scrolled) .nav-search-input {
    color: rgba(255,255,255,0.85) !important;
}

body.hero-mode #mainNav:not(.scrolled) .nav-search-input::placeholder {
    color: rgba(255,255,255,0.35) !important;
}

body.hero-mode #mainNav:not(.scrolled) .nav-search-btn {
    color: rgba(255,255,255,0.5) !important;
}

body.hero-mode #mainNav.scrolled .nav-search-box {
    background: #f5f5f5 !important;
    border-color: #e8e8e8 !important;
}

body.hero-mode #mainNav.scrolled .nav-search-input {
    color: var(--text) !important;
}

body.hero-mode #mainNav.scrolled .nav-search-input::placeholder {
    color: #999 !important;
}

body.hero-mode #mainNav.scrolled .nav-search-btn {
    color: #999 !important;
}

/* --- Auth Buttons --- */
body.hero-mode #mainNav:not(.scrolled) .nav-btn-register {
    color: rgba(255,255,255,0.75) !important;
    border-color: rgba(255,255,255,0.2) !important;
}

body.hero-mode #mainNav:not(.scrolled) .nav-btn-login {
    color: #fff !important;
    background: rgba(255,255,255,0.12) !important;
    border-color: rgba(255,255,255,0.12) !important;
}

body.hero-mode #mainNav.scrolled .nav-btn-register {
    color: var(--text) !important;
    border-color: #e0e0e0 !important;
}

body.hero-mode #mainNav.scrolled .nav-btn-login {
    color: #fff !important;
    background: var(--text) !important;
    border-color: var(--text) !important;
}

/* --- Profile & Cart Links --- */
body.hero-mode #mainNav:not(.scrolled) .nav-btn-icon {
    color: rgba(255,255,255,0.75) !important;
    border-color: rgba(255,255,255,0.2) !important;
}

body.hero-mode #mainNav.scrolled .nav-btn-icon {
    color: var(--text) !important;
    border-color: #e0e0e0 !important;
}

/* --- Scrolled Base --- */
body.hero-mode #mainNav.scrolled {
    background: rgba(255,255,255,0.97) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
    border-bottom: 1px solid rgba(0,0,0,0.04) !important;
    box-shadow: 0 1px 0 rgba(0,0,0,0.04) !important;
}

/* --- Mobile Collapse --- */
@media (max-width: 991.98px) {
    body.hero-mode #mainNav .navbar-collapse {
        background: rgba(255,255,255,0.98) !important;
        border-bottom: 1px solid rgba(0,0,0,0.04);
    }
    body.hero-mode #mainNav .navbar-collapse a,
    body.hero-mode #mainNav .navbar-collapse button {
        color: var(--text) !important;
        border-color: #e0e0e0 !important;
    }
    body.hero-mode #mainNav:not(.scrolled) .navbar-collapse {
        background: rgba(17,17,17,0.98) !important;
    }
    body.hero-mode #mainNav:not(.scrolled) .navbar-collapse a,
    body.hero-mode #mainNav:not(.scrolled) .navbar-collapse button {
        color: rgba(255,255,255,0.8) !important;
        border-color: rgba(255,255,255,0.15) !important;
    }
    body.hero-mode #mainNav:not(.scrolled) .navbar-collapse .nav-search-box {
        background: rgba(255,255,255,0.08) !important;
        border-color: rgba(255,255,255,0.12) !important;
    }
    body.hero-mode #mainNav:not(.scrolled) .navbar-collapse .nav-search-input {
        color: rgba(255,255,255,0.85) !important;
    }
    body.hero-mode #mainNav:not(.scrolled) .navbar-collapse .nav-search-btn {
        color: rgba(255,255,255,0.5) !important;
    }
}

/* =============================
   EXISTING SECTION STYLES
   ============================= */

.section {
    padding: 5rem 1.5rem;
    max-width: 1280px;
    margin: 0 auto;
}

.section-head {
    text-align: center;
    margin-bottom: 3rem;
}

.section-head .tag {
    display: inline-block;
    font-size: .75rem;
    font-weight: 600;
    letter-spacing: 3px;
    color: var(--accent);
    text-transform: uppercase;
    margin-bottom: .75rem;
}

.section-head h2 {
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 700;
    color: var(--text);
}

.section-head p {
    color: var(--text-light);
    max-width: 480px;
    margin: .75rem auto 0;
    font-size: .95rem;
}

.story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    background: var(--cream);
    border-radius: var(--radius-xl);
    padding: 3rem;
}

.story-image {
    border-radius: var(--radius);
    overflow: hidden;
}

.story-image img {
    width: 100%;
    display: block;
    border-radius: var(--radius);
}

.story-text .tag {
    font-size: .75rem;
    font-weight: 600;
    letter-spacing: 3px;
    color: var(--accent);
    text-transform: uppercase;
}

.story-text h2 {
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 700;
    color: var(--text);
    margin: .75rem 0 1.25rem;
    line-height: 1.25;
}

.story-text p {
    color: var(--text-light);
    line-height: 1.8;
    font-size: .95rem;
}

.stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
}

.stat-card {
    background: var(--card-bg);
    border-radius: var(--radius);
    padding: 2rem 1.5rem;
    text-align: center;
    box-shadow: var(--shadow);
    transition: .35s;
    border: 1px solid #f0f0f0;
}

.stat-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-3px);
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--cream);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    padding: 12px;
}

.stat-icon img {
    width: 100%;
    opacity: .8;
}

.stat-card h5 {
    font-weight: 700;
    font-size: .95rem;
    color: var(--text);
    margin-bottom: .35rem;
}

.stat-card p {
    font-size: .85rem;
    color: var(--text-light);
    line-height: 1.5;
    margin: 0;
}

.collection {
    padding: 0 1.5rem;
    max-width: 1280px;
    margin: 0 auto 4rem;
}

.collection-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: .5rem;
}

.collection-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text);
}

.collection-header h3 small {
    display: block;
    font-size: .8rem;
    font-weight: 400;
    color: var(--text-light);
    margin-top: 2px;
}

.collection-header a {
    color: var(--accent);
    font-size: .85rem;
    font-weight: 600;
    text-decoration: none;
}

.collection-header a:hover {
    text-decoration: underline;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
}

.prod-card {
    background: var(--card-bg);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: .35s;
    text-decoration: none;
    color: var(--text);
    border: 1px solid #f0f0f0;
}

.prod-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-4px);
}

.prod-img {
    aspect-ratio: 1/1;
    overflow: hidden;
    background: #f5f5f5;
}

.prod-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .5s;
}

.prod-card:hover .prod-img img {
    transform: scale(1.06);
}

.prod-body {
    padding: 1rem 1.15rem 1.25rem;
}

.prod-body .name {
    font-size: .9rem;
    font-weight: 600;
    margin-bottom: .2rem;
}

.prod-body .price {
    color: var(--accent);
    font-weight: 700;
    font-size: .95rem;
}

.cta-banner {
    max-width: 1280px;
    margin: 0 auto 4rem;
    padding: 0 1.5rem;
}

.cta-inner {
    background: var(--text);
    border-radius: var(--radius-xl);
    padding: 4rem 3rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.cta-inner h3 {
    font-size: clamp(1.2rem, 2.5vw, 1.8rem);
    font-weight: 700;
    color: #fff;
}

.cta-inner p {
    color: rgba(255,255,255,.55);
    font-size: .9rem;
    margin-top: .5rem;
}

.dots {
    display: flex;
    justify-content: center;
    gap: .5rem;
    margin-top: 1rem;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #ddd;
    transition: .3s;
    cursor: pointer;
    border: none;
    padding: 0;
}

.dot.active {
    background: var(--accent);
    width: 24px;
    border-radius: 4px;
}

@media (max-width: 992px) {
    .story-grid { grid-template-columns: 1fr; padding: 2rem; gap: 2rem; }
    .stats { grid-template-columns: repeat(2, 1fr); }
    .product-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
    .hero-split { grid-template-columns: 1fr; }
    .hero-content { padding: 6rem 2rem 3rem; }
    .hero-visual { display: none; }
    .hero-accent { display: none; }
    .hero-card { display: none; }
}

@media (max-width: 576px) {
    .hero-content { padding: 5rem 1.5rem 2.5rem; }
    .hero-content h1 { font-size: 2rem; }
    .hero-stats { gap: 1.5rem; flex-wrap: wrap; }
    .hero-stat:not(:last-child)::after { display: none; }
    .hero-actions { flex-direction: column; align-items: stretch; }
    .btn-primary { justify-content: center; }
    .stats { grid-template-columns: 1fr; }
    .product-grid { grid-template-columns: 1fr 1fr; gap: .75rem; }
    .hero-inner { min-height: 60vh; border-radius: var(--radius); }
    .cta-inner { padding: 2.5rem 1.5rem; flex-direction: column; text-align: center; }
    .story-grid { padding: 1.5rem; border-radius: var(--radius); }
}
</style>

<?php
$images = [];
foreach ($slider as $s) {
    $img = $s->image ? base_url("images/slider/$s->image") : base_url("images/slider/default.jpg");
    $images[] = $img;
}
$first = $images[0] ?? '';
$second = $images[1] ?? $first;
$third = $images[2] ?? $first;
?>

<!-- Hero -->
<section class="hero">
    <div class="hero-split">
        <!-- Content -->
        <div class="hero-content">
            <div class="hero-badge">Curated Archive</div>
            <h1>
                Where Vintage
                <em class="line-light">meets</em>
                <span class="highlight-line"><span class="highlight">Modern</span></span>
            </h1>
            <p class="sub">Pre-loved clothing, curated for those who value character over conformity.</p>
            <div class="hero-actions">
                <a href="<?= base_url('shop') ?>" class="btn-primary">
                    Shop Now
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7h10M7 3l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a href="<?= base_url('shop/women') ?>" class="btn-outline">Women's →</a>
                <a href="<?= base_url('shop/men') ?>" class="btn-outline">Men's →</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <h4>10K+</h4>
                    <p>Happy Customers</p>
                </div>
                <div class="hero-stat">
                    <h4>5K+</h4>
                    <p>Curated Pieces</p>
                </div>
                <div class="hero-stat">
                    <h4>98%</h4>
                    <p>Satisfaction</p>
                </div>
            </div>
            <div class="hero-categories">
                <a href="<?= base_url('shop/men') ?>" class="cat-chip">Men's</a>
                <a href="<?= base_url('shop/women') ?>" class="cat-chip">Women's</a>
                <a href="<?= base_url('shop') ?>" class="cat-chip">All</a>
            </div>
        </div>
        <!-- Visual -->
        <div class="hero-visual">
            <img class="parallax-layer" src="<?= $first ?>" alt="">
            <div class="overlay"></div>
            <div class="vignette"></div>
            <div class="hero-card">
                <div class="hero-card__label">New In</div>
                <div class="hero-card__preview">
                    <img src="<?= $second ?>" alt="">
                </div>
                <div class="hero-card__title">Archive Drop</div>
                <div class="hero-card__sub">View Collection</div>
            </div>
        </div>
    </div>
    <div class="hero-accent"></div>
</section>

<!-- Stats / Why -->
<section class="section">
    <div class="section-head">
        <span class="tag">// Why Us</span>
        <h2>Thrifting, Done Right</h2>
        <p>We make secondhand shopping feel like first-class.</p>
    </div>
    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon"><img src="<?= base_url('assets/img/truck.svg') ?>" alt=""></div>
            <h5>Express Shipping</h5>
            <p>Same-day dispatch. Tracked to your door.</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><img src="<?= base_url('assets/img/bag.svg') ?>" alt=""></div>
            <h5>Easy Shopping</h5>
            <p>Smart filters, smooth checkout, zero hassle.</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><img src="<?= base_url('assets/img/support.svg') ?>" alt=""></div>
            <h5>24/7 Support</h5>
            <p>Real humans, real fast. We've got your back.</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><img src="<?= base_url('assets/img/return.svg') ?>" alt=""></div>
            <h5>Free Returns</h5>
            <p>Not your style? Send it back, on us.</p>
        </div>
    </div>
</section>

<!-- Story -->
<section class="section" style="padding-top:0">
    <div class="story-grid">
        <div class="story-image">
            <img src="<?= base_url('assets/img/apaitu.png') ?>" alt="">
        </div>
        <div class="story-text">
            <span class="tag">// Our Story</span>
            <h2>Not Just Clothes.<br>Characters.</h2>
            <p>
                NOMADENSTUFF was born from a love for the hunt — digging through rails, finding forgotten gems, and
                giving them a second life. We're not a fast-fashion alternative. We're a mindset.
                <br><br>
                Every piece is handpicked, quality-checked, and ready for its next chapter. Whether it's a 90s
                Americana
                jacket or a timeless linen shirt, we believe what you wear should say something.
            </p>
        </div>
    </div>
</section>

<!-- Men -->
<section class="collection">
    <div class="collection-header">
        <div>
            <h3>Men<small>Bold. Classic. Effortless.</small></h3>
        </div>
        <a href="<?= base_url('shop/men') ?>">Explore All &rarr;</a>
    </div>
    <div class="product-grid">
        <?php $c = 0; foreach ($productL as $rowL) : if ($rowL->is_available != 1) continue; if ($c++ >= 4) break; ?>
        <a class="prod-card" href="<?= base_url("shop/detail/$rowL->slug") ?>">
            <div class="prod-img">
                <img src="<?= $rowL->image ? base_url("images/product/$rowL->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($rowL->title) ?>">
            </div>
            <div class="prod-body">
                <div class="name"><?= e($rowL->title) ?></div>
                <div class="price">Rp <?= formatRupiah($rowL->price) ?></div>
            </div>
        </a>
        <?php endforeach ?>
    </div>
</section>

<!-- Women -->
<section class="collection">
    <div class="collection-header">
        <div>
            <h3>Women<small>Feminine. Fierce. Found.</small></h3>
        </div>
        <a href="<?= base_url('shop/women') ?>">Explore All &rarr;</a>
    </div>
    <div class="product-grid">
        <?php $c = 0; foreach ($productW as $rowW) : if ($c++ >= 4) break; ?>
        <a class="prod-card" href="<?= base_url("shop/detail/$rowW->slug") ?>">
            <div class="prod-img">
                <img src="<?= $rowW->image ? base_url("images/product/$rowW->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($rowW->title) ?>">
            </div>
            <div class="prod-body">
                <div class="name"><?= e($rowW->title) ?></div>
                <div class="price">Rp <?= formatRupiah($rowW->price) ?></div>
            </div>
        </a>
        <?php endforeach ?>
    </div>
</section>

<!-- CTA -->
<section class="cta-banner">
    <div class="cta-inner">
        <div>
            <h3>Ready to Find Your Next Fit?</h3>
            <p>New arrivals drop every week. Don't miss out.</p>
        </div>
        <a href="<?= base_url('shop') ?>" class="btn-primary">
            Browse All
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7h10M7 3l4 4-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </div>
</section>

<script>
(function() {
    var nav = document.getElementById('mainNav');
    var hero = document.querySelector('.hero');
    var parallax = document.querySelector('.parallax-layer');

    if (!nav || !hero) return;

    document.body.classList.add('hero-mode');

    var ticking = false;
    var lastScroll = 0;

    function onScroll() {
        lastScroll = window.scrollY || window.pageYOffset;
        if (!ticking) {
            window.requestAnimationFrame(function() {
                var scrollY = lastScroll;
                var heroH = hero.offsetHeight;

                if (scrollY > 60) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }

                if (parallax && scrollY < heroH) {
                    var speed = 0.25;
                    var yPos = -(scrollY * speed);
                    parallax.style.transform = 'translate3d(0, ' + yPos + 'px, 0)';
                }

                ticking = false;
            });
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();
</script>
