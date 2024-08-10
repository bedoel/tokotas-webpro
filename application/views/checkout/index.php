<!-- Start Hero Section -->
<div class="hero1">
    <div class="container">
        <div class="col-lg-5">
            <div class="intro-excerpt">
                <h1>Checkout</h1>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-sectionn">
    <div class="container">
        <form action="<?= base_url('checkout/create') ?>" method="POST">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="text-black">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="alamat" class="text-black">Alamat <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="hp" class="text-black">No Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="hp" name="hp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->cart->contents() as $item) { ?>
                                            <tr>
                                                <td><?= $item['name']; ?> <strong class="mx-2">x</strong> <?= $item['qty']; ?></td>
                                                <td>Rp. <?= number_format($item['subtotal'], 0); ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold"><strong>Rp. <?php echo number_format($this->cart->total(), 0); ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="form-group">
                                    <button class="btn btn-black btn-lg py-3 btn-block" type="submit">Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </form>
        <!-- </form> -->
    </div>
</div>