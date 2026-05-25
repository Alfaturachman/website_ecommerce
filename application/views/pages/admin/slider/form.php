<div class="card shadow my-3">
    <div class="card-header">
        <span class="m-0 font-weight-bold text-primary">Formulir Slider</span>
    </div>
    <div class="card-body">
        <form action="<?= $form_action ?>" method="post" enctype="multipart/form-data">
            <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>

            <div class="form-group">
                <label for="">Judul Slider</label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan Judul Slider"
                    value="<?= e($input->title) ?>" required>
                <?= form_error('title') ?>
            </div>

            <div class="form-group">
                <label for="">Urutan Slider</label>
                <input type="number" name="sequence" class="form-control" placeholder="Masukkan Urutan Slider"
                    value="<?= e($input->sequence) ?>" required>
                <?= form_error('sequence') ?>
            </div>

            <div class="form-group">
                <label for="">Ukuran Gambar (max-size: 20mb, max-height: 350 pixel)</label>
                <br>
                <input type="file" name="image" onchange="previewImage(this)">
            </div>

            <?php if ($this->session->flashdata('image_error')) : ?>
            <small class="form-text text-danger"><?= e($this->session->flashdata('image_error')) ?></small>
            <?php endif; ?>

            <?php if ($input->image) : ?>
            <img id="image-preview" src="<?= base_url("/images/slider/{$input->image}") ?>" alt="" height="150"
                class="img-responsive">
            <?php else : ?>
            <!-- Tambahan tag img dengan id image-preview -->
            <img id="image-preview" alt="" height="150" class="img-responsive">
            <?php endif; ?>


            <div class="row mt-5">
                <div class="col-md-6">
                    <a class="btn btn-secondary px-5" href="<?= base_url('admin/slider') ?>" role="button">
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

<script>
function previewImage(input) {
    var preview = document.getElementById('image-preview');
    var file = input.files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}
</script>