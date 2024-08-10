<!-- Start Hero Section -->
<div class="hero1">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->



<div class="untree_co-sectionn product-section before-footer-section">
    <div class="container">
        <div class="row">
            <?php foreach ($barang as $tas) { ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <?php
                    echo form_open('cart/add');
                    echo form_hidden('id', $tas->kd_barang);
                    echo form_hidden('qty', 1);
                    echo form_hidden('harga', $tas->harga_barang);
                    echo form_hidden('nama', $tas->nama_barang);
                    echo form_hidden('gambar', $tas->gambar_barang);
                    echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));

                    ?>
                    <button class="product-item borderfix swalDefaultSuccess" type="submit">
                        <img src="<?= base_url('assets/img/upload/' . $tas->gambar_barang); ?>" alt="<?= $tas->nama_barang; ?>" class="img-fluid product-thumbnail">
                        <h3 class="product-title"><?php echo $tas->nama_barang; ?></h3>
                        <strong class="product-price">Rp. <?php echo $tas->harga_barang; ?></strong>
                        <p class="product-title">Stok: <?php echo $tas->stok_barang; ?></p>

                        <br>
                        <span class="icon-cross">
                            <img src="<?= base_url('assets/'); ?>images/cross.svg" class="img-fluid">
                        </span>
                    </button>
                    <?= form_close(); ?>
                </div>
            <?php } ?>
        </div>

    </div>
</div>