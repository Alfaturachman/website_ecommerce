<div style="padding:3rem 2rem;max-width:var(--max-width);margin:0 auto">
    <h1 style="font-size:1.35rem;font-weight:700;letter-spacing:-0.02em;margin-bottom:2rem">Checkout</h1>

    <div class="checkout-grid">
        <div>
            <div style="border:1px solid var(--gray-100);padding:1.5rem;margin-bottom:2rem">
                <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:1rem">Order Summary</div>

                <?php foreach ($cart as $row) : ?>
                <div class="cart-item" style="padding:0.75rem 0">
                    <div class="cart-item__image" style="width:60px;height:60px">
                        <img src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($row->title) ?>">
                    </div>
                    <div class="cart-item__info">
                        <div class="cart-item__title" style="font-size:0.82rem"><?= e($row->title) ?></div>
                        <div class="cart-item__meta">Qty: <?= e($row->quantity) ?></div>
                    </div>
                    <div class="cart-item__price">Rp <?= formatRupiah($row->sub_total) ?></div>
                </div>
                <?php endforeach ?>

                <?php
                $subtotal = array_sum(array_column($cart, 'sub_total'));
                $discount = calculateDiscount($subtotal);
                ?>
                <hr class="divider">
                <div class="flex justify-between mb-2">
                    <span style="font-size:0.82rem;color:var(--gray-500)">Subtotal</span>
                    <span style="font-size:0.82rem;font-weight:500">Rp <?= formatRupiah($subtotal) ?></span>
                </div>
                <?php if ($discount['percentage'] > 0) : ?>
                <div class="flex justify-between mb-2">
                    <span style="font-size:0.82rem;color:var(--gray-500)">Discount (<?= e($discount['percentage']) ?>%)</span>
                    <span style="font-size:0.82rem;font-weight:500;color:#555">-Rp <?= formatRupiah($discount['amount']) ?></span>
                </div>
                <?php endif ?>
                <div class="flex justify-between mb-2">
                    <span style="font-size:0.82rem;color:var(--gray-500)">Shipping</span>
                    <span style="font-size:0.82rem;font-weight:500" id="shippingCost">-</span>
                </div>
                <hr class="divider">
                <div class="flex justify-between">
                    <span style="font-size:1rem;font-weight:700">Total</span>
                    <span style="font-size:1rem;font-weight:700" id="totalBelanja">Rp <?= formatRupiah($discount['total']) ?></span>
                </div>
            </div>
        </div>

        <div>
            <div style="border:1px solid var(--gray-100);padding:1.5rem">
                <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:1rem">Shipping Address</div>

                <form action="<?= base_url('checkout/create') ?>" method="POST">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input" name="name" placeholder="Recipient name" value="<?= e(isset($input->name) ? $input->name : $userData->name) ?>">
                        <?= form_error('name') ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-input" name="phone" placeholder="Phone number" value="<?= e(isset($input->phone) ? $input->phone : $userData->phone) ?>">
                        <?= form_error('phone') ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-input" name="address" placeholder="Street address" value="<?= e(isset($input->address) ? $input->address : $userData->address) ?>">
                        <?= form_error('address') ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Province</label>
                        <select id='provinsi' name='provinsi' class="form-select">
                            <option value="" selected disabled>- Select Province -</option>
                            <?php if ($provinces && isset($provinces['rajaongkir']['results'])) : ?>
                            <?php for ($i = 0; $i < count($provinces['rajaongkir']['results']); $i++) : ?>
                                <option value="<?= e($provinces['rajaongkir']['results'][$i]['province_id']) ?>">
                                    <?= e($provinces['rajaongkir']['results'][$i]['province']) ?>
                                </option>
                            <?php endfor; ?>
                            <?php endif ?>
                        </select>
                        <?= form_error('provinsi') ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">City</label>
                        <select id="kabupaten" name="kabupaten" class="form-select">
                            <option value="">- Select City -</option>
                        </select>
                        <?= form_error('kabupaten') ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Courier</label>
                        <select name="courier" id="courier" class="form-select">
                            <option value="">- Select Courier -</option>
                            <option value="jne">JNE</option>
                            <option value="tiki">Tiki</option>
                            <option value="pos">POS Indonesia</option>
                        </select>
                        <?= form_error('courier') ?>
                    </div>

                    <input type="hidden" name="discountPercentage" id="discountPercentageInput" value="<?= e($discount['percentage']) ?>">
                    <input type="hidden" name="diskon" id="diskonInput" value="<?= e($discount['amount']) ?>">
                    <input type="hidden" name="shippingCost" id="shippingCostInput" required>
                    <input type="hidden" name="totalBelanja" id="totalBelanjaInput" required>
                    <input type="hidden" id="discountTotal" value="<?= e($discount['total']) ?>">
                    <input type="hidden" id="discountAmount" value="<?= e($discount['amount']) ?>">

                    <button type="submit" class="btn btn--black w-full mt-4" style="height:48px;font-size:0.78rem">
                        Place Order
                        <i class="fas fa-arrow-right" style="font-size:0.65rem"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on("change", "#kabupaten, select[name='courier']", function() {
    function updateShippingRates() {
        var kabupaten = $('#kabupaten').val();
        var courier = $('select[name="courier"]').val();

        $.ajax({
            type: 'GET',
            url: 'checkout/rajaongkir_cek_ongkir',
            data: {
                kabupaten: kabupaten,
                courier: courier,
            },
            dataType: 'json',
            success: function(data) {
                var ongkirResults = data.shipping_cost || 0;
                var discountTotal = parseFloat($('#discountTotal').val()) || 0;

                $('#shippingCost').text('Rp' + number_format(ongkirResults, 0, ',', '.'));
                $('#shippingCostInput').val(ongkirResults);

                var totalBelanja = discountTotal + ongkirResults;
                $('#totalBelanja').text('Rp' + number_format(totalBelanja, 0, ',', '.'));
                $('#totalBelanjaInput').val(totalBelanja);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    $('select[name="courier"]').change(updateShippingRates);
    updateShippingRates();
});

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
</script>
