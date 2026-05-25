<div class="container my-5">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <?php $this->load->view('layouts/user/_sidebar') ?>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between">
                    <p class="m-0 p-0 h5"><strong class="font-weight-bold">Detail Order </strong></p>
                    <?php $this->load->view('layouts/_status', ['status' => $order->status]); ?>
                </div>
                <div class="card-body">
                    <?php if ($order->status == 'waiting') : ?>
                        <p class="alert alert-warning text-center">
                            <strong>Waktu Checkout Tersisa:
                                <br>
                                <span class="h4" id="countdown"></span>
                            </strong>
                        </p>
                    <?php endif ?>
                    <p>Nomor Invoice : #<?= e($order->invoice) ?></p>
                    <p>Tanggal : <?= date('d/m/Y', strtotime($order->date)) ?></p>
                    <p>Nama : <?= e($order->name) ?></p>
                    <p>Telepon : <?= e($order->phone) ?></p>
                    <p>Alamat : <?= e($order->address) ?>, <?= e($order->city) ?>, <?= e($order->province) ?></p>
                    <p>Jasa Pengiriman : <?= e($order->courier) ?></p>
                    <?php if ($order->waybill != "") : ?>
                        <p>No. Resi : <?= e($order->waybill) ?></p>
                    <?php endif ?>
                    <?php foreach ($order_detail as $row) : ?>
                        <div class="card-group">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.jpg") ?>" alt="<?= e($row->title) ?>" class="img-responsive mb-2" height="150">
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="card-title"><strong><?= e($row->title) ?></strong></h5>
                                            <p class="card-text"><strong>Harga:</strong> Rp <?= formatRupiah($row->price) ?></p>
                                            <p class="card-text"><strong>Jumlah:</strong> <?= e($row->quantity) ?></p>
                                            <p class="card-text"><strong>Subtotal:</strong> Rp <?= formatRupiah($row->sub_total) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="table-responsive">
                        <table class="table">
                            <tfoot style="background-color: rgba(221, 221, 221, 0.25);">
                                <tr>
                                    <td colspan="4" class="border-top border-bottom"><strong>Total Belanja</strong></td>
                                    <td class="border-top border-bottom text-right"><strong>Rp <?= formatRupiah(array_sum(array_column($order_detail, 'sub_total'))) ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="border-top border-bottom">Diskon <?= e($order->diskon_persen) ?>%</td>
                                    <td class="border-top border-bottom text-right">Rp <?= formatRupiah($order->diskon) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="border-top border-bottom">Ongkos Kirim</td>
                                    <td class="border-top border-bottom text-right">Rp <?= formatRupiah($order->cost_courier) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="border-top border-bottom"><strong>Total Bayar</strong></td>
                                    <td class="border-top border-bottom text-right"><strong>Rp <?= formatRupiah($order->total) ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php if ($order->status == 'waiting') : ?>
                        <div class="mt-3">
                            <button class="btn btn-danger btn-block mb-2" data-toggle="modal" data-target="#cancelOrderModal">
                                <strong><i class="fas fa-times"></i> Batalkan Pesanan</strong>
                            </button>
                            <a href="<?= base_url("/myorder/confirm/$order->invoice") ?>" class="btn btn-success btn-block"><i class="fas fa-credit-card"></i>
                                <strong>Lanjutkan Pembayaran</strong>
                            </a>
                        </div>
                    <?php endif ?>

                    <div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cancelOrderModalLabel">Konfirmasi Pembatalan Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin membatalkan pesanan?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                    <a href="<?= base_url("/myorder/cancel/$order->invoice") ?>" class="btn btn-danger" onclick="cancelOrderAndResetTimer()">Ya, Batalkan Pesanan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($order_confirm)) : ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>Bukti Transfer</strong>
                    </div>
                    <div class="card-body">
                        <p>No Rekening : <?= e($order_confirm->account_number) ?></p>
                        <p>Atas Nama : <?= e($order_confirm->account_name) ?></p>
                        <p>Nominal : Rp <?= formatRupiah($order_confirm->nominal) ?></p>
                        <p>Note : <?= e($order_confirm->note) ?></p>
                        <div class="mt-3">
                            <img src="<?= base_url("/images/confirm/$order_confirm->image") ?>" alt="" height="200" class="img-responsive">
                        </div>
                    </div>
                </div>
            <?php endif ?>
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
                alert("Waktu checkout telah habis. Pesanan telah dibatalkan!");
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