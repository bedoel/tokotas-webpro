<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Transaksi</title>
</head>

<body>
    <center>
        <form action="<?= base_url('Barang/tambahaksi'); ?>" method="post">
            <table border="2">
                <tr>
                    <td colspan="3" align="center">Form Input Tas</td>
                </tr>

                <tr>
                    <td> Masukan ID Transaksi</td>
                    <td> : </td>
                    <td> <input type="text" name="kd_barang" placeholder="Kode Barang"> </td>
                </tr>
                <tr>
                    <td> Masukan Jumlah Tas</td>
                    <td> : </td>
                    <td> <input type="text" name="nama_barang" placeholder="Nama Tas"> </td>
                </tr>
                <tr>
                    <td> Masukan Harga Tas</td>
                    <td> : </td>
                    <td> <input type="text" name="harga_barang" placeholder="Harga Tas"> </td>
                </tr>
                <tr>
                    <td> Masukan Stok Tas</td>
                    <td> : </td>
                    <td> <input type="text" name="stok_barang" placeholder="Stok Tas"> </td>
                </tr>
                <tr>
                    <td> Masukan Gambar Tas</td>
                    <td> : </td>
                    <td> <input type="text" name="gambar_barang" placeholder="Gambar Tas"> </td>
                </tr>
                <tr>
                    <td> Masukan Kategori Tas</td>
                    <td> : </td>
                    <td>
                        <select name="kategori" value="Kategori">
                            <option value="">Silahkan Pilih Kategori</option>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                        </select>
                    </td>
                </tr>
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