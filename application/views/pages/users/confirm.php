<div class="container my-5">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <?php $this->load->view('layouts/user/_sidebar') ?>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <p class="m-0 p-0"><strong>Konfirmasi Order </strong>#<?= e($order->invoice) ?></p>
                    <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
                </div>

                <form action="<?= $form_action ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_orders" value="<?= e($order->id) ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nomor Invoice</label>
                            <input type="text" class="form-control" value="<?= e($order->invoice) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Dari Rekening Atas Nama</label>
                            <input type="text" name="account_name" value="<?= e($input->account_name) ?>"
                                class="form-control" placeholder="Masukan Nama Rekening">
                            <?= form_error('account_name') ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nominal</label>
                            <input type="text" value="Rp <?= formatRupiah($order->total) ?>" class="form-control" readonly>
                            <input type="hidden" name="nominal" value="<?= e($order->total) ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Catatan</label>
                            <textarea name="note" cols="30" rows="3" class="form-control">-</textarea>
                        </div>
                        <div class="form-group">
                            <p>
                                Silahkan lakukan pembayaran sesuai total bayar di atas dan transfer pada salah satu
                                rekening dibawah ini :
                            </p>

                            <ul class="bank-list">
                                <li><img src="<?= base_url("assets/img/logo_bca.png") ?>" alt="BCA" class="img-fluid"
                                        width="75px" /><strong>Bank Central Asia (BCA) 5139742685</strong> a/n
                                    NOMADENSTUFF</li>
                                <li><img src="<?= base_url("assets/img/logo_bri.png") ?>" alt="BRI" class="img-fluid"
                                        width="75px" /><strong>Bank Rakyat Indonesia (BRI) 196214652186437</strong> a/n
                                    NOMADENSTUFF</li>
                                <li><img src="<?= base_url("assets/img/logo_bni.png") ?>" alt="BNI" class="img-fluid"
                                        width="75px" /><strong>Bank Negara Indonesia (BNI) 7982562143</strong> a/n
                                    NOMADENSTUFF</li>
                                <li><img src="<?= base_url("assets/img/logo_bsi.png") ?>" alt="BSI" class="img-fluid"
                                        width="75px" /><strong>Bank Syariah Indonesia (BSI) 652146347895214</strong>
                                    a/n NOMADENSTUFF</li>
                                <li><img src="<?= base_url("assets/img/logo_mandiri.png") ?>" alt="Mandiri"
                                        class="img-fluid" width="75px" /><strong>Bank Mandiri 456321789532164</strong>
                                    a/n NOMADENSTUFF</li>
                            </ul>

                            <label class="m-0 mt-4 p-0" for=""><strong>Bukti Transfer</strong></label>
                            <p>*file harus berbentuk JPG, JPEG, PNG</p>
                            <input type="file" name="image" id="imageInput">
                            <?php if ($this->session->flashdata('image_error')) : ?>
                            <small class="form-text text-danger"><?= e($this->session->flashdata('image_error')) ?></small>
                            <?php endif ?>
                            <img class="mt-3" src="#" alt="Preview" id="imagePreview"
                                style="max-width: 50%; display: none;">
                        </div>
                    </div>
                    <div class="m-3">
                        <button type="submit" class="btn btn-success btn-block"><strong>
                                <i class="fas fa-credit-card"></i> Konfirmasi Pembayaran</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('imageInput').addEventListener('change', function() {
    var preview = document.getElementById('imagePreview');
    if (this.files.length > 0) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    } else {
        preview.style.display = 'none';
    }
});
</script>