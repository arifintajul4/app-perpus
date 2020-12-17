<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kelola Buku
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li class="active">Buku</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('message'); ?>
            <button id="addBuku" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">+ Tambah Buku</button>
            <div class="box" style="margin-top: 10px;">
                <div class="box-body">
                    <table id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-primary">
                            <tr>
                                <th>#</th>
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Penerbit</th>
                                <th>Pengarang</th>
                                <th>Tahun Terbit</th>
                                <th>Nomor Rak</th>
                                <th>Jumlah</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($buku as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['kd_buku'] ?></td>
                                    <td><?= $row['judul_buku'] ?></td>
                                    <td><?= $row['penerbit'] ?></td>
                                    <td><?= $row['pengarang'] ?></td>
                                    <td><?= $row['tahun_terbit'] ?></td>
                                    <td><?= $row['nomor_rak'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-default" data-id="<?= $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        <a href="<?= base_url('buku/delete/' . $row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i></a>
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
                <h4 class="modal-title">Tambah Buku</h4>
            </div>
            <form id="form" action="<?= base_url('buku/add') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kd_buku">Kode Buku</label>
                        <input type="text" name="kd_buku" id="kd_buku" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="judul_buku">Judul Buku</label>
                        <input type="text" name="judul_buku" id="judul_buku" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sampul">Sampul Buku</label>
                        <input type="file" name="sampul" id="sampul" class="form-control"  accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="number" min="1980" name="tahun_terbit" id="tahun_terbit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor_rak">Nomor Rak</label>
                        <input type="number" min="0" name="nomor_rak" id="nomor_rak" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" min="0" name="jumlah" id="jumlah" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(document).ready(function() {
        $('#addBuku').on('click', function() {
            $('.modal-title').html('Tambah Data Buku');
            $('#form').attr('action', '<?= base_url('buku/add') ?>');
            $('#kd_buku').attr('readonly', false);
            $('#judul_buku').val('');
            $('#sampul').val('');
            $('#sampul').attr('required', true);
            $('#kd_buku').val('');
            $('#pengarang').val('');
            $('#penerbit').val('');
            $('#tahun_terbit').val('');
            $('#nomor_rak').val('');
            $('#jumlah').val('');
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $('.modal-title').html('Edit Data Buku');
            $('#form').attr('action', '<?= base_url('buku/update/') ?>' + id);
            $('#kd_buku').attr('readonly', true);
            $('#sampul').val('');
            $('#sampul').attr('required', false);
            $.ajax({
                url: '<?= base_url('buku/getdata/'); ?>'+id,
                method: 'POST',
                dataType: 'JSON',
                data: {id: id },
                success: function(data) {
                    $('#judul_buku').val(data.judul_buku);
                    $('#kd_buku').val(data.kd_buku);
                    $('#pengarang').val(data.pengarang);
                    $('#penerbit').val(data.penerbit);
                    $('#tahun_terbit').val(data.tahun_terbit);
                    $('#nomor_rak').val(data.nomor_rak);
                    $('#jumlah').val(data.jumlah);
                }
            })
        });

    });
</script>