<?php
$success = $this->session->flashdata('success');
$error = $this->session->flashdata('error');
$warning = $this->session->flashdata('warning');

if ($success) {
    $message = $success;
} elseif ($error) {
    $message = $error;
} elseif ($warning) {
    $message = $warning;
} else {
    return;
}
?>

<div class="alert-premium">
    <span style="font-size:0.85rem"><?= $message ?></span>
    <button type="button" class="alert-premium__close" data-dismiss="alert">&times;</button>
</div>
