<?php
switch ($status) {
    case 'waiting':
        $badge = 'badge--waiting';
        $label = 'Waiting Payment';
        break;
    case 'paid':
        $badge = 'badge--paid';
        $label = 'Paid';
        break;
    case 'process':
        $badge = 'badge--process';
        $label = 'Processing';
        break;
    case 'delivered':
        $badge = 'badge--delivered';
        $label = 'Delivered';
        break;
    case 'done':
        $badge = 'badge--done';
        $label = 'Completed';
        break;
    case 'cancel':
        $badge = 'badge--cancel';
        $label = 'Cancelled';
        break;
    default:
        $badge = 'badge--waiting';
        $label = $status;
}
?>

<?php if ($label) : ?>
    <span class="badge <?= $badge ?>"><?= $label ?></span>
<?php endif ?>
