<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css?v=3.2.0">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/tiny-slider.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet">
    <title><?= $title; ?></title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="<?= base_url('home'); ?>"><img src="<?= base_url('assets/'); ?>images/logo-tastas.png" alt="" width="50"><span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home'); ?>">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('shop'); ?>">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About us</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('myorder'); ?>">My Order</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="<?= base_url('cart'); ?>"><img src="<?= base_url('assets/'); ?>images/cart.svg" class="cart"></a></li>
                    <?php if ($this->session->userdata('user_id')) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if ($this->session->userdata('profile_image') == 'default.png') : ?>
                                    <img src="<?= base_url('assets/'); ?>images/<?= $this->session->userdata('profile_image'); ?>" class="profile"> <?= $this->session->userdata('username'); ?>
                                <?php else : ?>
                                    <img src="<?= base_url('assets/'); ?>img/upload/<?= $this->session->userdata('profile_image'); ?>" class="profile"> <?= $this->session->userdata('username'); ?>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userMenu">
                                <?php if ($this->session->userdata('role') == 'admin') : ?>
                                    <li><a class="dropdown-item" href="<?= base_url('dashboard'); ?>">Dashboard Admin</a></li>
                                <?php endif ?>
                                <li><a class="dropdown-item" href="<?= base_url('profile/editprofile/' . $this->session->userdata('user_id')); ?>">Settings</a></li>
                                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif ?>
                    <?php if (!$this->session->userdata('user_id')) : ?>
                        <li>
                            <a class="btn btn-secondary2 nav-link" href="<?= base_url('auth'); ?>">
                                Login
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-white-outline btna2 nav-link" href="<?= base_url('auth/register'); ?>">
                                Register
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>

    </nav>