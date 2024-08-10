<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Selamat datang di TASTAS</h1>
                    <p class="mb-4">Kami mengundang Anda untuk menjelajahi koleksi eksklusif kami yang dipenuhi dengan tas-tas yang tak hanya memenuhi kebutuhan sehari-hari Anda, tetapi juga menambahkan sentuhan gaya yang tak terbantahkan.</p>
                    <p><a href="<?= base_url('shop'); ?>" class="btn btn-secondary me-2">Shop Now</a></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="<?= base_url(); ?>assets/images/main2.png" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Product Section -->
<div class="product-section">
    <div class="container">
        <div class="row">

            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
                <p><a href="shop.html" class="btn">Explore</a></p>
            </div>
            <!-- End Column 1 -->

            <!-- Start Column 2 -->
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
            <!-- End Column 2 -->

        </div>
    </div>
</div>
<!-- End Product Section -->

<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h2 class="section-title">Mengapa Memilih Kami</h2>

                <div class="row my-5">
                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="<?= base_url(); ?>assets/images/truck.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Pengiriman Cepat &amp; Gratis</h3>
                            <p>Nikmati pengiriman cepat dan gratis untuk setiap pembelian. Kami mengutamakan kenyamanan Anda dalam mendapatkan tas impian Anda.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="<?= base_url(); ?>assets/images/bag.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Mudah Berbelanja</h3>
                            <p>Temukan pengalaman berbelanja yang mudah dan menyenangkan dengan antarmuka yang ramah pengguna. Temukan berbagai koleksi tas kami dengan cepat dan efisien.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="<?= base_url(); ?>assets/images/support.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Dukungan 24/7</h3>
                            <p>Kami siap membantu Anda kapan pun dibutuhkan. Dapatkan dukungan pelanggan yang responsif 24 jam sehari, 7 hari seminggu untuk menanggapi semua pertanyaan dan kebutuhan Anda.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="<?= base_url(); ?>assets/images/return.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Pengembalian Tanpa Ribet</h3>
                            <p>Kami memahami bahwa kepuasan pelanggan adalah prioritas utama. Nikmati pengembalian produk yang mudah dan tanpa ribet jika Anda tidak puas dengan pembelian Anda.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="<?= base_url(); ?>assets/images/bg1.jpg" alt="Image" class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Why Choose Us Section -->

<!-- Start Testimonial Slider -->
<div class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Testimonials</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">

                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Saya sangat puas dengan pembelian tas di TASTAS. Tasnya tidak hanya sangat elegan tetapi juga sangat fungsional. Pengiriman pun sangat cepat dan pelayanan pelanggan mereka luar biasa ramah!&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="<?= base_url(); ?>assets/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Sarah W.</h3>
                                            <span class="position d-block mb-3">Jakarta.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Setelah mencari tas yang sempurna untuk acara khusus, saya menemukan TASTAS dan tidak kecewa sama sekali! Tas yang saya beli tidak hanya cantik tetapi juga terbuat dari bahan berkualitas tinggi. Terima kasih TASTAS!&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="<?= base_url(); ?>assets/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Amanda S.</h3>
                                            <span class="position d-block mb-3">Surabaya.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Saya sangat merekomendasikan TASTAS untuk semua kebutuhan tas Anda. Saya baru-baru ini membeli tas harian dari mereka dan saya sangat senang dengan desainnya yang stylish dan kemudahannya dalam penggunaan sehari-hari. Layanan pengiriman juga sangat baik!&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="<?= base_url(); ?>assets/images/person-1.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Budi P.</h3>
                                            <span class="position d-block mb-3">Bandung.</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonial Slider -->

<!-- Start Blog Section -->
<div class="blog-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Recent Blog</h2>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="#" class="more">View All Posts</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="<?= base_url(); ?>assets/images/post-1.jpg" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">First Time Home Owner Ideas</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="<?= base_url(); ?>assets/images/post-2.jpg" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">How To Keep Your Furniture Clean</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="<?= base_url(); ?>assets/images/post-3.jpg" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Blog Section -->