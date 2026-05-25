<div class="full-height">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <?php $this->load->view('layouts/user/_sidebar') ?>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="card">
                    <div class="card-header py-3">
                        <strong class="h5 font-weight-bold">Daftar Riwayat Orders</strong>
                    </div>
                    <div class="card-body mt-2">
                        <div class="site-blocks-table table-responsive">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($content as $row) : ?>
                                        <tr>
                                            <td>
                                                <strong>#<?= e($row->invoice) ?></strong>
                                            </td>
                                            <td>
                                                <?= date('d-m-Y', strtotime($row->date)) ?>
                                            </td>
                                            <td>
                                                Rp <?= formatRupiah($row->total) ?>
                                            </td>
                                            <td>
                                                <?php $this->load->view('layouts/_status', ['status' => $row->status]) ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url("myorder/detail/$row->invoice") ?>" class="btn btn-sm btn-dark">Detail Order</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>