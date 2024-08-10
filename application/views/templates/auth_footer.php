</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; TASTAS 2024</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

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
<script src="<?= base_url('assets') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets') ?>/js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>
<script src="<?= base_url('assets') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#export').click(function() {
            $.ajax({
                url: '<?php echo base_url('users/export_to_excel'); ?>',
                type: 'GET',
                success: function(response) {
                    window.location.href = '<?php echo base_url('users/export_to_excel'); ?>';
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        var currentUrl = window.location.href; // Mendapatkan URL lengkap dari halaman saat ini
        var pathArray = window.location.pathname.split('/'); // Memisahkan path URL menjadi array

        // Loop melalui setiap elemen menu untuk memeriksa apakah URL saat ini cocok
        $('.nav-item').each(function() {
            var href = $(this).find('a').attr('href'); // Mendapatkan nilai atribut href dari setiap elemen menu

            // Memeriksa apakah href mengandung path yang cocok dengan URL saat ini
            if (currentUrl.indexOf(href) !== -1) {
                $(this).addClass('active'); // Menambahkan kelas 'active' jika cocok
            }
        });
    });
</script>

</body>

</html>