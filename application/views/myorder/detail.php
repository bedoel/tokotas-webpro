<!-- Start Hero Section -->

<div class="hero2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-10">
                <div class="intro-excerpt">
                    <h1>Detail Pemesanan</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Hero Section -->

<div class="untree_co-sectionn">
    <div class="container">
        <div class="p-3 p-lg-5 border bg-white">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="invoice" class="text-black">Detail Orders <span class="text-danger">#</span><?php echo $order->invoice; ?></label>
                    <hr>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="tanggal" class="text-black">Tanggal : <?php echo $order->tanggal; ?></label>
                </div>
                <div class="col-md-12">
                    <label for="nama" class="text-black">Nama : <?php echo $order->nama; ?></label>
                </div>
                <div class="col-md-12">
                    <label for="hp" class="text-black">Telepon : <?php echo $order->hp; ?></label>
                </div>
                <div class="col-md-12">
                    <label for="Alamat" class="text-black">Alamat : <?php echo $order->alamat; ?></label>
                    <hr>
                </div>
            </div>
            <h2>Order Items</h2>
            <?php if (!empty($order_detail)) : ?>
                <div class="row mb-5">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-price">Produk</th>
                                    <th class="product-name">Harga</th>
                                    <th class="product-price">Jumlah</th>
                                    <th class="product-quantity">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_detail as $item) : ?>
                                    <tr>
                                        <td><?= $item->nama_barang; ?></td>
                                        <td>Rp. <?= number_format($item->harga_barang, 0); ?></td>
                                        <td><?= $item->qty; ?></td>
                                        <td>Rp. <?= number_format($item->subtotal, 0); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th>Rp. <?= number_format($order->total, 0); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                <?php else : ?>
                    <p>No items found in this order.</p>
                <?php endif; ?>
                <?php if ($order->status == 'waiting') : ?>
                    <div class="card-footer">
                        <a href="<?= base_url("myorder/confirm/$order->invoice") ?>" class="btn btn-secondary">Konfirmasi pembayaran</a>
                    </div>
                <?php endif ?>
                <hr>
                <?php if (isset($order_confirm)) : ?>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    Bukti Transfer
                                </div>
                                <div class="card-body">
                                    <p>Nomor rekening: <?= $order_confirm->no_rek ?></p>
                                    <p>Atas nama: <?= $order_confirm->nama_rek ?></p>
                                    <p>Nominal: Rp.<?= number_format($order_confirm->nominal, 0, ',', '.') ?>,-</p>
                                    <p>Catatan: <?= $order_confirm->note ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="<?= base_url("assets/img/upload/$order_confirm->gambar_bukti") ?>" alt="" height="300">
                        </div>
                    </div>
                <?php endif ?>
                </div>

        </div>
    </div>
</div>