<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="<?= base_url('users/tambahaksi'); ?>" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <input type="hidden" name="id" id="id">
                        <tr>
                            <td> Foto Profile</td>
                            <td> : </td>
                            <td> <input type="file" name="profile_image"> </td>
                        </tr>
                        <tr>
                            <td> Masukan Username</td>
                            <td> : </td>
                            <td> <input type="text" name="username" placeholder="Username"> </td>
                        </tr>
                        <tr>
                            <td> Masukan Password</td>
                            <td> : </td>
                            <td> <input type="password" name="password" placeholder="Password"> </td>
                        </tr>
                        <tr>
                            <td> Masukan Role</td>
                            <td> : </td>
                            <td>
                                <select name="role" value="role">
                                    <option value="user">Silahkan Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </td>
                        </tr>
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