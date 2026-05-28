<div style="padding:2rem 2rem;max-width:var(--max-width);margin:0 auto">
    <?php if ($content) : ?>

    <div class="breadcrumb">
        <a href="<?= base_url() ?>">Home</a>
        <span>/</span>
        <a href="<?= base_url('shop') ?>">Shop</a>
        <span>/</span>
        <span class="current"><?= e($content->product_title) ?></span>
    </div>

    <div class="detail-grid">
        <!-- Gallery -->
        <div class="detail-gallery">
            <div class="detail-gallery__main">
                <img src="<?= $content->image ? base_url("images/product/$content->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($content->product_title) ?>">
            </div>
        </div>

        <!-- Info -->
        <div class="detail-info">
            <div class="detail-info__category"><?= e($content->category_title) ?></div>
            <h1 class="detail-info__title"><?= e($content->product_title) ?></h1>
            <div class="detail-info__price">Rp <?= formatRupiah($content->price) ?></div>
            <div class="detail-info__availability">
                <?php if ($content->is_available == 1) : ?>
                    In stock
                <?php else : ?>
                    Currently unavailable
                <?php endif ?>
            </div>

            <hr class="detail-info__divider">

            <div class="detail-info__attrs">
                <div>
                    <div class="detail-info__attr-label">Size</div>
                    <div class="detail-info__attr-value"><?= e($content->size) ?></div>
                </div>
                <div>
                    <div class="detail-info__attr-label">Color</div>
                    <div class="detail-info__attr-value"><?= e($content->color) ?></div>
                </div>
                <div>
                    <div class="detail-info__attr-label">Category</div>
                    <div class="detail-info__attr-value"><?= e($content->category_title) ?></div>
                </div>
                <div>
                    <div class="detail-info__attr-label">Availability</div>
                    <div class="detail-info__attr-value"><?= $content->is_available == 1 ? '1' : '0' ?> available</div>
                </div>
            </div>

            <hr class="detail-info__divider">

            <div>
                <div class="detail-info__attr-label" style="margin-bottom:0.5rem">Description</div>
                <p class="detail-info__desc"><?= e($content->description) ?></p>
            </div>

            <hr class="detail-info__divider">

            <form action="<?= base_url('cart/add') ?>" method="POST" id="addToCartForm">
                <input type="hidden" name="id_product" value="<?= e($content->id) ?>">
                <input type="hidden" name="quantity" value="<?= $content->is_available == 1 ? '1' : '0' ?>">

                <?php if ($content->is_available == 1) : ?>
                    <button type="submit" class="btn btn--black w-full" style="height:50px;font-size:0.8rem">
                        Add to Cart
                    </button>
                <?php else : ?>
                    <button type="button" class="btn btn--outline w-full" style="height:50px;font-size:0.8rem;cursor:not-allowed;opacity:0.4" disabled>
                        Unavailable
                    </button>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:360px">
            <div class="modal-content" style="border:none;border-radius:2px;padding:1.5rem">
                <div class="modal-header" style="border:none;padding:0 0 0.75rem">
                    <h5 class="modal-title" style="font-size:0.9rem;font-weight:700">Already in cart</h5>
                    <button type="button" class="close" data-dismiss="modal" style="font-size:1.25rem;color:#999;border:none;background:none;cursor:pointer">&times;</button>
                </div>
                <div class="modal-body" style="padding:0 0 1.25rem">
                    <p style="font-size:0.82rem;color:var(--gray-500);margin:0;line-height:1.6">This item is already in your shopping cart.</p>
                </div>
                <div class="modal-footer" style="border:none;padding:0;gap:0.5rem;display:flex">
                    <button type="button" data-dismiss="modal" class="btn btn--outline btn--sm" style="flex:1;margin:0">Continue</button>
                    <a href="<?= base_url('cart') ?>" class="btn btn--black btn--sm" style="flex:1;margin:0">View Cart</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:360px">
            <div class="modal-content" style="border:none;border-radius:2px;padding:1.5rem">
                <div class="modal-header" style="border:none;padding:0 0 0.75rem">
                    <h5 class="modal-title" style="font-size:0.9rem;font-weight:700">Sign in required</h5>
                    <button type="button" class="close" data-dismiss="modal" style="font-size:1.25rem;color:#999;border:none;background:none;cursor:pointer">&times;</button>
                </div>
                <div class="modal-body" style="padding:0 0 1.25rem">
                    <p style="font-size:0.82rem;color:var(--gray-500);margin:0;line-height:1.6">Please sign in to add items to your cart.</p>
                </div>
                <div class="modal-footer" style="border:none;padding:0;gap:0.5rem;display:flex">
                    <button type="button" data-dismiss="modal" class="btn btn--outline btn--sm" style="flex:1;margin:0">Cancel</button>
                    <a href="<?= base_url("login") ?>" class="btn btn--black btn--sm" style="flex:1;margin:0">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <?php else : ?>
        <script>window.location.href = '<?= base_url('cart') ?>';</script>
    <?php endif; ?>
</div>

<script>
document.getElementById('addToCartForm').addEventListener('submit', function(event) {
    event.preventDefault();

    <?php if (!$this->session->userdata('id')) : ?>
        $('#loginModal').modal('show');
    <?php else : ?>
        $.ajax({
            type: 'GET',
            url: '<?= base_url("cart/isProductInCart/") ?>' + <?= $content->id ?>,
            success: function(response) {
                var result = JSON.parse(response);
                if (result.isProductInCart) {
                    $('#cartModal').modal('show');
                } else {
                    document.getElementById('addToCartForm').submit();
                }
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    <?php endif; ?>
});
</script>
