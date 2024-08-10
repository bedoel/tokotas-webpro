<!-- Start Hero Section -->
<div class="hero1">
    <div class="container">
        <div class="col-lg-5">
            <div class="intro-excerpt">
                <h1>Pembayaran</h1>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-sectionn">
    <div class="container">
        <form action="<?= base_url('myorder/confirm/') ?><?php echo $order->invoice; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Konfirmasi Order # <?php echo $order->invoice; ?></h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="nama_rek" class="text-black">Nama rekening pengirim <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_rek" name="nama_rek">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="no_rek" class="text-black">Nomor rekening <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_rek" name="no_rek">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="nominal" class="text-black">Nominal <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nominal" name="nominal">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="note" class="text-black">Catatan <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="note" name="note" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="gambar_bukti" class="text-black">Bukti Transfer <span class="text-danger">*</span></label>
                                <input type="file" name="gambar_bukti" id="gambar_bukti" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <button class="btn btn-black btn-lg py-3 btn-block" type="submit">Konfirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- </form> -->
    </div>
</div>