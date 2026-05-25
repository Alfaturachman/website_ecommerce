<style>
ul.border-none {
    border: none !important;
}

li.border-none {
    border: none !important;
}

.card {
    box-shadow: none;
    border-radius: 10px;
}

.list-group-item.active {
    background-color: #343a40;
    border-color: #343a40;
}

.list-group-item.active a {
    color: white !important;
    background-color: transparent !important;
}

.list-group-item {
    cursor: pointer;
    transition: background-color 0.3s;
    /* Add transition for a smoother effect */
}

.menu {
    background-color: #EEEEEE;
    /* Add transition for a smoother effect */
}

.list-group-item:not(.active):hover {
    background-color: #EEEEEE;
    /* Change the background color on hover for non-active items */
}
</style>

<div class="card p-3">
    <p class="text-center"><strong>PENGATURAN</strong></p>
    <ul class="border-none m-0 p-0">
        <li class="border-none list-group-item <?php echo strpos(uri_string(), 'profile') !== false ? 'active' : ''; ?>"
            onclick="window.location.href='<?= base_url('profile') ?>';">
            Profil
        </li>
        <li class="border-none list-group-item <?php echo strpos(uri_string(), 'myorder') !== false ? 'active' : ''; ?>"
            onclick="window.location.href='<?= base_url('myorder') ?>';">
            Orders
        </li>
        <li class="border-none list-group-item <?php echo uri_string() == 'logout' ? 'active' : ''; ?>"
            onclick="window.location.href='<?= base_url('logout') ?>';">
            Logout
        </li>
    </ul>
</div>