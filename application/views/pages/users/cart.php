<div style="padding:3rem 2rem;max-width:var(--max-width);margin:0 auto">
    <div class="flex justify-between items-center" style="margin-bottom:2.5rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h1 style="font-size:1.35rem;font-weight:700;letter-spacing:-0.02em;margin:0">Shopping Cart</h1>
            <p style="color:var(--gray-400);font-size:0.82rem;margin:0.25rem 0 0"><?= count($content) ?> item<?= count($content) !== 1 ? 's' : '' ?></p>
        </div>
        <a href="<?= base_url('shop') ?>" class="btn btn--link" style="font-size:0.72rem">
            <i class="fas fa-arrow-left" style="font-size:0.6rem"></i>
            Continue Shopping
        </a>
    </div>

    <?php if (empty($content)) : ?>
    <div class="empty-state" style="border:1px solid var(--gray-100)">
        <div class="empty-state__icon"><i class="fas fa-shopping-bag"></i></div>
        <div class="empty-state__title">Your cart is empty</div>
        <div class="empty-state__desc">Looks like you haven't added anything yet.</div>
        <a href="<?= base_url('shop') ?>" class="btn btn--black btn--sm">Browse Shop</a>
    </div>
    <?php else : ?>

    <?php
    $subTotal = array_sum(array_column($content, 'sub_total'));
    $discount = calculateDiscount($subTotal);
    $itemCount = count($content);
    ?>

    <div class="cart-layout">
        <div>
            <?php $i = 0; foreach ($content as $row) : $i++; ?>
            <div class="cart-item" style="<?= $i === 1 ? 'padding-top:0' : '' ?>">
                <div class="cart-item__image" style="width:100px;height:120px">
                    <img src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($row->title) ?>">
                </div>
                <div class="cart-item__info">
                    <div class="cart-item__title" style="font-size:0.9rem"><?= e($row->title) ?></div>
                    <div style="display:flex;gap:0.75rem;margin-top:0.3rem;flex-wrap:wrap">
                        <span style="font-size:0.72rem;color:var(--gray-400)">Qty: <strong style="color:var(--charcoal)"><?= e($row->quantity) ?></strong></span>
                        <?php if (isset($row->size) && $row->size) : ?>
                        <span style="font-size:0.72rem;color:var(--gray-400)">Size: <strong style="color:var(--charcoal)"><?= e($row->size) ?></strong></span>
                        <?php endif ?>
                    </div>
                    <div style="margin-top:0.5rem">
                        <span style="font-size:0.8rem;color:var(--gray-500)">Rp <?= formatRupiah($row->price) ?> each</span>
                    </div>
                </div>
                <div style="text-align:right;flex-shrink:0">
                    <div class="cart-item__price" style="font-size:0.95rem;font-weight:600">Rp <?= formatRupiah($row->sub_total) ?></div>
                    <form action="<?= base_url("cart/delete/$row->id") ?>" method="POST" style="margin-top:0.5rem">
                        <input type="hidden" name="id" value="<?= e($row->id) ?>">
                        <button class="cart-item__remove" type="submit" onclick="return confirm('Remove this item?')" style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.05em;font-weight:500">
                            <i class="fas fa-trash-alt" style="font-size:0.65rem;margin-right:0.3rem"></i>
                            Remove
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach ?>
        </div>

        <div>
            <div class="cart-summary">
                <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:1.25rem">Order Summary</div>

                <div class="flex justify-between mb-3" style="padding-bottom:0.75rem;border-bottom:1px solid var(--gray-100)">
                    <span style="font-size:0.85rem;color:var(--gray-500)">Subtotal (<?= $itemCount ?> item<?= $itemCount !== 1 ? 's' : '' ?>)</span>
                    <span style="font-size:0.85rem;font-weight:500">Rp <?= formatRupiah($subTotal) ?></span>
                </div>

                <?php if ($discount['percentage'] > 0) :
                    $reason = $discount['percentage'] >= 20 ? 'Belanja di atas Rp500.000' : 'Belanja di atas Rp200.000';
                ?>
                <div style="background:#f0faf0;padding:0.75rem 0;margin-bottom:0.75rem">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span style="display:inline-flex;align-items:center;justify-content:center;width:22px;height:22px;border-radius:50%;background:#28a745;color:#fff;font-size:0.6rem"><i class="fas fa-tag"></i></span>
                            <span style="font-size:0.82rem;font-weight:600;color:#1e7e34">Discount</span>
                            <span style="font-size:0.65rem;font-weight:700;background:#28a745;color:#fff;padding:0.1rem 0.45rem;border-radius:2px;letter-spacing:0.03em">-<?= e($discount['percentage']) ?>%</span>
                        </div>
                        <span style="font-size:0.88rem;font-weight:700;color:#1e7e34">-Rp <?= formatRupiah($discount['amount']) ?></span>
                    </div>
                    <div style="font-size:0.65rem;color:#6c757d;margin-top:0.4rem;padding-top:0.4rem">
                        <i class="fas fa-info-circle" style="font-size:0.55rem;margin-right:0.25rem"></i>
                        <?= e($reason) ?>
                    </div>
                </div>
                <?php endif ?>

                <div class="flex justify-between mb-6">
                    <span style="font-size:1.05rem;font-weight:700">Total</span>
                    <span style="font-size:1.05rem;font-weight:700">Rp <?= formatRupiah($discount['total']) ?></span>
                </div>

                <div class="flex flex-col gap-2">
                    <a href="<?= base_url('checkout') ?>" class="btn btn--black w-full" style="height:50px">
                        Proceed to Checkout
                        <i class="fas fa-arrow-right" style="font-size:0.7rem"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>

<style>
.cart-item:last-child {
    border-bottom: none;
}
</style>
