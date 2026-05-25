<div class="card shadow my-5">
    <div class="card-header d-flex justify-content-between">
        <strong>Detail Order </strong>&nbsp;#<?= $order->invoice ?>
        <span class="ml-auto"><?php $this->load->view('layouts/_status', ['status' => $order->status]); ?></span>
    </div>
    <div class="card-body">
        <!-- <?php $this->load->view('layouts/_alerts') ?> -->

        <p>Tanggal : <?= date('d/m/Y', strtotime($order->date)) ?></p>
        <p>Nama : <?= e($order->name) ?></p>
        <p>Telepon : <?= e($order->phone) ?></p>
        <p>Alamat : <?= e($order->address) ?>, <?= e($order->city) ?>, <?= e($order->province) ?></p>
        <p>Jasa Pengiriman : <?= e($order->courier) ?></p>
        <?php if ($order->waybill != "") : ?>
            <p>No. Resi : <?= e($order->waybill) ?></p>
        <?php endif ?>

        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Harga</th>
                        <th width="10%">Kuantitas</th>
                        <th width="30%">Pesan</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_detail as $row) : ?>
                        <tr>
                            <td>
                                <p>
                                    <?= e($row->title) ?><br>

                                    <img src="<?= $row->image ? base_url("images/product/$row->image") : base_url("images/product/default.jpg") ?>" alt="" height="100" class="img-responsive"> <br>
                                </p>
                            </td>
                            <td>Rp <?= number_format($row->price, 0, ',', '.') ?></td>
                            <td><?= e($row->quantity) ?></td>
                            <td><?= e($row->message) ?></td>
                            <td>Rp <?= formatRupiah($row->sub_total) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot style="background-color: #F6F6F6;">
                    <tr>
                        <td colspan="4">Total Belanja</td>
                        <td>Rp <?= formatRupiah(array_sum(array_column($order_detail, 'sub_total'))) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">Ongkos Kirim</td>
                        <td>Rp <?= formatRupiah($order->cost_courier) ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Total Bayar</strong></td>
                        <td><strong>Rp <?= formatRupiah($order->total + $order->cost_courier) ?></strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <form action="<?= base_url("admin/order/update/$order->id") ?>" method="POST">
            <div class="row">
                <?php if ($order->status == 'process') : ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">No. Resi Pengiriman</label>
                            <input type="text" name="waybill" class="form-control" value="<?= $order->waybill ?? '' ?>">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                            <option value="waiting" <?= $order->status == 'waiting' ? 'selected' : '' ?>>Menunggu
                                Pembayaran</option>
                            <option value="paid" <?= $order->status == 'paid' ? 'selected' : '' ?>>Dibayar</option>
                            <option value="process" <?= $order->status == 'process' ? 'selected' : '' ?>>Diproses
                            </option>
                            <option value="delivered" <?= $order->status == 'delivered' ? 'selected' : '' ?>>Dikirim
                            </option>
                            <option value="done" <?= $order->status == 'done' ? 'selected' : '' ?>>Selesai</option>
                            <option value="cancel" <?= $order->status == 'cancel' ? 'selected' : '' ?>>Batal</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-secondary px-5" href="<?= base_url('admin/order') ?>" role="button">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                    </a>
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn btn-primary px-5" type="submit">
                        <i class="fa fa-save" aria-hidden="true"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if (isset($order_confirm)) : ?>
    <div class="card shadow mb-3">
        <div class="card-header">
            Bukti Transfer
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