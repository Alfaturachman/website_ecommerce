<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<style>
.table-header-dark {
    background-color: #343a40;
    /* Dark color for the header background */
    color: white;
    /* Text color for the header */
}

.custom-table {
    border-collapse: collapse;
    width: 100%;
}

.custom-table th,
.custom-table td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

.custom-table th {
    background-color: #f2f2f2;
}
</style>

<div class="card shadow my-5">
    <div class="card-header d-flex justify-content-between">
        <div class="row">
            <div class="col-6">
                <h2><strong>Laporan Order NOMADENSTUFF</strong></h2>
                <h4><span><?= $currentDateTime ?></span></h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Date</th>
                        <th>Nama Customer</th>
                        <th>Subtotal</th>
                        <th>Diskon Persen</th>
                        <th>Diskon Total</th>
                        <th>Ongkos Kirim</th>
                        <th>Total Keseluruhan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $today = date('Y-m-d'); // Get today's date

                    foreach ($orders as $order) :
                        // Check if the order date is today
                        if ($order->date == $today) :
                            $no++;
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>#<?= e($order->invoice) ?></td>
                        <td><?= e($order->date) ?></td>
                        <td><?= e($order->name) ?></td>
                        <td>Rp<?= formatRupiah($order->total_subtotal) ?></td>
                        <td><?= e($order->diskon_persen) ?>%</td>
                        <td>Rp<?= formatRupiah($order->diskon) ?></td>
                        <td>Rp<?= formatRupiah($order->cost_courier) ?></td>
                        <td>Rp<?= formatRupiah($order->total) ?></td>
                    </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>