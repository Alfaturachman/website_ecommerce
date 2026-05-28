<div style="padding:3rem 2rem;max-width:var(--max-width);margin:0 auto">
    <div class="profile-layout">
        <aside class="profile-sidebar">
            <?php $this->load->view('layouts/user/_sidebar') ?>
        </aside>

        <div>
            <h1 style="font-size:1.25rem;font-weight:700;letter-spacing:-0.02em;margin-bottom:1.5rem">Confirm Payment</h1>

            <div style="border:1px solid var(--gray-100);padding:1.5rem">
                <div class="flex justify-between items-center mb-4">
                    <span style="font-size:0.9rem;font-weight:600">Order #<?= e($order->invoice) ?></span>
                    <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
                </div>

                <form action="<?= $form_action ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_orders" value="<?= e($order->id) ?>">

                    <div class="form-group">
                        <label class="form-label">Invoice Number</label>
                        <input type="text" class="form-input" value="<?= e($order->invoice) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Account Name</label>
                        <input type="text" name="account_name" value="<?= e($input->account_name) ?>" class="form-input" placeholder="Enter account name">
                        <?= form_error('account_name') ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input type="text" value="Rp <?= formatRupiah($order->total) ?>" class="form-input" readonly>
                        <input type="hidden" name="nominal" value="<?= e($order->total) ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Note</label>
                        <textarea name="note" cols="30" rows="3" class="form-textarea">-</textarea>
                    </div>

                    <div class="form-group">
                        <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:1rem">Transfer to:</div>
                        <div class="bank-list">
                            <div class="bank-list__item">
                                <img src="<?= base_url("assets/img/logo_bca.png") ?>" alt="BCA">
                                <span><strong>Bank Central Asia (BCA) 5139742685</strong> a/n NOMADENSTUFF</span>
                            </div>
                            <div class="bank-list__item">
                                <img src="<?= base_url("assets/img/logo_bri.png") ?>" alt="BRI">
                                <span><strong>Bank Rakyat Indonesia (BRI) 196214652186437</strong> a/n NOMADENSTUFF</span>
                            </div>
                            <div class="bank-list__item">
                                <img src="<?= base_url("assets/img/logo_bni.png") ?>" alt="BNI">
                                <span><strong>Bank Negara Indonesia (BNI) 7982562143</strong> a/n NOMADENSTUFF</span>
                            </div>
                            <div class="bank-list__item">
                                <img src="<?= base_url("assets/img/logo_bsi.png") ?>" alt="BSI">
                                <span><strong>Bank Syariah Indonesia (BSI) 652146347895214</strong> a/n NOMADENSTUFF</span>
                            </div>
                            <div class="bank-list__item">
                                <img src="<?= base_url("assets/img/logo_mandiri.png") ?>" alt="Mandiri">
                                <span><strong>Bank Mandiri 456321789532164</strong> a/n NOMADENSTUFF</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Transfer Proof</label>
                        <p style="font-size:0.72rem;color:var(--gray-400);margin-bottom:0.5rem">File must be JPG, JPEG, or PNG</p>
                        <input type="file" name="image" id="imageInput" style="font-size:0.85rem">
                        <?php if ($this->session->flashdata('image_error')) : ?>
                        <small class="form-error"><?= e($this->session->flashdata('image_error')) ?></small>
                        <?php endif ?>
                        <img class="mt-2" src="#" alt="Preview" id="imagePreview" style="max-width:50%;display:none;border:1px solid var(--gray-100)">
                    </div>

                    <button type="submit" class="btn btn--black w-full mt-4" style="height:48px">
                        Confirm Payment
                        <i class="fas fa-arrow-right" style="font-size:0.65rem"></i>
                    </button>
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
