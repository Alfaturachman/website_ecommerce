<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <strong>Checkout Berhasil</strong>
                </div>
                <div class="card-body">
                    <div class="my-5 text-center mb-3">
                        <i class="text-success fas fa-check-circle fa-10x"></i>
                    </div>
                    <div class="text-center">
                        <h6 class="mb-3">Nomor Invoice : <?= e($content->invoice) ?></h6>
                        <h4 class="mb-3"><strong>Total Pembayaran :
                                Rp<?= formatRupiah($content->total) ?></strong>
                        </h4>
                    </div>
                    <p class="alert alert-success text-center font-weight-bold">
                        Terima kasih! Pesanan Anda akan segera diproses.
                    </p>
                    <p style="text-align: justify;"><strong>Silahkan melakukan pembayaran sesuai total bayar di atas dan
                            transfer pada salah satu rekening di bawah ini.</strong></p>

                    <div class="bank-list my-4">
                        <div>
                            <img src="<?= base_url("assets/img/logo_bca.png") ?>" alt="BCA" class="img-fluid" width="75px" />
                            <strong>Bank Central Asia (BCA) 5139742685</strong> a/n NOMADENSTUFF
                        </div>
                        <div>
                            <img src="<?= base_url("assets/img/logo_bri.png") ?>" alt="BRI" class="img-fluid" width="75px" />
                            <strong>Bank Rakyat Indonesia (BRI) 196214652186437</strong> a/n NOMADENSTUFF
                        </div>
                        <div>
                            <img src="<?= base_url("assets/img/logo_bni.png") ?>" alt="BNI" class="img-fluid" width="75px" />
                            <strong>Bank Negara Indonesia (BNI) 7982562143</strong> a/n NOMADENSTUFF
                        </div>
                        <div>
                            <img src="<?= base_url("assets/img/logo_bsi.png") ?>" alt="BSI" class="img-fluid" width="75px" />
                            <strong>Bank Syariah Indonesia (BSI) 652146347895214</strong> a/n NOMADENSTUFF
                        </div>
                        <div>
                            <img src="<?= base_url("assets/img/logo_mandiri.png") ?>" alt="Mandiri" class="img-fluid" width="75px" />
                            <strong>Bank Mandiri 456321789532164</strong> a/n NOMADENSTUFF
                        </div>
                    </div>

                    <p><strong>Jika sudah mentransfer, silahkan lakukan konfirmasi pembayaran dibawah ini.</strong></p>

                    <a href="<?= base_url("/myorder/detail/$content->invoice") ?>"
                        class="btn btn-success btn-block font-weight-bold"><i class="fas fa-credit-card"></i> Konfirmasi
                        Pembayaran</a>
                    <a href="<?= base_url('/') ?>" class="btn btn-secondary btn-block font-weight-bold"><i
                            class="fas fa-arrow-left"></i> Kembali Ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>