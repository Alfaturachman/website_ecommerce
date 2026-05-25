<div class="card shadow my-3">
    <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800"><strong>Kategori</strong></h1>
        </div>
        <!-- <span class="m-0 font-weight-bold text-primary">Kategori</span> -->
    </div>
    <div class="card-body">
        <div class="row mb-4 d-flex justify-content-between">
            <div class="col-md-2 col-sm-12">
                <?= form_open('admin/category/search', ['method' => 'POST', 'class' => 'form-inline']) ?>
                <div class="form-group">
                    <input type="text" name="keyword" class="form-control form-control-sm text-center"
                        placeholder="Cari Kategori" value="<?= $this->session->userdata('keyword') ?>">
                    <div class="btn-group mx-sm-3" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-sm btn-secondary"><i
                                class="fa fa-fw fa-search"></i></button>
                        <a href="<?= base_url('admin/category/reset') ?>" class="btn btn-sm btn-secondary"><i
                                class="fa fa-fw fa-eraser"></i></a>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            <div class="col-md-6 col-sm-12 d-flex justify-content-end">
                <div class="row">
                    <div class="col">
                        <a href="<?= base_url('admin/category/create') ?>" class="btn btn-sm btn-primary px-3"><i
                                class="fa fa-plus pr-2" aria-hidden="true"></i><strong>Tambah Kategori</strong></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <?php $this->load->view('layouts/_alerts') ?> -->

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Slug</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    foreach ($content as $row) : $no++; ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= e($row->title) ?></td>
                        <td><?= e($row->slug) ?></td>
                        <td>
                            <?= form_open("admin/category/delete/$row->id", ['method' => 'POST']) ?>
                            <?= form_hidden('id', $row->id) ?>
                            <a href="<?= base_url("admin/category/edit/$row->id") ?>" class="btn btn-sm"><i
                                    class="fas fa-fw fa-edit text-info"></i></a>

                            <button class="btn btn-sm" type="submit"
                                onclick="return confirm('Apakah yakin ingin menghapus?')"><i
                                    class="fas fa-fw fa-trash text-danger"></i></button>
                            <?= form_close() ?>
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