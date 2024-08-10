<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Detail Order <span class="text-danger">#</span><?php echo $order->invoice; ?></h1>
        </div>
        <div class="float-right">
            <a href="<?= base_url('tas') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
        </div>
    </div>

    <hr>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Detail Order</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <label for="tanggal" class="text-black">Tanggal : <?php echo $order->tanggal; ?></label> <br>
                <label for="nama" class="text-black">Nama : <?php echo $order->nama; ?></label><br>
                <label for="hp" class="text-black">Telepon : <?php echo $order->hp; ?></label><br>
                <label for="Alamat" class="text-black">Alamat : <?php echo $order->alamat; ?></label><br>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_detail as $row) : ?>
                            <tr>
                                <td>
                                    <p><img src="<?= base_url('assets/img/upload/' . $row->gambar_barang); ?>" alt="<?= $row->nama_barang; ?>" alt="" height="50"> <strong><?= $row->nama_barang ?></strong></p>
                                </td>
                                <td class="text-center">Rp.<?= number_format($row->harga_barang, 0, ',', '.') ?>,-</td>
                                <td class="text-center"><?= $row->qty ?></td>
                                <td class="text-center">Rp.<?= number_format($row->subtotal, 0, ',', '.') ?>,-</td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="2"><strong>Total:</strong></td>
                            <td class="text-center"><strong>Rp.<?= number_format($order->total, 0, ',', '.') ?>,-</strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer">
                    <form action="<?= base_url("order/update/$order->id") ?>" method="POST">
                        <div class="input-group">
                            <input type="hidden" name="id" value="<?= $order->id ?>">
                            <select name="status" id="" class="form-control">
                                <option value="waiting" <?= $order->status == 'waiting' ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                                <option value="paid" <?= $order->status == 'paid' ? 'selected' : '' ?>>Sudah Dibayar</option>
                                <option value="delivered" <?= $order->status == 'delivered' ? 'selected' : '' ?>>Sudah Dikirim</option>
                                <option value="cancel" <?= $order->status == 'cancel' ? 'selected' : '' ?>>Batal</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->