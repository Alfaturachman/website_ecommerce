<div class="profile-sidebar__user">
    <div class="profile-sidebar__avatar">
        <?= strtoupper(substr($this->session->userdata('name'), 0, 1)) ?>
    </div>
    <div class="profile-sidebar__info">
        <div class="profile-sidebar__name"><?= e($this->session->userdata('name')) ?></div>
        <div class="profile-sidebar__email"><?= e($this->session->userdata('email')) ?></div>
    </div>
</div>

<nav class="profile-sidebar__nav">
    <a href="<?= base_url('profile') ?>" class="profile-sidebar__item <?php echo strpos(uri_string(), 'profile') !== false ? 'profile-sidebar__item--active' : ''; ?>">
        <i class="fas fa-user"></i>
        <span>Profile</span>
    </a>
    <a href="<?= base_url('myorder') ?>" class="profile-sidebar__item <?php echo strpos(uri_string(), 'myorder') !== false ? 'profile-sidebar__item--active' : ''; ?>">
        <i class="fas fa-box"></i>
        <span>Orders</span>
    </a>
    <a href="<?= base_url('logout') ?>" class="profile-sidebar__item profile-sidebar__item--logout">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
    </a>
</nav>
