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
            <h1 class="h3 m-0 text-gray-800">Detail User</h1>
        </div>
        <div class="float-right">
            <a href="<?= base_url('users') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="<?= base_url('users/updatedata'); ?>" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <?php foreach ($users as $user) { ?>
                            <input type="hidden" name="id" id="id" value="<?php echo $user->id; ?>">
                            <input type="hidden" name="old_password" value="<?php echo $user->password; ?>">
                            <input type="hidden" name="old_profile_image" value="<?php echo $user->profile_image; ?>">
                            <tr>
                                <td> Masukan Foto</td>
                                <td> : </td>
                                <td> <input type="file" class="form-control" id="profile_image" name="profile_image"> </td>
                            </tr>
                            <tr>
                                <td> Masukan Username</td>
                                <td> : </td>
                                <td> <input type="text" name="username" value="<?php echo $user->username; ?>"> </td>
                            </tr>
                            <tr>
                                <td> Masukan Password</td>
                                <td> : </td>
                                <td> <input type="text" name="password"> </td>
                            </tr>
                            <tr>
                                <td> Masukan Role</td>
                                <td> : </td>
                                <td>
                                    <select name="role" value="role">
                                        <option value="<?= $user->role; ?>"><?= $user->role; ?></option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" align="center">
                                <input type="submit" name="btnsubmit" value="SIMPAN">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->