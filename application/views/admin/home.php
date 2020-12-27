<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah<br>Buku</span>
                    <span class="info-box-number"><?= $jml_buku ?></span>
                    <a href="<?= base_url('buku') ?>">lihat selengkapnya ></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Jumlah<br>Denda</span>
                    <span class="info-box-number"><?= $denda==null?'Rp.0':'Rp.'.number_format($denda) ?></span>
                    <a href="<?= base_url('kategori') ?>">lihat selengkapnya ></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Jumlah<br>Peminjaman</span>
                    <span class="info-box-number"><?= $pinjam ?></span>
                    <a href="<?= base_url('peminjaman') ?>">lihat selengkapnya ></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Jumlah<br>Pengembalian</span>
                    <span class="info-box-number"><?= $kembali ?></span>
                    <a href="<?= base_url('pengembalian') ?>">lihat selengkapnya ></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        
        
    </div>
	<?php if($this->session->userdata('hak_akses')=='admin'): ?>
    <!-- /.row -->
    <h3>Data Transaksi Terkini</h3>
    <div class="row ">
       	<div class="col-xs-12">
           	<div class="box">
               	<div class="box-body">
					<button class="btn btn-primary" style="margin-bottom:10px;" data-toggle="modal" data-target="#add-data"><i class="fa fa-plus"></i> Tambah Data</button>
					<?= $this->session->flashdata('message'); ?>
                    <table  id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-primary">
                            <tr>
                                <td>No</td>
								<td>No Reg</td>
                                <td>Nama Peminjam</td>
                                <td>Judul Buku</td>
                                <td>Tgl Pinjam</td>
                                <td>Tgl Kembali</td>
                                <td>Status</td>
                                <td>Denda</td>
                                <td class="text-center">Action</td>
                            </tr>
                        </thead>
                        <tbody>
							<?php
								$i=1;
								foreach($transaksi as $trx):
							?>
                            <tr>
                                <td><?= $i++ ?></td>
								<td><?= $trx['no_reg'] ?></td>
                                <td><?= $trx['nama_siswa'] ?></td>
                                <td><?= $trx['judul_buku'] ?></td>
                                <td><?= date('d-M-Y', strtotime($trx['tgl_pinjam'])) ?></td>
                                <td><?= ($trx['tgl_kembali']=='')?'-':date('d-M-Y', strtotime($trx['tgl_kembali'])) ?></td>
                                <td><?= ($trx['tgl_kembali']=='')?'OnGoing':'Selesai' ?></td>
                                <td><?= ($trx['denda']=='')?'':'Rp.'.number_format($trx['denda']) ?></td>
                                <td class="text-center">
									<?php if($trx['tgl_kembali']==''): ?>
										<button class="btn btn-sm btn-warning kembali" data-id="<?= $trx['id'] ?>" data-toggle="modal" data-target="#modal-kembali">Kembali</button>
									<?php else: ?>
										<button class="btn btn-sm btn-secondary" disabled>Kembali</button>
									<?php endif; ?>
                                    <a href="<?= base_url('transaksi/hapus/'.$trx['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')">Hapus</a>
                                </td>
                            </tr>
							<?php endforeach; ?>
                        </tbody>
                    </table>
               	</div>
           	</div>
       	</div>
    </div>
	<?php endif; ?>									
</section>
<!-- /.content -->

<div class="modal fade" id="add-data">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Tambah Data</h4>
		</div>
		<form action="<?= base_url('transaksi/peminjaman') ?>" method="POST" role="form">
			<div class="modal-body">
				<div class="form-group">
					<label for="no_reg">No Registrasi</label>
					<input type="text" class="form-control" id="no_reg" name="no_reg" readonly required>
				</div>
				<div class="form-group">
					<label for="nama_user">Nama Peminjam</label>
					<input type="text" class="form-control" id="nama_user" name="nama_user" required>
				</div>
				<div class="form-group">
					<label for="kd_buku">Kode Buku</label>
					<input type="text" class="form-control" id="kd_buku" name="kd_buku" readonly required>
				</div>
				<div class="form-group">
					<label for="judul_buku">Judul Buku</label>
					<input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
				</div>
				<div class="form-group">
					<label for="tgl_pinjam">Tanggal Pinjam</label>
					<input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= date('Y-m-d') ?>" required>
					<small class="text-danger">
						*durasi peminjaman maksimal 7 hari, lebih dari itu akan dikenakan denda
					</small>
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
					<input type="date" class="form-control" id="tgl_kembali" value="<?= date('Y-m-d') ?>" name="tgl_kembali" readonly required>
					<small class="text-warning">
						*durasi peminjaman maksimal 7 hari, lebih dari itu akan dikenakan denda
					</small>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Rp.</span>
					<input type="text" class="form-control" id="denda" name="denda" readonly>
              	</div>
				<small  class="text-danger">*Telat <span id="jml-hari">0</span> hari</small>
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

<script type="text/javascript">
	$(document).ready(function(){

		function jmlhari(a, b){
			let hari = 86400000; // format perhitungan dalam 1 hari
			let tgl_1 = new Date(a);
			let tgl_2 = new Date(b);
			return Math.round(Math.round((tgl_2.getTime() - tgl_1.getTime())/hari));
      	}

		$( "#nama_user" ).autocomplete({
			source: "<?php echo site_url('admin/get_siswa/?');?>",
			select: function (event, ui) {
				$('#no_reg').val(ui.item.no_reg);
			}
		});

		$( "#judul_buku" ).autocomplete({
			source: "<?php echo site_url('admin/get_buku/?');?>",
			select: function (event, ui) {
				$('#kd_buku').val(ui.item.kd_buku);
			}
		});

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
					let tgl_kembali = $('#tgl_kembali').val();
					let jml_hari = jmlhari(res.tgl_pinjam, tgl_kembali);
					if(jml_hari > 7){
						let denda = (jml_hari-7)*1000;
						$('#jml-hari').html(jml_hari-7);
						$('#denda').val(denda);
					}
				}
			})
		});
	});
</script>