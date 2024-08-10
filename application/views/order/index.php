<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 m-0 text-gray-800">Order</h1>
        </div>
        <div class="float-right">
            <?php if ($this->session->userdata('role') == 'admin') : ?>
                <a href="<?= base_url('report') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
                <a href="<?php echo base_url('order/export_to_excel'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Excel</a>
            <?php endif ?>
        </div>
    </div>
    <hr>


    <!-- DataTales Example -->
    <div class="card shadow">
        <div class="card-header">
            <strong>Daftar Order</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?php echo $order->invoice; ?></td>
                                <td><?php echo $order->tanggal; ?></td>
                                <td>Rp. <?php echo number_format($order->total, 0, ',', '.'); ?></td>
                                <td><?php $this->load->view('layouts/_status', ['status' => $order->status]) ?></td>
                                <td>
                                    <a href="<?= base_url('order/detail/' . $order->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('order/do_delete/' . $order->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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