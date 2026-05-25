<div class="card shadow my-3">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800"><strong>Order</strong></h1>
        </div>
        <!-- <span class="m-0 font-weight-bold text-primary">Order</span> -->
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col mb-4">
                <form action="<?= base_url('admin/order/search') ?>" method="POST" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="keyword" class="form-control form-control-sm text-center"
                            placeholder="Cari Nomor Invoice" value="<?= $this->session->userdata('keyword') ?>">
                        <div class="btn-group mx-sm-3" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-sm btn-secondary"><i
                                    class="fa fa-fw fa-search"></i></button>
                            <a href="<?= base_url('admin/order/reset') ?>" class="btn btn-sm btn-secondary"><i
                                    class="fa fa-fw fa-eraser"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col text-right">
                <div class="row">
                    <div class="col">
                        <a href="<?= base_url('admin/order/report') ?>" class="btn btn-sm btn-danger px-3">
                            <i class="fa fa-file-pdf pr-2" aria-hidden="true"></i><strong>Report Order</strong></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <?php $this->load->view('layouts/_alerts') ?> -->

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    foreach ($content as $row) : $no++ ?>
                    <tr>
                        <td><strong>#<?= e($row->invoice) ?></strong></td>
                        <td><?= date('d/m/Y', strtotime($row->date)) ?></td>
                        <td>Rp<?= formatRupiah($row->total + $row->cost_courier) ?></td>
                        <td>
                            <?php $this->load->view('layouts/_status', ['status' => $row->status]);  ?>
                        </td>
                        <td>
                            <a href="<?= base_url("admin/order/detail/$row->id") ?>"
                                class="btn btn-sm btn-secondary">Detail Order</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <nav arial-label="Page navigation example" class="mt-2">
            <?= $pagination ?>
        </nav>
    </div>
</div>