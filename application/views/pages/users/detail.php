<div style="max-width:1280px;margin:0 auto;padding:2.5rem 2rem">
    <?php if ($content) : ?>

    <nav style="display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:#aaa;margin-bottom:2.5rem;letter-spacing:.02em">
        <a href="<?= base_url() ?>" style="color:#aaa;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#1a1a1a'" onmouseout="this.style.color='#aaa'">Home</a>
        <span style="color:#ddd">/</span>
        <a href="<?= base_url('shop') ?>" style="color:#aaa;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#1a1a1a'" onmouseout="this.style.color='#aaa'">Shop</a>
        <span style="color:#ddd">/</span>
        <span style="color:#555;font-weight:500"><?= e($content->product_title) ?></span>
    </nav>

    <div class="shop-detail-grid" style="display:grid;grid-template-columns:1.15fr .85fr;gap:4rem;align-items:start">

        <!-- Left: Image -->
        <div style="position:sticky;top:6rem">
            <div style="background:#f4f4f4;border-radius:16px;overflow:hidden;position:relative">
                <img src="<?= $content->image ? base_url("images/product/$content->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($content->product_title) ?>" style="width:100%;height:auto;display:block;transition:transform .8s cubic-bezier(.25,.46,.45,.94);will-change:transform"
                     onmouseover="this.style.transform='scale(1.045)'" onmouseout="this.style.transform='scale(1)'">
            </div>
        </div>

        <!-- Right: Info -->
        <div style="padding-top:.25rem">
            <div style="font-size:.7rem;font-weight:500;color:#b0b0b0;letter-spacing:.12em;margin-bottom:.75rem;text-transform:uppercase"><?= e($content->category_title) ?></div>
            <h1 style="font-size:1.75rem;font-weight:650;color:#1a1a1a;margin:0;letter-spacing:-.02em;line-height:1.2"><?= e($content->product_title) ?></h1>

            <div style="margin-top:1.25rem;font-size:1.35rem;font-weight:550;color:#1a1a1a;letter-spacing:-.01em">Rp <?= formatRupiah($content->price) ?></div>

            <div style="margin-top:.75rem">
                <?php if ($content->is_available == 1) : ?>
                    <span style="font-size:.72rem;font-weight:500;color:#8a8a8a">In stock</span>
                <?php else : ?>
                    <span style="font-size:.72rem;font-weight:500;color:#c0c0c0">Currently unavailable</span>
                <?php endif ?>
            </div>

            <div style="height:1px;background:#eaeaea;margin:1.75rem 0"></div>

            <!-- Details inline -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem 2rem">
                <div>
                    <div style="font-size:.68rem;font-weight:500;color:#b0b0b0;margin-bottom:.25rem">Size</div>
                    <div style="font-size:.9rem;font-weight:500;color:#1a1a1a"><?= e($content->size) ?></div>
                </div>
                <div>
                    <div style="font-size:.68rem;font-weight:500;color:#b0b0b0;margin-bottom:.25rem">Color</div>
                    <div style="font-size:.9rem;font-weight:500;color:#1a1a1a"><?= e($content->color) ?></div>
                </div>
                <div>
                    <div style="font-size:.68rem;font-weight:500;color:#b0b0b0;margin-bottom:.25rem">Category</div>
                    <div style="font-size:.9rem;font-weight:500;color:#1a1a1a"><?= e($content->category_title) ?></div>
                </div>
                <div>
                    <div style="font-size:.68rem;font-weight:500;color:#b0b0b0;margin-bottom:.25rem">Quantity</div>
                    <div style="font-size:.9rem;font-weight:500;color:#1a1a1a"><?= $content->is_available == 1 ? '1' : '0' ?> available</div>
                </div>
            </div>

            <div style="height:1px;background:#eaeaea;margin:1.75rem 0"></div>

            <!-- Description -->
            <div>
                <div style="font-size:.68rem;font-weight:500;color:#b0b0b0;letter-spacing:.08em;text-transform:uppercase;margin-bottom:.65rem">Description</div>
                <p style="font-size:.85rem;color:#666;line-height:1.8;margin:0;max-width:45ch"><?= e($content->description) ?></p>
            </div>

            <div style="height:1px;background:#eaeaea;margin:1.75rem 0"></div>

            <!-- CTA -->
            <form action="<?= base_url('cart/add') ?>" method="POST" id="addToCartForm">
                <input type="hidden" name="id_product" value="<?= e($content->id) ?>">
                <input type="hidden" name="quantity" value="<?= $content->is_available == 1 ? '1' : '0' ?>">

                <?php if ($content->is_available == 1) : ?>
                    <button type="submit" style="width:100%;height:50px;border:none;border-radius:10px;background:#1a1a1a;color:#fff;font-size:.82rem;font-weight:550;letter-spacing:.02em;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center"
                            onmouseover="this.style.background='#333'" onmouseout="this.style.background='#1a1a1a'">
                        Add to Cart
                    </button>
                <?php else : ?>
                    <button type="button" style="width:100%;height:50px;border:1px solid #eaeaea;background:transparent;color:#c0c0c0;font-size:.82rem;font-weight:500;cursor:not-allowed;display:flex;align-items:center;justify-content:center" disabled>
                        Unavailable
                    </button>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:360px">
            <div class="modal-content" style="border:none;border-radius:16px;box-shadow:0 24px 64px rgba(0,0,0,.12);padding:1.5rem">
                <div class="modal-header" style="border:none;padding:0 0 .75rem">
                    <h5 class="modal-title" style="font-size:.95rem;font-weight:600;color:#1a1a1a">Already in cart</h5>
                    <button type="button" class="close" data-dismiss="modal" style="font-size:1.25rem;color:#999;border:none;background:none;cursor:pointer">&times;</button>
                </div>
                <div class="modal-body" style="padding:0 0 1.25rem">
                    <p style="font-size:.82rem;color:#888;margin:0;line-height:1.6">This item is already in your shopping cart.</p>
                </div>
                <div class="modal-footer" style="border:none;padding:0;gap:.5rem;display:flex">
                    <button type="button" data-dismiss="modal" style="flex:1;height:42px;border:1px solid #eaeaea;border-radius:8px;background:transparent;color:#1a1a1a;font-size:.78rem;font-weight:500;cursor:pointer;transition:background .2s" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='transparent'">Continue</button>
                    <a href="<?= base_url('cart') ?>" style="flex:1;height:42px;border:none;border-radius:8px;background:#1a1a1a;color:#fff;font-size:.78rem;font-weight:500;text-decoration:none;display:flex;align-items:center;justify-content:center;transition:background .2s" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#1a1a1a'">View Cart</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:360px">
            <div class="modal-content" style="border:none;border-radius:16px;box-shadow:0 24px 64px rgba(0,0,0,.12);padding:1.5rem">
                <div class="modal-header" style="border:none;padding:0 0 .75rem">
                    <h5 class="modal-title" style="font-size:.95rem;font-weight:600;color:#1a1a1a">Sign in required</h5>
                    <button type="button" class="close" data-dismiss="modal" style="font-size:1.25rem;color:#999;border:none;background:none;cursor:pointer">&times;</button>
                </div>
                <div class="modal-body" style="padding:0 0 1.25rem">
                    <p style="font-size:.82rem;color:#888;margin:0;line-height:1.6">Please sign in to add items to your cart.</p>
                </div>
                <div class="modal-footer" style="border:none;padding:0;gap:.5rem;display:flex">
                    <button type="button" data-dismiss="modal" style="flex:1;height:42px;border:1px solid #eaeaea;border-radius:8px;background:transparent;color:#1a1a1a;font-size:.78rem;font-weight:500;cursor:pointer;transition:background .2s" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='transparent'">Cancel</button>
                    <a href="<?= base_url("login") ?>" style="flex:1;height:42px;border:none;border-radius:8px;background:#1a1a1a;color:#fff;font-size:.78rem;font-weight:500;text-decoration:none;display:flex;align-items:center;justify-content:center;transition:background .2s" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#1a1a1a'">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <?php else : ?>
        <script>window.location.href = '<?= base_url('cart') ?>';</script>
    <?php endif; ?>
</div>

<style>
@keyframes fadeIn { from { opacity:0; transform:translateY(8px) } to { opacity:1; transform:translateY(0) } }
.shop-detail-grid { animation:fadeIn .5s ease-out }
.shop-detail-grid > div:first-child img { aspect-ratio:1/1;object-fit:cover }
@media (max-width: 768px) {
    .shop-detail-grid { grid-template-columns:1fr !important; gap:1.5rem !important }
    .shop-detail-grid > div:first-child { position:static !important }
    .shop-detail-grid > div:first-child img { aspect-ratio:1/1;object-fit:cover }
    .shop-detail-grid > div:last-child { padding-top:0 !important }
    .shop-detail-grid > div:last-child h1 { font-size:1.35rem !important }
}
</style>

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
