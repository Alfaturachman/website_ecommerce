<div class="card shadow my-3">
    <div class="card-header">
        <span class="m-0 font-weight-bold text-primary">Formulir Produk</span>
    </div>
    <div class="card-body">
        <?= form_open_multipart($form_action, ['method' => 'POST']) ?>

        <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Produk</label>
                    <?= form_input('title', $input->title, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => 'createSlug()', 'required' => true, 'placeholder' => 'Masukkan Nama Produk']) ?>
                    <?= form_error('title') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <?= form_textarea(['name' => 'description', 'value' => $input->description, 'class' => 'form-control', 'rows' => 2, 'style' => 'resize: none;', 'placeholder' => 'Masukkan Deskripsi Produk']) ?>
                    <?= form_error('description') ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Harga</label>
                    <?= form_input(['type' => 'number', 'name' => 'price', 'value' => $input->price, 'class' => 'form-control', 'required' => true, 'placeholder' => 'Masukkan Harga Produk']) ?>
                    <?= form_error('price') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_category">Kategori</label>
                    <?= form_dropdown('id_category', getDropdownList('category', ['id', 'title']), $input->id_category, ['class' => 'form-control']) ?>
                    <?= form_error('id_category') ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="size">Ukuran</label>
                    <select name="size" class="form-control" required>
                        <option value="" <?= $input->size == '' ? 'selected' : '' ?>>- Pilih Ukuran -</option>
                        <option value="S" <?= $input->size == 'S' ? 'selected' : '' ?>>S</option>
                        <option value="M" <?= $input->size == 'M' ? 'selected' : '' ?>>M</option>
                        <option value="L" <?= $input->size == 'L' ? 'selected' : '' ?>>L</option>
                        <option value="XL" <?= $input->size == 'XL' ? 'selected' : '' ?>>XL</option>
                    </select>
                    <?= form_error('size') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="color">Warna</label>
                    <?= form_input('color', $input->color, ['class' => 'form-control', 'placeholder' => 'Contoh: Merah, Hijau, Biru', 'required' => true]) ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type">Tipe</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <?= form_radio(['name' => 'type', 'value' => 'L', 'checked' => $input->type == 'L' ? true : false, 'class' => 'form-check-input']) ?>
                        <label for="" class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <?= form_radio(['name' => 'type', 'value' => 'W', 'checked' => $input->type == 'W' ? true : false, 'class' => 'form-check-input']) ?>
                        <label for="" class="form-check-label">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="is_available">Stock</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <?= form_radio(['name' => 'is_available', 'value' => 1, 'checked' => $input->is_available == 1 ? true : false, 'class' => 'form-check-input']) ?>
                        <label for="" class="form-check-label">Tersedia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <?= form_radio(['name' => 'is_available', 'value' => 0, 'checked' => $input->is_available == 0 ? true : false, 'class' => 'form-check-input']) ?>
                        <label for="" class="form-check-label">Kosong</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="slug">Label Produk</label>
            <?= form_input('slug', $input->slug, ['class' => 'form-control', 'id' => 'slug', 'readonly' => true, 'required' => true]) ?>
            <?= form_error('slug') ?>
        </div>

        <div class="form-group">
            <label for="image">Gambar</label>
            <br>
            <input type="file" name="image" id="imageInput" onchange="previewImage(this)">
            <?php if ($this->session->flashdata('image_error')) : ?>
                <small class="form-text text-danger"><?= e($this->session->flashdata('image_error')) ?></small>
            <?php endif ?>
            <?php if ($input->image) : ?>
                <br><br>
                <img id="image-preview" src="<?= base_url("/images/product/$input->image") ?>" alt="" height="150" class="img-responsive">
            <?php else : ?>
                <br><br>
                <img id="image-preview" alt="" height="150" class="img-responsive">
            <?php endif ?>
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

        <div class="row mt-4">
            <div class="col-md-6">
                <a class="btn btn-secondary px-5" href="<?= base_url('admin/product') ?>" role="button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                </a>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-primary px-5" type="submit">
                    <i class="fa fa-save" aria-hidden="true"></i> Simpan
                </button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>