<style>
:root {
    --hero-bg: #0a0a0a;
}

.hero {
    position: relative;
    width: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: var(--hero-bg);
    overflow: hidden;
}

.hero__split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    width: 100%;
    min-height: 100vh;
}

.hero__content {
    position: relative;
    z-index: 5;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 8rem 4rem 4rem 5rem;
    background: var(--hero-bg);
}

.hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.3);
    margin-bottom: 2rem;
}

.hero__badge::before {
    content: '';
    width: 24px;
    height: 1px;
    background: rgba(255,255,255,0.3);
}

.hero__heading {
    font-size: clamp(2.5rem, 4.5vw, 4.5rem);
    font-weight: 800;
    color: #fff;
    line-height: 0.95;
    letter-spacing: -0.04em;
    margin: 0;
}

.hero__heading .light {
    display: block;
    font-weight: 300;
    color: rgba(255,255,255,0.5);
    font-size: 0.85em;
    margin-top: 0.05em;
    letter-spacing: -0.02em;
}

.hero__heading .highlight {
    display: inline-block;
    position: relative;
}

.hero__heading .highlight::after {
    content: '';
    position: absolute;
    bottom: 4px;
    left: 0;
    right: 0;
    height: 4px;
    background: rgba(255,255,255,0.15);
}

.hero__desc {
    color: rgba(255,255,255,0.35);
    font-size: 0.9rem;
    line-height: 1.8;
    margin: 1.5rem 0 2.5rem;
    max-width: 400px;
}

.hero__actions {
    display: flex;
    gap: 1.5rem;
    align-items: center;
    flex-wrap: wrap;
}

.hero__visual {
    position: relative;
    overflow: hidden;
}

.hero__visual img {
    width: 100%;
    height: 115%;
    object-fit: cover;
    position: relative;
    top: -7.5%;
}

.hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(105deg, rgba(10,10,10,0.9) 0%, rgba(10,10,10,0.4) 30%, transparent 55%);
    z-index: 1;
}

.hero__vignette {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center, transparent 40%, rgba(0,0,0,0.6) 100%);
    z-index: 2;
    pointer-events: none;
}

.hero__stats {
    display: flex;
    gap: 2.5rem;
    margin-top: 2.5rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255,255,255,0.06);
}

.hero__stat h4 {
    font-size: 1.25rem;
    font-weight: 800;
    color: #fff;
    margin: 0;
    letter-spacing: -0.02em;
}

.hero__stat p {
    font-size: 0.6rem;
    color: rgba(255,255,255,0.25);
    margin: 0.3rem 0 0;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.hero__cats {
    display: flex;
    gap: 0.5rem;
    margin-top: 2rem;
}

.hero__cat {
    padding: 0.5rem 1rem;
    border: 1px solid rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.35);
    font-size: 0.65rem;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    transition: 0.3s ease;
}

