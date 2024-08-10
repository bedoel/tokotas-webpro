<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Tas</h1>
        </div>
        <div class="float-right">
            <a href="<?= base_url('tas') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
        </div>
    </div>

    <hr>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Tas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="<?= base_url('tas/updatedata'); ?>" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <?php foreach ($barang as $tas) { ?>
                            <tr>
                                <td> Masukan Kode Barang</td>
                                <td> : </td>
                                <td> <input type="text" name="kd_barang" value="<?php echo $tas->kd_barang; ?>"> </td>
                            </tr>
                            <tr>
                                <td> Masukan Nama Tas</td>
                                <td> : </td>
                                <td> <input type="text" name="nama_barang" value="<?php echo $tas->nama_barang; ?>"> </td>
                            </tr>
                            <tr>
                                <td> Masukan Harga Tas</td>
                                <td> : </td>
                                <td> <input type="text" name="harga_barang" value="<?php echo $tas->harga_barang; ?>"> </td>
                            </tr>
                            <tr>
                                <td> Masukan Stok Tas</td>
                                <td> : </td>
                                <td> <input type="text" name="stok_barang" value="<?php echo $tas->stok_barang; ?>"> </td>
                            </tr>
                            <tr>
                                <td> Masukan Gambar Tas</td>
                                <td> : </td>
                                <td>
                                    <?php
                                    if (isset($tas->gambar_barang)) { ?>

                                        <input type="hidden" name="old_pict" id="old_pict" value="<?= $tas->gambar_barang; ?>">

                                        <picture>
                                            <source srcset="" type="image/svg+xml">
                                            <img src="<?= base_url('assets/img/upload/') . $tas->gambar_barang; ?>" alt="<?= $tas->nama_barang; ?>" width="100">
                                        </picture>

                                    <?php } ?>

                                    <input type="file" name="gambar_barang" id="gambar_barang" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td> Masukan Kategori Tas</td>
                                <td> : </td>
                                <td>
                                    <select name="kategori" value="<?php echo $tas->kategori; ?>">
                                        <option value="<?php echo $tas->kategori; ?>"><?php echo $tas->kategori; ?></option>
                                        <option value="Unisex">Unisex</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>

                            <td colspan="3" align="center">
                                <div class="form-group">
                                    <button type="submit" name="btnsubmit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->