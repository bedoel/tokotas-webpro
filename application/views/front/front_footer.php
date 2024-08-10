<footer class="footer-section">
    <div class="container relative">
        <div class="sofa-img">
            <img src="<?= base_url(); ?>assets/images/footer.png" alt="Image" class="img-fluid">
        </div>

        <div class="row g-5 mb-5">
            <div class="col-lg-9">
                <div class="mb-4 footer-logo-wrap" id="about"><a href="#" class="footer-logo">TASTAS<span>.</span></a></div>
                <p class="mb-4">Selamat datang di TASTAS, di mana kami menghadirkan koleksi tas yang menggabungkan keanggunan dan fungsionalitas. Kami berkomitmen untuk menciptakan produk-produk berkualitas tinggi yang tidak hanya memenuhi kebutuhan sehari-hari Anda, tetapi juga menambahkan sentuhan gaya yang tak tertandingi dalam setiap langkah Anda.</p>

                <ul class="list-unstyled custom-social">
                    <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                </ul>
            </div>

        </div>

        <div class="border-top copyright">
            <div class="row pt-4">
                <div class="col-lg-6">
                    <p class="mb-2 text-center text-lg-start">Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script>. All Rights Reserved. &mdash; Designed with love by Bahari Jaya Abadi
                    </p>
                </div>

                <div class="col-lg-6 text-center text-lg-end">
                    <ul class="list-unstyled d-inline-flex ms-auto">
                        <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</footer>
<!-- End Footer Section -->

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/tiny-slider.js"></script>
<script src="<?= base_url('assets/'); ?>js/custom.js"></script>
<!-- jQuery -->
<script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan URL saat ini
        var currentUrl = window.location.href;

        // Mengambil semua link dalam navbar
        var navLinks = document.querySelectorAll('.custom-navbar-nav .nav-link');

        // Loop melalui setiap link
        navLinks.forEach(function(navLink) {
            // Jika URL link cocok dengan URL saat ini
            if (navLink.href === currentUrl) {
                // Hapus kelas 'active' dari semua item navbar
                document.querySelectorAll('.custom-navbar-nav .nav-item').forEach(function(navItem) {
                    navItem.classList.remove('active');
                });

                // Tambahkan kelas 'active' ke parent element (li) dari link yang cocok
                navLink.parentElement.classList.add('active');
            }
        });
    });
</script>
<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Barang Berhasil ditambahkan'
            })
        });

    });
</script>
</body>

</html>