.hero__cat:hover {
    border-color: rgba(255,255,255,0.3);
    color: rgba(255,255,255,0.7);
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.hero__badge { animation: fadeUp 0.7s ease both; }
.hero__heading { animation: fadeUp 0.7s 0.1s ease both; }
.hero__desc { animation: fadeUp 0.7s 0.2s ease both; }
.hero__actions { animation: fadeUp 0.7s 0.3s ease both; }
.hero__stats { animation: fadeUp 0.7s 0.4s ease both; }
.hero__cats { animation: fadeUp 0.7s 0.5s ease both; }
.hero__visual img { animation: fadeUp 1s 0.1s ease both; }

@media (max-width: 768px) {
    .hero__split { grid-template-columns: 1fr; }
    .hero__content { padding: 6rem 1.5rem 3rem; }
    .hero__visual { display: none; }
    .hero__heading { font-size: 2.2rem; }
}

@media (max-width: 576px) {
    .hero__content { padding: 5rem 1.25rem 2.5rem; }
    .hero__stats { gap: 1.5rem; flex-wrap: wrap; }
    .hero__actions { flex-direction: column; align-items: stretch; }
}
</style>

<?php
$first = '';
foreach ($slider as $s) {
    $imgPath = $s->image;
    if ($imgPath && file_exists(FCPATH . "images/slider/$imgPath")) {
        $first = base_url("images/slider/$imgPath");
        break;
    }
}
if (!$first) {
    $first = base_url("images/slider/default.jpg");
}
?>

<section class="hero">
    <div class="hero__split">
        <div class="hero__content">
            <div class="hero__badge">Curated Archive</div>
            <h1 class="hero__heading">
                Where Vintage
                <span class="light">meets</span>
                <span class="highlight">Modern</span>
            </h1>
            <p class="hero__desc">Pre-loved clothing, curated for those who value character over conformity.</p>
            <div class="hero__actions">
                <a href="<?= base_url('shop') ?>" class="btn btn--white">
                    Shop Now
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7h10M7 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a href="<?= base_url('shop/women') ?>" class="btn btn--link" style="color:rgba(255,255,255,0.5)">Women's</a>
                <a href="<?= base_url('shop/men') ?>" class="btn btn--link" style="color:rgba(255,255,255,0.5)">Men's</a>
            </div>
            <div class="hero__stats">
                <div class="hero__stat">
                    <h4>1K+</h4>
                    <p>Happy Customers</p>
                </div>
                <div class="hero__stat">
                    <h4>500+</h4>
                    <p>Curated Pieces</p>
                </div>
                <div class="hero__stat">
                    <h4>98%</h4>
                    <p>Satisfaction</p>
                </div>
            </div>
        </div>
        <div class="hero__visual">
            <img src="<?= $first ?>" alt="">
            <div class="hero__overlay"></div>
            <div class="hero__vignette"></div>
        </div>
    </div>
</section>

<!-- Marquee -->
<div class="marquee">
    <div class="marquee__inner">
        <span class="marquee__item">New Collection Every Week</span>
        <span class="marquee__item">Curated Vintage Archive</span>
        <span class="marquee__item">Premium Thrift Since 2023</span>
        <span class="marquee__item">New Collection Every Week</span>
        <span class="marquee__item">Curated Vintage Archive</span>
        <span class="marquee__item">Premium Thrift Since 2023</span>
    </div>
</div>

<!-- Why Us -->
<section class="section reveal">
    <div class="section-header section-header--centered">
        <div class="section-label">// Why Us</div>
        <h2 class="section-title">Thrifting, Done Right</h2>
        <p class="section-subtitle" style="margin:0.75rem auto 0">We make secondhand shopping feel like first-class.</p>
    </div>
    <div class="product-grid" style="grid-template-columns:repeat(4,1fr);gap:1.5rem">
        <div class="product-card reveal reveal-delay-1" style="cursor:default">
            <div class="product-card__image" style="aspect-ratio:1/1;margin-bottom:0;background:var(--gray-bg);display:flex;align-items:center;justify-content:center">
                <i class="fas fa-truck" style="font-size:2rem;color:var(--gray-300)"></i>
            </div>
            <div style="padding:1rem 0 0">
                <div class="product-card__title" style="font-size:0.95rem;text-align:center">Express Shipping</div>
                <div style="font-size:0.78rem;color:var(--gray-500);text-align:center;margin-top:0.25rem;line-height:1.5">Same-day dispatch. Tracked to your door.</div>
            </div>
        </div>
        <div class="product-card reveal reveal-delay-2" style="cursor:default">
            <div class="product-card__image" style="aspect-ratio:1/1;margin-bottom:0;background:var(--gray-bg);display:flex;align-items:center;justify-content:center">
                <i class="fas fa-bag-shopping" style="font-size:2rem;color:var(--gray-300)"></i>
            </div>
            <div style="padding:1rem 0 0">
                <div class="product-card__title" style="font-size:0.95rem;text-align:center">Easy Shopping</div>
                <div style="font-size:0.78rem;color:var(--gray-500);text-align:center;margin-top:0.25rem;line-height:1.5">Smart filters, smooth checkout, zero hassle.</div>
            </div>
        </div>
        <div class="product-card reveal reveal-delay-3" style="cursor:default">
            <div class="product-card__image" style="aspect-ratio:1/1;margin-bottom:0;background:var(--gray-bg);display:flex;align-items:center;justify-content:center">
                <i class="fas fa-headset" style="font-size:2rem;color:var(--gray-300)"></i>
            </div>
            <div style="padding:1rem 0 0">
                <div class="product-card__title" style="font-size:0.95rem;text-align:center">24/7 Support</div>
                <div style="font-size:0.78rem;color:var(--gray-500);text-align:center;margin-top:0.25rem;line-height:1.5">Real humans, real fast. We've got your back.</div>
            </div>
        </div>
        <div class="product-card reveal reveal-delay-4" style="cursor:default">
            <div class="product-card__image" style="aspect-ratio:1/1;margin-bottom:0;background:var(--gray-bg);display:flex;align-items:center;justify-content:center">
                <i class="fas fa-rotate-left" style="font-size:2rem;color:var(--gray-300)"></i>
            </div>
            <div style="padding:1rem 0 0">
                <div class="product-card__title" style="font-size:0.95rem;text-align:center">Free Returns</div>
                <div style="font-size:0.78rem;color:var(--gray-500);text-align:center;margin-top:0.25rem;line-height:1.5">Not your style? Send it back, on us.</div>
            </div>
        </div>
    </div>
</section>

<!-- Story -->
<section class="section reveal" style="padding-top:0">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;padding:0">
        <div style="overflow:hidden">
            <img src="<?= base_url('assets/img/apaitu.png') ?>" alt="" style="width:100%;display:block">
        </div>
        <div>
            <div class="section-label">// Our Story</div>
            <h2 class="section-title">Not Just Clothes.<br>Characters.</h2>
            <p style="color:var(--gray-500);line-height:1.8;font-size:0.95rem;margin-top:1rem">
                NOMADENSTUFF was born from a love for the hunt — digging through rails, finding forgotten gems, and
                giving them a second life. We're not a fast-fashion alternative. We're a mindset.
            </p>
            <p style="color:var(--gray-500);line-height:1.8;font-size:0.95rem;margin-top:0.75rem">
                Every piece is handpicked, quality-checked, and ready for its next chapter. Whether it's a 90s
                Americana jacket or a timeless linen shirt, we believe what you wear should say something.
            </p>
        </div>
    </div>
</section>

<!-- Men's Collection -->
<section class="section reveal" style="padding-top:0">
    <div class="section-header section-header--between">
        <div>
            <div class="section-label">Men's</div>
            <h2 class="section-title" style="font-size:1.5rem">Bold. Classic. Effortless.</h2>
        </div>
        <a href="<?= base_url('shop/men') ?>" class="btn btn--link">View All</a>
    </div>
    <div class="product-grid">
        <?php $c = 0; foreach ($productL as $rowL) : if ($rowL->is_available != 1) continue; if ($c++ >= 4) break; ?>
        <a class="product-card" href="<?= base_url("shop/detail/$rowL->slug") ?>">
            <div class="product-card__image">
                <img src="<?= $rowL->image ? base_url("images/product/$rowL->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($rowL->title) ?>">
                <div class="product-card__hover"></div>
            </div>
            <div class="product-card__category"><?= e($rowL->title) ?></div>
            <div class="product-card__title"><?= e($rowL->title) ?></div>
            <div class="product-card__price">Rp <?= formatRupiah($rowL->price) ?></div>
        </a>
        <?php endforeach ?>
    </div>
</section>

<!-- Women's Collection -->
<section class="section reveal" style="padding-top:0">
    <div class="section-header section-header--between">
        <div>
            <div class="section-label">Women's</div>
            <h2 class="section-title" style="font-size:1.5rem">Feminine. Fierce. Found.</h2>
        </div>
        <a href="<?= base_url('shop/women') ?>" class="btn btn--link">View All</a>
    </div>
    <div class="product-grid">
        <?php $c = 0; foreach ($productW as $rowW) : if ($c++ >= 4) break; ?>
        <a class="product-card" href="<?= base_url("shop/detail/$rowW->slug") ?>">
            <div class="product-card__image">
                <img src="<?= $rowW->image ? base_url("images/product/$rowW->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($rowW->title) ?>">
                <div class="product-card__hover"></div>
            </div>
            <div class="product-card__category"><?= e($rowW->title) ?></div>
            <div class="product-card__title"><?= e($rowW->title) ?></div>
            <div class="product-card__price">Rp <?= formatRupiah($rowW->price) ?></div>
        </a>
        <?php endforeach ?>
    </div>
</section>

<!-- CTA Banner -->
<section class="section reveal" style="padding-top:0">
    <div style="background:var(--near-black);padding:4rem 3rem;display:flex;justify-content:space-between;align-items:center;gap:2rem;flex-wrap:wrap">
        <div>
            <h2 style="font-size:clamp(1.25rem,2.5vw,1.75rem);font-weight:800;color:#fff;letter-spacing:-0.02em;margin:0">Ready to Find Your Next Fit?</h2>
            <p style="color:rgba(255,255,255,0.35);font-size:0.9rem;margin-top:0.5rem">New arrivals drop every week. Don't miss out.</p>
        </div>
        <a href="<?= base_url('shop') ?>" class="btn btn--white">
            Browse All
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7h10M7 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
    </div>
</section>

<script>
(function() {
    var nav = document.querySelector('.nav');
    var hero = document.querySelector('.hero');
    var parallax = document.querySelector('.hero__visual img');

    if (!nav || !hero) return;

    var ticking = false;
    var lastScroll = 0;

    function onScroll() {
        lastScroll = window.scrollY || window.pageYOffset;
        if (!ticking) {
            window.requestAnimationFrame(function() {
                var scrollY = lastScroll;
                var heroH = hero.offsetHeight;

                if (scrollY > 80) {
                    nav.classList.add('nav--scrolled');
                } else {
                    nav.classList.remove('nav--scrolled');
                }

                if (parallax && scrollY < heroH) {
                    var speed = 0.25;
                    parallax.style.transform = 'translate3d(0, ' + -(scrollY * speed) + 'px, 0)';
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
