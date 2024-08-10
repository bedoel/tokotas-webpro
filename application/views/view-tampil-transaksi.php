<?php
$count = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Transaksi</title>
</head>

<body>
    <center>
        <tr>
            <td colspan="4" align="center"> Form Tampil Data Transaksi</td>
        </tr>
        <table border="2" style="border-collapse: collapse; width:50%;">

            <tr style="background: gray;">
                <td> No</td>
                <td> ID Transaksi</td>
                <td> Jumlah Barang</td>
                <td> Total Harga</td>
                <td> Tanggal Transaksi</td>
                <td> Tujuan</td>
            </tr>
            <?php foreach ($transaksi as $trans) { ?>
                <tr>
                    <td><?= $count; ?></td>
                    <td><?php echo $trans->id_transaksi; ?></td>
                    <td><?php echo $trans->jml_barang; ?></td>
                    <td><?php echo $trans->total_harga; ?></td>
                    <td><?php echo $trans->tgl_transaksi; ?></td>
                    <td><?php echo $trans->tujuan; ?></td>
                    <td><a href="<?= base_url('barang/editdata/' . $trans->id_transaksi); ?> ">Edit</a> ||
                        <a href="<?= base_url('barang/do_delete/' . $trans->id_transaksi); ?>">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a href="<?= base_url('barang/tambah') ?>"> Tambah Transaksi Baru</a>
    </center>
</body>

</html>