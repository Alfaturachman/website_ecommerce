<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <p class="h5 mb-3"><strong>Ringkasan Keranjang Belanja</strong></p>
                    <div class="card p-3">
                        <div class="site-blocks-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $row) : ?>
                                        <tr>
                                            <td style="white-space: nowrap; width: 1%;"><?= e($row->title) ?>
                                                <br>
                                                <img src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($row->title) ?>" height="100" class="img-responsive">
                                            </td>
                                            <td><?= e($row->quantity) ?></td>
                                            <td>Rp<?= formatRupiah($row->price) ?></td>
                                            <td>Rp<?= formatRupiah($row->sub_total) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <?php
                                    $subtotal = array_sum(array_column($cart, 'sub_total'));
                                    $discount = calculateDiscount($subtotal);
                                    ?>
                                    <tr>
                                        <td colspan="3"><strong>Subtotal</strong></td>
                                        <td>
                                            <strong>Rp<?= formatRupiah($subtotal) ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>Diskon (<?= e($discount['percentage']) ?>%)</strong></td>
                                        <td>
                                            <strong>Rp<?= formatRupiah($discount['amount']) ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>Ongkos Kirim</strong></td>
                                        <td>
                                            <strong>
                                                <span id="shippingCost"></span>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><strong>Total Belanja</strong></td>
                                        <td>
                                            <strong>
                                                <span id="totalBelanja">Rp<?= formatRupiah($discount['total']) ?></span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <p class="h5 mb-3"><strong>Formulir Alamat Pengiriman</strong></p>
                    <div class="card p-3">
                        <form action="<?= base_url('checkout/create') ?>" method="POST">
                            <div class="form-group">
                                <label for=""><strong>Nama</strong></label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Penerima" value="<?= e(isset($input->name) ? $input->name : $userData->name) ?>">
                                <?= form_error('name') ?>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Telepon</strong></label>
                                <input type="text" class="form-control" name="phone" placeholder="Masukkan Nomor Telepon Penerima" value="<?= e(isset($input->phone) ? $input->phone : $userData->phone) ?>">
                                <?= form_error('phone') ?>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Alamat</strong></label>
                                <input type="text" name="address" class="form-control" placeholder="Contoh: Jl. Jendral Soedirman No.32" value="<?= e(isset($input->address) ? $input->address : $userData->address) ?>">
                                <?= form_error('address') ?>
                            </div>
                            <?php $data_provinsi = getRajaOngkirProvinces(); ?>
                            <div class="form-group">
                                <label><strong>Provinsi</strong></label>
                                <select id='provinsi' name='provinsi' class="custom-select d-block w-100 form-control">
                                    <option value="" selected disabled>- Pilih Provinsi Tujuan -</option>
                                    <?php for ($i = 0; $i < count($data_provinsi['rajaongkir']['results']); $i++) : ?>
                                        <option value="<?= e($data_provinsi['rajaongkir']['results'][$i]['province_id']) ?>">
                                            <?= e($data_provinsi['rajaongkir']['results'][$i]['province']) ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                                <?= form_error('provinsi') ?>
                            </div>
                            <div class="form-group">
                                <label><strong>Kabupaten / Kota</strong></label>
                                <select id="kabupaten" name="kabupaten" class="custom-select d-block w-100 form-control">
                                    <option value="">- Pilih Kabupaten / Kota -</option>
                                </select>
                                <?= form_error('kabupaten') ?>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Jasa Pengiriman</strong></label>
                                <select name="courier" id="courier" class="form-control">
                                    <option value="">- Pilih Jasa Pengiriman -</option>
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
                            <button class="btn btn-success btn-block mt-4" type="submit"><i class="fas fa-credit-card"></i>
                                <strong> Lanjut Pembayaran</strong></button>
                        </form>
                    </div>
                </div>
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
                var discountAmount = parseFloat($('#discountAmount').val()) || 0;

                $('#shippingCost').text('Rp' + number_format(ongkirResults, 0, ',', '.'));
                $('#shippingCostInput').val(ongkirResults);

                var totalBelanja = discountTotal + ongkirResults;
                $('#totalBelanja').text('Rp' + number_format(totalBelanja, 0, ',', '.'));
                $('#totalBelanjaInput').val(totalBelanja);
            },
            error: function(xhr, status, error) {
                console.error('Error updating shipping rates:', error);
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