<?php
switch ($status) {
    case 'waiting':
        $badge = 'badge-secondary';
        $label = 'Menunggu Pembayaran';
        break;
    case 'paid':
        $badge = 'badge-primary';
        $label = 'Dibayar';
        break;
    case 'process':
        $badge = 'badge-warning';
        $label = 'Diproses Penjual';
        break;
    case 'delivered':
        $badge = 'badge-info';
        $label = 'Dikirim';
        break;
    case 'done':
        $badge = 'badge-success';
        $label = 'Selesai';
        break;
    case 'cancel':
        $badge = 'badge-danger';
        $label = 'Dibatalkan';
        break;
    default:
        $badge = 'badge-secondary';
        $label = $status;
}
?>

<?php if ($label) : ?>
    <span class="badge badge-pill <?= $badge ?>"><?= $label ?></span>
<?php endif ?>