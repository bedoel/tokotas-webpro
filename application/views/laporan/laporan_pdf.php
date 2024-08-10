<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            margin-top: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        table td {
            vertical-align: middle;
        }

        .total-pendapatan {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="<?= base_url('assets/'); ?>images/logo-tastas.png" alt="Logo Toko" style="max-width: 200px;">
    </div>
    <h2 class="text-center mb-4">Laporan Pesanan</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Invoice</th>
                <th>Nama</th>
                <th>No Hp</th>
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order->id_orders; ?></td>
                    <td><?php echo $order->invoice; ?></td>
                    <td><?php echo $order->nama; ?></td>
                    <td><?php echo $order->hp; ?></td>
                    <td><?php echo $order->alamat; ?></td>
                    <td><?php echo $order->tanggal; ?></td>
                    <td><?php echo $order->nama_barang; ?></td>
                    <td>Rp <?php echo number_format($order->total, 0, ',', '.'); ?></td>
                    <td><?php echo $order->status; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="total-pendapatan">
        Pendapatan Hari Ini: Rp <?php echo number_format($pendapatan_hari_ini, 0, ',', '.'); ?>
    </div>
    <div class="total-pendapatan">
        Total Pendapatan: Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?>
    </div>
</body>

</html>