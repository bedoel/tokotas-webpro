<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <?php $this->load->view('layouts/_alert') ?>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Data Users</h1>
        </div>
        <div class="float-right">
            <?php if ($this->session->userdata('role') == 'admin') : ?>
                <a href="<?php echo base_url('users/export_to_excel'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Excel</a>
                <a href="<?= base_url('users/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
            <?php endif ?>
        </div>
    </div>
    <hr>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?php echo $user->id; ?></td>
                                <td><img class="img-profile rounded-circle" src="<?= base_url('assets/img/upload/' . $user->profile_image); ?>" alt="" width="30"> <?php echo $user->username; ?></td>
                                <td><?php echo $user->role; ?></td>
                                <td>
                                    <a href="<?= base_url('users/editdata/' . $user->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('users/do_delete/' . $user->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->