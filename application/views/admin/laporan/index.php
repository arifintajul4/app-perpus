<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kelola Laporan
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('message'); ?>
            <button id="addLaporan" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">+ Tambah Data</button>
            <div class="box" style="margin-top: 10px;">
                <div class="box-body">
                    <table id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-primary">
                            <tr>
                                <th>#</th>
                                <th>Tgl Pembuatan</th>
                                <th>Judul Laporan</th>
                                <th>Jenis Laporan</th>
                                <th>Tgl Awal</th>
                                <th>Tgl Akhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($laporan as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['tgl_buat'] ?></td>
                                    <td><?= $row['judul_laporan'] ?></td>
                                    <td><?= $row['jenis'] ?></td>
                                    <td><?= $row['tgl_awal'] ?></td>
                                    <td><?= $row['tgl_akhir'] ?></td>
                                    <td class="text-center">
                                        <a target="_blank" href="<?= base_url('assets/file/laporan/'.$row['judul_laporan']) ?>.pdf" class="btn btn-sm btn-success"><i class="fa fa-print"></i></a>
                                        <a href="<?= base_url('laporan/delete/' . $row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Buat Laporan</h4>
            </div>
            <form id="form" action="<?= base_url('laporan/buat') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tgl_buat">Tanggal Pembuatan</label>
                        <input type="date" name="tgl_buat" id="tgl_buat" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="judul_laporan">Judul Laporan</label>
                        <input type="text" name="judul_laporan" id="judul_laporan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Transaksi</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="semua">Semua</option>
                            <option value="pinjam">Peminjaman</option>
                            <option value="kembali">Pengembalian</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_awal">Tanggal Awal</label>
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
                        <small>*kosongkan untuk cetak semua data</small>
                    </div>
                    <div class="form-group">
                        <label for="tgl_akhir">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
                        <small>*kosongkan untuk cetak semua data</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->