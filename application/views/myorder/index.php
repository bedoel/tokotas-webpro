<!-- Start Hero Section -->
<div class="hero1">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>My Order</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->



<div class="untree_co-sectionn">
    <div class="container">
        <div class="row mb-5">
            <div class="site-blocks-table">
                <?php if (!empty($myorder)) : ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-price">No</th>
                                <th class="product-name">Invoice</th>
                                <th class="product-price">Tanggal</th>
                                <th class="product-quantity">Total</th>
                                <th class="product-quantity">Status</th>
                                <th class="product-quantity">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($myorder as $order) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td>
                                        <a href="<?= base_url("myorder/detail/$order->invoice") ?>"><strong>#<?= $order->invoice ?></strong></a>
                                    </td>
                                    <td><?= str_replace('-', '/', date('d-m-Y', strtotime($order->tanggal))) ?></td>
                                    <td>Rp.<?= number_format($order->total, 0, ',', '.') ?>,-</td>
                                    <td>
                                        <?php $this->load->view('layouts/_status', ['status' => $order->status]) ?>
                                    </td>
                                    <td><a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('myorder/do_delete/' . $order->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <?php $i++; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No items found in myorder</p>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>