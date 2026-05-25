<div class="card shadow my-3">
    <div class="card-header">
        <span class="m-0 font-weight-bold text-primary">Formulir Kategori</span>
    </div>
    <div class="card-body">
        <form action="<?= $form_action ?>" method="post">
            <?= isset($input->id) ? '<input type="hidden" name="id" value="' . e($input->id) . '">' : '' ?>
            <div class="form-group">
                <label for="title">Kategori</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= e($input->title) ?>"
                    onkeyup="createSlug()" placeholder="Masukan Kategori" required autofocus>
                <?= form_error('title') ?>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="<?= e($input->slug) ?>" required
                    readonly>
                <?= form_error('slug') ?>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <a class="btn btn-secondary px-5" href="<?= base_url('admin/category') ?>" role="button">
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