<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kelola Data Siswa
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li class="active">Siswa</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->session->flashdata('message'); ?>
            <button id="addBuku" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">+ Tambah Data</button>
            <div class="box" style="margin-top: 10px;">
                <div class="box-body">
                    <table id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-primary">
                            <tr>
                                <th>#</th>
                                <th>No Registrasi</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($siswa as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['no_reg'] ?></td>
                                    <td><?= $row['nama_siswa'] ?></td>
                                    <td><?= ($row['jenis_kelamin']=='L')?'Laki-laki':'Perempuan' ?></td>
                                    <td><?= $row['kelas'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning edit" data-toggle="modal" data-target="#modal-default" data-id="<?= $row['id']; ?>"><i class="fa fa-edit"></i></button>
                                        <a href="<?= base_url('siswa/delete/' . $row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i></a>
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
                <h4 class="modal-title">Tambah Data Siswa</h4>
            </div>
            <form id="form" action="<?= base_url('siswa/add') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_reg">No Registrasi</label>
                        <input type="text" name="no_reg" id="no_reg" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_siswa">Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control" required>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="konfir-pass">Konfirmasi Password</label>
                        <input type="password" name="konfir-pass" id="konfir-pass" class="form-control" required>
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
            $('.modal-title').html('Tambah Data Siswa');
            $('#form').attr('action', '<?= base_url('siswa/add') ?>');
            $('#no_reg').attr('readonly', false);
            $('#no_reg').val('');
            $('#nama_siswa').val('');
            $('#jenis_kelamin').val('');
            $('#kelas').val('');
            $('#password').val('');
            $('#konfir-pass').val('');
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $('.modal-title').html('Edit Data Siswa');
            $('#form').attr('action', '<?= base_url('buku/update/') ?>' + id);
            $('#no_reg').attr('readonly', true);
            $.ajax({
                url: '<?= base_url('siswa/getdata/'); ?>'+id,
                method: 'POST',
                dataType: 'JSON',
                data: {id: id },
                success: function(data) {
                    $('#no_reg').val(data.no_reg);
                    $('#nama_siswa').val(data.nama_siswa);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#kelas').val(data.kelas);
                    $('#password').val('');
                    $('#konfir-pass').val('');
                }
            })
        });

    });
</script>