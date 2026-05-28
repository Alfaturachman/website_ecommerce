<div style="padding:3rem 2rem;max-width:var(--max-width);margin:0 auto;min-height:60vh">
    <div class="profile-layout">
        <aside class="profile-sidebar">
            <?php $this->load->view('layouts/user/_sidebar') ?>
        </aside>

        <div>
            <h1 style="font-size:1.25rem;font-weight:700;letter-spacing:-0.02em;margin-bottom:1.5rem">Edit Profile</h1>

            <div style="border:1px solid var(--gray-100);padding:1.5rem">
                <form action="<?= $form_action ?>" method="POST" enctype="multipart/form-data">
                    <?php if (isset($input->id)) : ?>
                    <input type="hidden" name="id" value="<?= e($input->id) ?>">
                    <?php endif; ?>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem">
                        <div class="form-group" style="margin:0">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="<?= e($input->name) ?>" class="form-input" required>
                            <?= form_error('name') ?>
                        </div>
                        <div class="form-group" style="margin:0">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="<?= e($input->email) ?>" class="form-input" placeholder="Active email" required>
                            <?= form_error('email') ?>
                        </div>
                        <div class="form-group" style="margin:0">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" value="<?= e($input->phone) ?>" class="form-input" required>
                            <?= form_error('phone') ?>
                        </div>
                        <div class="form-group" style="margin:0">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="<?= e($input->address) ?>" class="form-input" required>
                            <?= form_error('address') ?>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Min. 8 characters">
                        <?= form_error('password') ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Photo</label>
                        <br>
                        <input type="file" name="image" id="imageInput" style="font-size:0.85rem">
                        <?php if ($this->session->flashdata('image_error')) : ?>
                        <small class="form-error"><?= e($this->session->flashdata('image_error')) ?></small>
                        <?php endif ?>
                        <?php if (isset($input->image)) : ?>
                        <div class="mt-2">
                            <img src="<?= base_url("/images/user/$input->image") ?>" alt="" height="100" style="border:1px solid var(--gray-100)">
                        </div>
                        <?php endif ?>
                        <img class="mt-2" src="#" alt="Preview" id="imagePreview" style="max-width:25%;display:none;border:1px solid var(--gray-100)">
                    </div>

                    <div class="flex gap-2 mt-4">
                        <a class="btn btn--outline" href="<?= base_url('profile') ?>">
                            <i class="fas fa-arrow-left" style="font-size:0.65rem"></i>
                            Back
                        </a>
                        <button class="btn btn--black" type="submit" style="flex:1">
                            Save Changes
                            <i class="fas fa-check" style="font-size:0.65rem"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('imageInput').addEventListener('change', function() {
    var preview = document.getElementById('imagePreview');
    if (this.files.length > 0) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    } else {
        preview.style.display = 'none';
    }
});
</script>
