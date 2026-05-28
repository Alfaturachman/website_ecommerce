<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'NOMADENSTUFF' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/premium.css') ?>">
</head>
<body>

    <?php $isAuth = strpos($page, 'auth/') !== false; ?>
    <?php $isHome = strpos($page, 'users/home') !== false; ?>

    <?php if (!$isAuth) $this->load->view('layouts/user/_navbar') ?>

    <main style="<?= $isAuth || $isHome ? '' : 'padding-top:var(--nav-height)' ?>">
        <?php $this->load->view($page) ?>
    </main>

    <?php if (!$isAuth) : ?>
    <footer class="footer">
        <div class="footer__inner">
            <div class="footer__grid">
                <div>
                    <div class="footer__brand">NOMADENSTUFF</div>
                    <p class="footer__desc">
                        Curated archive — every piece has a story. Premium pre-loved clothing with character, quality, and soul.
                    </p>
                    <div class="footer__social">
                        <a href="https://www.instagram.com/nomadenstuff" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://wa.me/6288229889507" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://shopee.co.id/nomadenstuff_" target="_blank" style="font-size:0.7rem;font-weight:700">S</a>
                    </div>
                </div>
                <div>
                    <div class="footer__heading">Shop</div>
                    <div class="footer__links">
                        <a href="<?= base_url('shop') ?>" class="footer__link">Shop All</a>
                        <a href="<?= base_url('shop/men') ?>" class="footer__link">Men's</a>
                        <a href="<?= base_url('shop/women') ?>" class="footer__link">Women's</a>
                    </div>
                </div>
                <div>
                    <div class="footer__heading">Account</div>
                    <div class="footer__links">
                        <a href="<?= base_url('myorder') ?>" class="footer__link">My Orders</a>
                        <a href="<?= base_url('profile') ?>" class="footer__link">Profile</a>
                    </div>
                </div>
                <div>
                    <div class="footer__heading">Contact</div>
                    <div class="footer__links">
                        <span class="footer__link" style="cursor:default">Jl. Taman Siswa, Sekaran</span>
                        <span class="footer__link" style="cursor:default">Kota Semarang 50229</span>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <p class="footer__copy">&copy; <?= date('Y') ?> Alfaturachman Maulana Pahlevi</p>
                <p class="footer__copy">Thrift with purpose.</p>
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var nav = document.querySelector('.nav');
        var toggler = document.querySelector('.nav__toggle');
        var navCenter = document.querySelector('.nav__center');

        if (toggler) {
            toggler.addEventListener('click', function() {
                navCenter.classList.toggle('nav__center--open');
            });
        }

        if (nav && document.querySelector('.hero')) {
            nav.classList.add('nav--transparent');
            var ticking = false;
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        if (window.scrollY > 80) {
                            nav.classList.add('nav--scrolled');
                        } else {
                            nav.classList.remove('nav--scrolled');
                        }
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });
        }

        gsap.registerPlugin(ScrollTrigger);
        document.querySelectorAll('.reveal').forEach(function(el) {
            ScrollTrigger.create({
                trigger: el,
                start: 'top 85%',
                onEnter: function() { el.classList.add('reveal--visible'); }
            });
        });
    });
    </script>
</body>
</html>
