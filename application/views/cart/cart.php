<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->



<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <div class="site-blocks-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="product-thumbnail">Image</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-total">Total</th>
                            <th class="product-remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo form_open('cart/update'); ?>

                        <?php $i = 1; ?>

                        <?php foreach ($this->cart->contents() as $item) { ?>
                            <?php echo form_hidden($i . '[rowid]', $item['rowid']); ?>
                            <tr>
                                <td class="product-thumbnail">
                                    <img src="<?= base_url('assets/img/upload/'); ?><?= $item['gambar']; ?>" alt="Image" class="img-fluid">
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black"><?= $item['name']; ?></h2>
                                </td>
                                <td>Rp. <?= number_format($item['price'], 0); ?></td>
                                <td>
                                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">

                                        <?php echo form_input(array(
                                            'name' => $i . '[qty]',
                                            'value' => $item['qty'],
                                            'maxlength' => '3',
                                            'min' => '1',
                                            'size' => '5',
                                            'class' => 'form-control',
                                            'type' => 'number'
                                        )); ?>

                                    </div>
                                </td>
                                <td>Rp. <?= number_format($item['subtotal'], 0); ?></td>
                                <td><a href="<?= base_url('cart/delete/' . $item['rowid']); ?>" class="btn btn-secondary"><ion-icon name="trash-outline"></ion-icon></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button type="submit" class="btn btn-black btn-sm btn-block swalDefaultSuccess"><ion-icon name="save-outline"></ion-icon> Update Cart</button>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('cart/clear'); ?>" type="submit" class="btn btn-outline-black btn-sm btn-block swalDefaultSuccess">Clear Cart</a>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">Rp. <?php echo number_format($this->cart->total(), 0); ?></strong>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='<?= base_url('checkout'); ?>'">Proceed To Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>