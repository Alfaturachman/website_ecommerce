<div class="card shadow my-3">
    <div class="card-header">
        <span class="m-0 font-weight-bold text-primary">
            <h5><strong>Formulir Customer</strong></h5>
        </span>
    </div>
    <div class="card-body">
        <form action="<?= $form_action ?>" method="post" enctype="multipart/form-data">
            <?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Masukan Nama" value="<?= isset($input->name) ? e($input->name) : '' ?>" required>
                <small class="text-danger"><?= form_error('name') ?></small>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" value="<?= isset($input->email) ? e($input->email) : '' ?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <small class="text-danger"><?= form_error('email') ?></small>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password minimal 6 karakter" required>
                <div class="error"><?= form_error('password') ?></div>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Masukkan password yang sama" required>
                <div class="error"><?= form_error('password_confirmation') ?></div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <a class="btn btn-secondary px-5" href="<?= base_url('admin/customer') ?>" role="button">
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