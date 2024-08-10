<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Tas</h1>
        </div>
        <div class="float-right">
            <?php if ($this->session->userdata('role') == 'admin') : ?>
                <a href="<?php echo base_url('tas/export_to_excel'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Excel</a>
                <a href="<?= base_url('tas/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
            <?php endif ?>
        </div>
    </div>
    <hr>


    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header">
            <strong>Daftar Tas</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Gambar Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barang as $tas) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?php echo $tas->kd_barang; ?></td>
                                <td>
                                    <img src="<?= base_url('assets/img/upload/' . $tas->gambar_barang); ?>" alt="<?= $tas->nama_barang; ?>" width="100">
                                </td>
                                <td><?php echo $tas->nama_barang; ?></td>
                                <td>Rp. <?php echo $tas->harga_barang; ?></td>
                                <td><?php echo $tas->stok_barang; ?></td>
                                <td><?php echo $tas->kategori; ?></td>
                                <td>
                                    <a href="<?= base_url('tas/editdata/' . $tas->kd_barang) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('tas/do_delete/' . $tas->kd_barang) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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