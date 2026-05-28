<div style="padding:3rem 2rem;max-width:var(--max-width);margin:0 auto;min-height:60vh">
    <div class="profile-layout">
        <aside class="profile-sidebar">
            <?php $this->load->view('layouts/user/_sidebar') ?>
        </aside>

        <div>
            <h1 style="font-size:1.25rem;font-weight:700;letter-spacing:-0.02em;margin-bottom:1.5rem">Profile</h1>

            <div class="profile-card">
                <div class="flex gap-6 items-start" style="flex-wrap:wrap">
                    <div style="width:100px;height:100px;border-radius:50%;overflow:hidden;flex-shrink:0;background:var(--gray-100)">
                        <img src="<?= $content->image ? base_url("/images/profile/$content->image") : base_url("/images/profile/avatar.png") ?>" alt="" style="width:100%;height:100%;object-fit:cover">
                    </div>
                    <div style="flex:1;min-width:200px">
                        <div class="profile-field">
                            <div class="profile-field__label">Name</div>
                            <div class="profile-field__value"><?= e($content->name) ?></div>
                        </div>
                        <div class="profile-field">
                            <div class="profile-field__label">Email</div>
                            <div class="profile-field__value"><?= e($content->email) ?></div>
                        </div>
                        <div class="profile-field">
                            <div class="profile-field__label">Phone</div>
                            <div class="profile-field__value"><?= e($content->phone) ?></div>
                        </div>
                        <div class="profile-field">
                            <div class="profile-field__label">Address</div>
                            <div class="profile-field__value"><?= e($content->address) ?></div>
                        </div>
                        <div class="mt-4">
                            <a href="<?= base_url("/profile/update/$content->id") ?>" class="btn btn--outline btn--sm">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
