<nav id="mainNav" class="navbar navbar-expand-lg">
    <div class="container" style="max-width:1280px">
        <a class="navbar-brand" href="<?= base_url() ?>">NOMADENSTUFF</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span></span>
            <span></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto nav-search-wrap">
                <li class="nav-item">
                    <form action="<?= base_url('shop/search') ?>" method="POST">
                        <div class="nav-search-box">
                            <input type="text" name="keyword" class="form-control nav-search-input" placeholder="Cari produk...">
                            <button type="submit" class="nav-search-btn"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </li>
            </ul>

            <ul class="navbar-nav align-items-lg-center nav-actions-wrap">
                <?php if (!$this->session->userdata('is_login')) : ?>
                    <li class="nav-item">
                        <div class="nav-auth-group">
                            <a href="<?= base_url('register') ?>" class="nav-btn-register">Register</a>
                            <a href="<?= base_url('login') ?>" class="nav-btn-login">Login</a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/profile') ?>" class="nav-btn-icon">
                            <i class="fas fa-user"></i>
                            <span><?= e($this->session->userdata('name')) ?></span>
                        </a>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <?php if ($this->session->userdata('is_login')) : ?>
                        <a href="<?= base_url('cart') ?>" class="nav-btn-icon" style="position:relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="nav-cart-badge"><?= getCart() ?></span>
                        </a>
                    <?php else : ?>
                        <a href="#" data-toggle="modal" data-target="#addToCartModal" class="nav-btn-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:380px">
        <div class="modal-content" style="border-radius:20px;border:none;box-shadow:0 20px 60px rgba(0,0,0,.15);padding:.5rem">
            <div class="modal-header" style="border:none;padding:1rem 1.25rem 0">
                <h5 class="modal-title" style="font-weight:700;font-size:1rem">Login Required</h5>
                <button type="button" class="close" data-dismiss="modal" style="font-size:1.5rem">&times;</button>
            </div>
            <div class="modal-body" style="padding:1rem 1.25rem">
                <p style="font-size:.9rem;color:#888;margin:0">Please login to add items to your cart.</p>
            </div>
            <div class="modal-footer" style="border:none;padding:.5rem 1.25rem 1.25rem;gap:.5rem">
                <button type="button" class="btn" data-dismiss="modal" style="border-radius:100px;border:1.5px solid #e0e0e0;font-size:.85rem;font-weight:600;padding:.5rem 1.25rem;color:#1a1a1a">Close</button>
                <a href="<?= base_url("login") ?>" class="btn" style="border-radius:100px;background:#1a1a1a;color:#fff;font-size:.85rem;font-weight:600;padding:.5rem 1.5rem;border:none">Login</a>
            </div>
        </div>
    </div>
</div>

<style>
/* ===========================
   NAVBAR — Base Styles
   =========================== */

#mainNav {
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(0,0,0,0.04);
    padding: 0.75rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
    transition: background 0.45s cubic-bezier(0.25,0.46,0.45,0.94),
                border-color 0.4s ease,
                box-shadow 0.4s ease;
}

/* Brand */
#mainNav .navbar-brand {
    font-size: 1.25rem;
    font-weight: 800;
    letter-spacing: -0.75px;
    color: #1a1a1a;
    text-decoration: none;
    transition: color 0.3s ease;
}

/* Toggler */
#mainNav .navbar-toggler {
    border: none;
    padding: 6px 4px;
    cursor: pointer;
    background: none;
    outline: none;
}

#mainNav .navbar-toggler span {
    display: block;
    width: 22px;
    height: 2px;
    background: #1a1a1a;
    margin: 5px 0;
    border-radius: 2px;
    transition: background 0.3s ease;
}

/* Collapse base */
#mainNav .navbar-collapse {
    background: transparent;
}

/* --- Search --- */
.nav-search-box {
    border: 1.5px solid #e8e8e8;
    border-radius: 100px;
    overflow: hidden;
    background: #f5f5f5;
    display: flex;
    transition: border-color 0.3s ease, background 0.3s ease;
}

.nav-search-box:focus-within {
    border-color: #d4a853;
}

.nav-search-input {
    border: none;
    background: transparent;
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
    flex: 1;
    box-shadow: none;
    height: 38px;
    outline: none;
    color: #1a1a1a;
}

.nav-search-input::placeholder {
    color: #999;
    opacity: 1;
}

.nav-search-btn {
    border: none;
    background: transparent;
    color: #999;
    padding: 0 1rem;
    cursor: pointer;
    transition: color 0.3s ease;
}

.nav-search-btn:hover {
    color: #1a1a1a;
}

/* --- Auth Buttons --- */
.nav-auth-group {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.nav-btn-register,
.nav-btn-login {
    text-align: center;
    padding: 0.45rem 1.35rem;
    border-radius: 100px;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.25,0.46,0.45,0.94);
    white-space: nowrap;
}

.nav-btn-register {
    color: #1a1a1a;
    border: 1.5px solid #e0e0e0;
}

.nav-btn-register:hover {
    border-color: #1a1a1a;
    color: #1a1a1a;
}

.nav-btn-login {
    color: #fff;
    background: #1a1a1a;
    border: 1.5px solid #1a1a1a;
}

.nav-btn-login:hover {
    background: #d4a853;
    border-color: #d4a853;
    color: #fff;
}

/* --- Icon Buttons (Profile, Cart) --- */
.nav-btn-icon {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.45rem 0.9rem;
    border-radius: 100px;
    font-size: 0.8rem;
    font-weight: 500;
    color: #1a1a1a;
    text-decoration: none;
    border: 1.5px solid #e0e0e0;
    transition: all 0.3s cubic-bezier(0.25,0.46,0.45,0.94);
    white-space: nowrap;
}

.nav-btn-icon:hover {
    border-color: #1a1a1a;
    color: #1a1a1a;
}

.nav-btn-icon i {
    font-size: 0.85rem;
}

/* --- Cart Badge --- */
.nav-cart-badge {
    background: #d4a853;
    color: #fff;
    font-size: 0.6rem;
    font-weight: 700;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* --- Spacing --- */
.nav-search-wrap {
    gap: 0.5rem;
}

.nav-search-wrap .nav-item {
    min-width: 200px;
    width: 100%;
}

.nav-actions-wrap {
    gap: 0.5rem;
    margin-top: 0.5rem;
    margin-bottom: 0;
}

@media (min-width: 992px) {
    .nav-actions-wrap {
        margin-top: 0;
    }
}

/* --- Mobile --- */
@media (max-width: 991.98px) {
    #mainNav .navbar-collapse {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        padding: 1rem 1.5rem 1.5rem;
        background: rgba(255,255,255,0.98);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 16px 40px rgba(0,0,0,0.06);
        z-index: 1000;
    }

    #mainNav .navbar-collapse .navbar-nav {
        flex-direction: column;
        width: 100%;
    }

    #mainNav .container {
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }

    .nav-auth-group {
        flex-direction: row;
        width: 100%;
    }

    .nav-btn-register,
    .nav-btn-login {
        flex: 1;
    }
}
</style>

<script>
$('#addToCartModal').on('show.bs.modal', function() {
    $('.modal-backdrop').css('opacity', 0.5);
});
$('#addToCartModal').on('hide.bs.modal', function() {
    $('.modal-backdrop').css('opacity', 1);
});
</script>