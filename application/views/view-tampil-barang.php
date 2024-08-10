<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Tas</title>
</head>

<body>
    <center>
        <tr>
            <td colspan="4" align="center"> Form Tampil Data Tas</td>
        </tr>
        <table border="2" style="border-collapse: collapse; width:50%;">

            <tr style="background: gray;">
                <td> Kode Barang</td>
                <td> Nama Barang</td>
                <td> Harga Barang</td>
                <td> Stok</td>
                <td> Gambar Barang</td>
                <td> Kategori</td>
                <td> Keterangan</td>
            </tr>
            <?php foreach ($barang as $tas) { ?>
                <tr>
                    <td><?php echo $tas->kd_barang; ?></td>
                    <td><?php echo $tas->nama_barang; ?></td>
                    <td><?php echo $tas->harga_barang; ?></td>
                    <td><?php echo $tas->stok_barang; ?></td>
                    <td><?php echo $tas->gambar_barang; ?></td>
                    <td><?php echo $tas->kategori; ?></td>
                    <td><a href="<?= base_url('index.php/barang/editdata/' . $tas->kd_barang); ?> ">Edit</a> ||
                        <a href="<?= base_url('index.php/barang/do_delete/' . $tas->kd_barang); ?>">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a href="<?= base_url('index.php/barang/tambah') ?>"> Tambah Tas Baru</a>
    </center>
</body>

</html>