<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Transaksi Peminjaman
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Transaksi</a></li>
        <li class="active">Peminjaman</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="box" style="margin-top: 10px;">
                <div class="box-body">
                    <table id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
								<th>No Reg</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Denda</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($transaksi as $trx) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $trx['no_reg'] ?></td>
                                    <td><?= $trx['nama_siswa'] ?></td>
                                    <td><?= $trx['judul_buku'] ?></td>
                                    <td><?= date('d-M-Y', strtotime($trx['tgl_pinjam'])) ?></td>
                                    <td><?= date('d-M-Y', strtotime($trx['tgl_kembali'])) ?></td>
                                    <td><?= 'Rp.'.number_format($trx['denda']) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('laporan/kembali/'.$trx['id']) ?>" target="_blank" class="btn btn-sm btn-success">Cetak</a>
                                        <a href="<?= base_url('transaksi/hapus/'.$trx['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
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