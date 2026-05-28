<div style="padding:3rem 2rem;max-width:var(--max-width);margin:0 auto;min-height:60vh">
    <div class="profile-layout">
        <aside class="profile-sidebar">
            <?php $this->load->view('layouts/user/_sidebar') ?>
        </aside>

        <div>
            <div class="flex items-center justify-between" style="margin-bottom:1.25rem">
                <h1 style="font-size:1.25rem;font-weight:700;letter-spacing:-0.02em">Order History</h1>
            </div>

            <div class="order-filters">
                <a href="<?= base_url('myorder') ?>" class="order-filter <?= !$status || $status === 'all' ? 'active' : '' ?>">All</a>
                <a href="<?= base_url('myorder/index/waiting') ?>" class="order-filter <?= $status === 'waiting' ? 'active' : '' ?>">Waiting</a>
                <a href="<?= base_url('myorder/index/process') ?>" class="order-filter <?= $status === 'process' ? 'active' : '' ?>">Process</a>
                <a href="<?= base_url('myorder/index/delivered') ?>" class="order-filter <?= $status === 'delivered' ? 'active' : '' ?>">Delivered</a>
                <a href="<?= base_url('myorder/index/done') ?>" class="order-filter <?= $status === 'done' ? 'active' : '' ?>">Completed</a>
                <a href="<?= base_url('myorder/index/cancel') ?>" class="order-filter <?= $status === 'cancel' ? 'active' : '' ?>">Cancelled</a>
            </div>

            <?php if (empty($content)) : ?>
            <div class="empty-state" style="border:1px solid var(--gray-100)">
                <div class="empty-state__icon"><i class="fas fa-box-open"></i></div>
                <div class="empty-state__title">No orders yet</div>
                <div class="empty-state__desc">Start shopping to see your orders here.</div>
                <a href="<?= base_url('shop') ?>" class="btn btn--black btn--sm">Browse Shop</a>
            </div>
            <?php else : ?>
            <div class="order-cards">
                <?php foreach ($content as $row) : ?>
                <a href="<?= base_url("myorder/detail/$row->invoice") ?>" class="order-card">
                    <div class="order-card__header">
                        <span class="order-card__invoice">Invoice #<?= e($row->invoice) ?></span>
                        <span class="order-card__date"><?= date('d M Y', strtotime($row->date)) ?></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="order-card__thumb">
                            <img src="<?= $row->product_image ? base_url("images/product/$row->product_image") : base_url("images/product/default.jpg") ?>" alt="<?= e($row->product_title) ?>">
                        </div>
                        <div class="flex justify-between items-center" style="flex:1;flex-wrap:wrap;gap:0.5rem">
                            <div>
                                <div class="order-card__product-title"><?= e($row->product_title) ?></div>
                                <span class="order-card__total">Total: Rp <?= formatRupiah($row->total) ?></span>
                            </div>
                            <div style="text-align:right">
                                <div class="order-card__items"><?= $row->total_items ?> item<?= $row->total_items > 1 ? 's' : '' ?></div>
                                <div style="margin-top:0.5rem"></div>
                                <div class="flex items-center" style="gap:1rem;flex-wrap:wrap;justify-content:flex-end">
                                    <?php $this->load->view('layouts/_status', ['status' => $row->status]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>

<style>
.order-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
    margin-bottom: 1.25rem;
}

.order-filter {
    display: inline-block;
    padding: 0.4rem 0.85rem;
    font-size: 0.78rem;
    font-weight: 500;
    border-radius: 999px;
    text-decoration: none !important;
    color: var(--gray-500);
    background: var(--gray-50);
    transition: background 0.2s ease, color 0.2s ease;
}

.order-filter:hover {
    background: var(--gray-200);
    color: var(--gray-700);
}

.order-filter.active {
    background: #111;
    color: #fff;
}

.order-cards {
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
}

.order-card {
    display: block;
    padding: 1rem 1.25rem;
    text-decoration: none !important;
    color: inherit;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: box-shadow 0.2s ease, transform 0.2s ease;
}

.order-card:hover {
    background: #fff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.07);
    transform: translateY(-2px);
}

.order-card__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.65rem;
}

.order-card__invoice {
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: -0.01em;
}

.order-card__date {
    font-size: 0.72rem;
    color: var(--gray-400);
}

.order-card__product-title {
    font-size: 0.8rem;
    color: var(--gray-500);
    margin-bottom: 0.15rem;
    line-height: 1.3;
}

.order-card__total {
    font-weight: 600;
    font-size: 0.9rem;
}

.order-card__thumb {
    width: 52px;
    height: 52px;
    border-radius: 6px;
    overflow: hidden;
    flex-shrink: 0;
    background: var(--gray-50);
    aspect-ratio: 1 / 1;
}

.order-card__thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.order-card__items {
    font-size: 0.72rem;
    font-weight: 500;
    color: var(--gray-400);
    white-space: nowrap;
}

.order-card__arrow {
    font-size: 0.65rem;
    color: var(--gray-400);
}
</style>
