<div style="padding:3rem 2rem;max-width:var(--max-width);margin:0 auto">
    <div class="profile-layout">
        <aside class="profile-sidebar">
            <?php $this->load->view('layouts/user/_sidebar') ?>
        </aside>

        <div>
            <div class="flex justify-between items-center mb-4">
                <h1 style="font-size:1.25rem;font-weight:700;letter-spacing:-0.02em">Order Detail</h1>
                <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
            </div>

            <?php if ($order->status == 'waiting') : ?>
            <div style="border:1px solid var(--gray-100);padding:1rem;margin-bottom:1.5rem;text-align:center">
                <p style="font-size:0.82rem;color:var(--gray-500);margin-bottom:0.25rem">Time remaining to complete payment:</p>
                <span style="font-size:1.5rem;font-weight:800;letter-spacing:0.05em" id="countdown"></span>
            </div>
            <?php endif ?>

            <div style="border:1px solid var(--gray-100);padding:1.5rem;margin-bottom:1.5rem">
                <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:1rem">Shipping Info</div>

                <div class="detail-info__attrs" style="grid-template-columns:1fr 1fr">
                    <div>
                        <div class="detail-info__attr-label">Invoice</div>
                        <div class="detail-info__attr-value">#<?= e($order->invoice) ?></div>
                    </div>
                    <div>
                        <div class="detail-info__attr-label">Date</div>
                        <div class="detail-info__attr-value"><?= date('d/m/Y', strtotime($order->date)) ?></div>
                    </div>
                    <div>
                        <div class="detail-info__attr-label">Name</div>
                        <div class="detail-info__attr-value"><?= e($order->name) ?></div>
                    </div>
                    <div>
                        <div class="detail-info__attr-label">Phone</div>
                        <div class="detail-info__attr-value"><?= e($order->phone) ?></div>
                    </div>
                    <div style="grid-column:1/-1">
                        <div class="detail-info__attr-label">Address</div>
                        <div class="detail-info__attr-value"><?= e($order->address) ?>, <?= e($order->city) ?>, <?= e($order->province) ?></div>
                    </div>
                    <div>
                        <div class="detail-info__attr-label">Courier</div>
                        <div class="detail-info__attr-value"><?= e($order->courier) ?></div>
                    </div>
                    <?php if ($order->waybill != "") : ?>
                    <div>
                        <div class="detail-info__attr-label">Waybill</div>
                        <div class="detail-info__attr-value"><?= e($order->waybill) ?></div>
                    </div>
                    <?php endif ?>
                </div>
            </div>

            <div style="border:1px solid var(--gray-100);padding:1.5rem;margin-bottom:1.5rem">
                <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:1rem">Items</div>

                <?php foreach ($order_detail as $row) : ?>
                <div class="cart-item">
                    <div class="cart-item__image" style="width:60px;height:60px">
                        <img src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($row->title) ?>">
                    </div>
                    <div class="cart-item__info">
                        <div class="cart-item__title" style="font-size:0.82rem"><?= e($row->title) ?></div>
                        <div class="cart-item__meta">Qty: <?= e($row->quantity) ?> &times; Rp <?= formatRupiah($row->price) ?></div>
                    </div>
                    <div class="cart-item__price">Rp <?= formatRupiah($row->sub_total) ?></div>
                </div>
                <?php endforeach ?>

                <hr class="divider">
                <div class="flex justify-between mb-2">
                    <span style="font-size:0.85rem;color:var(--gray-500)">Subtotal</span>
                    <span style="font-size:0.85rem;font-weight:500">Rp <?= formatRupiah(array_sum(array_column($order_detail, 'sub_total'))) ?></span>
                </div>
                <div class="flex justify-between mb-2">
                    <span style="font-size:0.85rem;color:var(--gray-500)">Discount (<?= e($order->diskon_persen) ?>%)</span>
                    <span style="font-size:0.85rem;color:#555">-Rp <?= formatRupiah($order->diskon) ?></span>
                </div>
                <div class="flex justify-between mb-2">
                    <span style="font-size:0.85rem;color:var(--gray-500)">Shipping</span>
                    <span style="font-size:0.85rem;font-weight:500">Rp <?= formatRupiah($order->cost_courier) ?></span>
                </div>
                <hr class="divider">
                <div class="flex justify-between">
                    <span style="font-size:1rem;font-weight:700">Total</span>
                    <span style="font-size:1rem;font-weight:700">Rp <?= formatRupiah($order->total) ?></span>
                </div>
            </div>

            <?php if (isset($order_confirm)) : ?>
            <div style="border:1px solid var(--gray-100);padding:1.5rem;margin-bottom:1.5rem">
                <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:1rem">Payment Confirmation</div>
                <div class="detail-info__attrs" style="grid-template-columns:1fr 1fr">
                    <div>
                        <div class="detail-info__attr-label">Account No.</div>
                        <div class="detail-info__attr-value"><?= e($order_confirm->account_number) ?></div>
                    </div>
                    <div>
                        <div class="detail-info__attr-label">Account Name</div>
                        <div class="detail-info__attr-value"><?= e($order_confirm->account_name) ?></div>
                    </div>
                    <div>
                        <div class="detail-info__attr-label">Amount</div>
                        <div class="detail-info__attr-value">Rp <?= formatRupiah($order_confirm->nominal) ?></div>
                    </div>
                    <div>
                        <div class="detail-info__attr-label">Note</div>
                        <div class="detail-info__attr-value"><?= e($order_confirm->note) ?></div>
                    </div>
                </div>
                <div class="mt-4">
                    <img src="<?= base_url("/images/confirm/$order_confirm->image") ?>" alt="Proof" style="max-width:300px;border:1px solid var(--gray-100)">
                </div>
            </div>
            <?php endif ?>

            <?php if ($order->status == 'waiting') : ?>
            <div class="flex gap-2">
                <button class="btn btn--outline w-full" data-toggle="modal" data-target="#cancelOrderModal">
                    <i class="fas fa-times" style="font-size:0.65rem"></i>
                    Cancel Order
                </button>
                <a href="<?= base_url("/myorder/confirm/$order->invoice") ?>" class="btn btn--black w-full">
                    Proceed to Payment
                    <i class="fas fa-arrow-right" style="font-size:0.65rem"></i>
                </a>
            </div>
            <?php endif ?>
        </div>
    </div>

    <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:380px">
            <div class="modal-content" style="border:none;border-radius:2px;padding:1.5rem">
                <div class="modal-header" style="border:none;padding:0 0 0.75rem">
                    <h5 class="modal-title" style="font-size:0.9rem;font-weight:700">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" style="font-size:1.25rem;color:#999">&times;</button>
                </div>
                <div class="modal-body" style="padding:0 0 1.25rem">
                    <p style="font-size:0.82rem;color:var(--gray-500);margin:0">Are you sure you want to cancel this order?</p>
                </div>
                <div class="modal-footer" style="border:none;padding:0;gap:0.5rem;display:flex">
                    <button type="button" class="btn btn--outline btn--sm" data-dismiss="modal" style="flex:1;margin:0">No</button>
                    <a href="<?= base_url("/myorder/cancel/$order->invoice") ?>" class="btn btn--black btn--sm" style="flex:1;margin:0" onclick="cancelOrderAndResetTimer()">Yes, Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let orderID = <?= $order->id ?>;
    let checkoutEndTime = localStorage.getItem(`checkout_end_time_${orderID}`) || 0;

    if (checkoutEndTime === 0 && '<?= $order->status ?>' === 'waiting') {
        checkoutEndTime = Math.floor(new Date().getTime() / 1000) + 7200;
        localStorage.setItem(`checkout_end_time_${orderID}`, checkoutEndTime);
    }

    if (checkoutEndTime > Math.floor(new Date().getTime() / 1000) && '<?= $order->status ?>' === 'waiting') {
        let intervalId = setInterval(function() {
            let currentTime = Math.floor(new Date().getTime() / 1000);
            let remainingTime = Math.max(checkoutEndTime - currentTime, 0);

            document.getElementById("countdown").innerHTML = formatTime(remainingTime);

            if (remainingTime <= 0) {
                alert("Payment time has expired. Order has been cancelled!");
                cancelOrder();
                clearInterval(intervalId);
                localStorage.removeItem(`checkout_end_time_${orderID}`);
            }
        }, 1000);
    } else {
        if ('<?= $order->status ?>' !== 'waiting') {
            let el = document.getElementById("countdown");
            if (el) el.style.display = "none";
        } else {
            cancelOrder();
        }
    }

    function formatTime(seconds) {
        let hours = Math.floor(seconds / 3600);
        let minutes = Math.floor((seconds % 3600) / 60);
        seconds %= 60;
        return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    function cancelOrder() {
        window.location.href = '<?= base_url("/myorder/cancel/$order->invoice") ?>';
        localStorage.removeItem(`checkout_end_time_${orderID}`);
    }

    window.cancelOrderAndResetTimer = function() {
        localStorage.removeItem(`checkout_end_time_${orderID}`);
        window.location.href = '<?= base_url("/myorder/cancel/$order->invoice") ?>';
    };
});
</script>
