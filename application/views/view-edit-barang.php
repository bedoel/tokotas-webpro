<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Tas </title>
</head>

<body>
    <center>
        <form action="<?= base_url('index.php/barang/updatedata'); ?>" method="post">
            <table border="2">
                <tr>
                    <td colspan="3" align="center">Form Input Tas</td>
                </tr>
                <?php foreach ($barang as $tas) { ?>
                    <tr>
                        <td> Masukan Kode Barang</td>
                        <td> : </td>
                        <td> <input type="text" name="kd_barang" value="<?php echo $tas->kd_barang; ?>"> </td>
                    </tr>
                    <tr>
                        <td> Masukan Nama Tas</td>
                        <td> : </td>
                        <td> <input type="text" name="nama_barang" value="<?php echo $tas->nama_barang; ?>"> </td>
                    </tr>
                    <tr>
                        <td> Masukan Harga Tas</td>
                        <td> : </td>
                        <td> <input type="text" name="harga_barang" value="<?php echo $tas->harga_barang; ?>"> </td>
                    </tr>
                    <tr>
                        <td> Masukan Stok Tas</td>
                        <td> : </td>
                        <td> <input type="text" name="stok_barang" value="<?php echo $tas->stok_barang; ?>"> </td>
                    </tr>
                    <tr>
                        <td> Masukan Gambar Tas</td>
                        <td> : </td>
                        <td> <input type="text" name="gambar_barang" value="<?php echo $tas->gambar_barang; ?>"> </td>
                    </tr>
                    <tr>
                        <td> Masukan Kategori Tas</td>
                        <td> : </td>
                        <td> <input type="text" name="kategori" value="<?php echo $tas->kategori; ?>"> </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" name="btnsubmit" value="SIMPAN">
                    </td>
                </tr>
            </table>
        </form>
    </center>

</body>

</html>