<div class="full-height">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <?php $this->load->view('layouts/user/_sidebar') ?>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="card">
                    <div class="card-header py-3">
                        <strong class="h5 font-weight-bold">Profil</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <img src="<?= $content->image ? base_url("/images/profile/$content->image") : base_url("/images/profile/avatar.png") ?>" alt="" width="200" class="img-responsive">
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <fieldset class="m-0 p-0" disabled>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 col-sm-12 d-flex align-items-center">
                                            <label class="form-label">Nama</label>
                                        </div>
                                        <div class="col-lg-10 col-md-8 col-sm-12">
                                            <input type="text" class="form-control" value="<?= e($content->name) ?>" />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-2 col-md-4 col-sm-12 d-flex align-items-center">
                                            <label class="form-label">Email</label>
                                        </div>
                                        <div class="col-lg-10 col-md-8 col-sm-12">
                                            <input type="email" class="form-control" value="<?= e($content->email) ?>" />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-2 col-md-4 col-sm-12 d-flex align-items-center">
                                            <label class="form-label">Phone</label>
                                        </div>
                                        <div class="col-lg-10 col-md-8 col-sm-12">
                                            <input type="text" class="form-control" value="<?= e($content->phone) ?>" />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-2 col-md-4 col-sm-12 d-flex align-items-center">
                                            <label class="form-label">Alamat</label>
                                        </div>
                                        <div class="col-lg-10 col-md-8 col-sm-12">
                                            <input type="text" class="form-control" value="<?= e($content->address) ?>" />
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="mt-4">
                                    <a href="<?= base_url("/profile/update/$content->id") ?>" class="btn btn-dark btn-info px-3">Edit Profil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>