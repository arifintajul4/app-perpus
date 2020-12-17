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
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning kembali" data-id="<?= $trx['id'] ?>" data-toggle="modal" data-target="#modal-kembali">kembali</button>
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

<div class="modal fade" id="modal-kembali">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Pengembalian Buku</h4>
		</div>
		<form id="form-kembali" action="" method="POST" role="form">
			<div class="modal-body">
				<div class="form-group">
					<label for="no_reg2">No Registrasi</label>
					<input type="text" class="form-control" id="no_reg2" name="no_reg2" readonly required>
				</div>
				<div class="form-group">
					<label for="nama_user2">Nama Peminjam</label>
					<input type="text" class="form-control" id="nama_user2" name="nama_user2" readonly required>
				</div>
				<div class="form-group">
					<label for="kd_buku2">Kode Buku</label>
					<input type="text" class="form-control" id="kd_buku2" name="kd_buku2" readonly required>
				</div>
				<div class="form-group">
					<label for="judul_buku2">Judul Buku</label>
					<input type="text" class="form-control" id="judul_buku2" name="judul_buku2" readonly required>
				</div>
				<div class="form-group">
					<label for="tgl_pinjam2">Tanggal Pinjam</label>
					<input type="date" class="form-control" id="tgl_pinjam2" name="tgl_pinjam2" readonly required>
				</div>
				<div class="form-group">
					<label for="tgl_kembali">Tanggal kembali</label>
					<input type="date" class="form-control" id="tgl_kembali" value="<?= date('Y-m-d') ?>" name="tgl_kembali" required>
					<small class="text-warning">
						*durasi peminjaman maksimal 7 hari, lebih dari itu akan dikenakan denda
					</small>
				</div>
				<div class="form-group">
					<label for="denda">Denda</label>
					<input type="number" class="form-control" id="denda" name="denda" >
					<small  class="text-danger">*Telat 0 hari</small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
	<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
$(document).ready(function(){
    $(document).on('click', '.kembali', function(){
        let id = $(this).data('id');
        $('#form-kembali').attr('action', "<?php echo site_url('transaksi/pengembalian/');?>"+id);
        $.ajax({
            url: "<?php echo site_url('transaksi/getdata/');?>"+id,
            method:'GET',
            dataType:'JSON',
            data: {id: id},
            success: function(res){
                $("#no_reg2").val(res.no_reg);
                $("#nama_user2").val(res.nama_siswa);
                $("#kd_buku2").val(res.kd_buku);
                $("#judul_buku2").val(res.judul_buku);
                $("#tgl_pinjam2").val(res.tgl_pinjam);
            }
        })
    });
})

</script>