<nav class="nav">
    <div class="nav__inner">
        <a class="nav__brand" href="<?= base_url() ?>">NOMADENSTUFF</a>

        <div class="nav__center">
            <form action="<?= base_url('shop/search') ?>" method="POST" class="nav__search">
                <input type="text" name="keyword" placeholder="Search...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="nav__actions">
            <?php if (!$this->session->userdata('is_login')) : ?>
                <a href="<?= base_url('register') ?>" class="nav__action">Register</a>
                <a href="<?= base_url('login') ?>" class="nav__action">Login</a>
            <?php else : ?>
                <a href="<?= base_url('/profile') ?>" class="nav__action">
                    <i class="fas fa-user"></i>
                    <span><?= e($this->session->userdata('name')) ?></span>
                </a>
            <?php endif ?>
            <?php if ($this->session->userdata('is_login')) : ?>
                <a href="<?= base_url('cart') ?>" class="nav__action" style="position:relative">
                    <i class="fas fa-shopping-bag"></i>
                    <?php if (getCart() > 0) : ?><span class="nav__cart-badge"><?= getCart() ?></span><?php endif; ?>
                </a>
            <?php else : ?>
                <a href="#" data-toggle="modal" data-target="#addToCartModal" class="nav__action">
                    <i class="fas fa-shopping-bag"></i>
                </a>
            <?php endif; ?>
            <button class="nav__toggle">
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>

<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:380px">
        <div class="modal-content" style="border:none;border-radius:2px;padding:0">
            <div class="modal-header" style="border:none;padding:1.25rem 1.25rem 0">
                <h5 class="modal-title" style="font-size:0.9rem;font-weight:700">Sign in required</h5>
                <button type="button" class="close" data-dismiss="modal" style="font-size:1.25rem;color:#999">&times;</button>
            </div>
            <div class="modal-body" style="padding:1rem 1.25rem">
                <p style="font-size:0.82rem;color:var(--gray-500);margin:0">Please sign in to add items to your cart.</p>
            </div>
            <div class="modal-footer" style="border:none;padding:0 1.25rem 1.25rem;gap:0.5rem">
                <button type="button" class="btn btn--outline btn--sm" data-dismiss="modal" style="margin:0">Close</button>
                <a href="<?= base_url("login") ?>" class="btn btn--black btn--sm" style="margin:0">Sign In</a>
            </div>
        </div>
    </div>
</div>
