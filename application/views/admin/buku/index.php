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
                                        <a href="<?= base_url('admin/delete/' . $row['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?')"><i class="fa fa-trash"></i></a>
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
            <form id="form" action="<?= base_url('buku/add') ?>" method="POST">
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
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>  
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>  
                    </div>
                    <div class="form-group pass">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small>*jika kosong password default: <b>admin</b></small>
                        <a href="#" class="pull-right show-password show">Tampil Password</a>
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
        $('#addAdmin').on('click', function() {
            $('.modal-title').html('Tambah Admin');
            $('#form').attr('action', '<?= base_url('admin/add') ?>');
            $('.pass').removeClass('hide');
            $('#username').val('');
            $('#nama_lengkap').val('');
            $('#no_telepon').val('');
            $('#jenis_kelamin').val('');
            $('#email').val('');
            $('#status').val('1');
            $('#password').val('');
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $('.modal-title').html('Edit Data Admin');
            $('#form').attr('action', '<?= base_url('admin/update/') ?>' + id);
            $('.pass').addClass('hide');
            $('#username').attr('readonly', true);
            $.ajax({
                url: '<?= base_url('admin/getdata'); ?>',
                method: 'post',
                dataType: 'JSON',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#username').val(data.username);
                    $('#nama_lengkap').val(data.nama_lengkap);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#email').val(data.email);
                    $('#no_telepon').val(data.no_telepon);
                    $('#status').val(data.status);
                }
            })
        });

    });
</script>