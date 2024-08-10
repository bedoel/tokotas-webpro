                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tas</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Input Tas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="<?= base_url('tas/tambahaksi'); ?>" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <tr>

                                        </tr>
                                        <tr>
                                            <td> Masukan Kode Tas</td>
                                            <td> : </td>
                                            <td> <input type="text" name="kd_barang" placeholder="Kode Barang"> </td>
                                        </tr>
                                        <tr>
                                            <td> Masukan Nama Tas</td>
                                            <td> : </td>
                                            <td> <input type="text" name="nama_barang" placeholder="Nama Tas"> </td>
                                        </tr>
                                        <tr>
                                            <td> Masukan Harga Tas</td>
                                            <td> : </td>
                                            <td> <input type="text" name="harga_barang" placeholder="Harga Tas"> </td>
                                        </tr>
                                        <tr>
                                            <td> Masukan Stok Tas</td>
                                            <td> : </td>
                                            <td> <input type="text" name="stok_barang" placeholder="Stok Tas"> </td>
                                        </tr>
                                        <tr>
                                            <td> Masukan Gambar Tas</td>
                                            <td> : </td>
                                            <td> <input type="file" name="gambar_barang" id="gambar_barang" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td> Masukan Kategori Tas</td>
                                            <td> : </td>
                                            <td>
                                                <select name="kategori" value="Kategori">
                                                    <option value="">Silahkan Pilih Kategori</option>
                                                    <option value="Unisex">Unisex</option>
                                                    <option value="Pria">Pria</option>
                                                    <option value="Wanita">Wanita</option>
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