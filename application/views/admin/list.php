<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Kelola Admin
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Master</li>
        <li class="active">Admin</li>
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
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($admin as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['nama_lengkap'] ?></td>
                                    <td><?= ($row['status']=='1')?'Admin':'Kepala Perpustakaan' ?></td>
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
                <h4 class="modal-title">Tambah Admin</h4>
            </div>
            <form id="form" action="<?= base_url('admin/add') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small class="text-warning">*Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="form-group">
                        <label for="konfir-pass">Konfirmasi Password</label>
                        <input type="password" name="konfir-pass" id="konfir-pass" class="form-control">
                        <small class="text-warning">*Kosongkan jika tidak ingin mengubah password</small>
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
            $('.modal-title').html('Tambah Admin');
            $('#form').attr('action', '<?= base_url('admin/add') ?>');
            $('#username').attr('readonly', false);
            $('#password').attr('required', true);
            $('#konfir-pass').attr('required', true);
            $('#username').val('');
            $('#nama_lengkap').val('');
            $('#password').val('');
            $('#konfir-pass').val('');
            $('.text-warning').fadeOut();
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $('.modal-title').html('Edit Data Admin');
            $('#form').attr('action', '<?= base_url('admin/update/') ?>' + id);
            $('#username').attr('readonly', true);
            $('#password').attr('required', false);
            $('#konfir-pass').attr('required', false);
            $.ajax({
                url: '<?= base_url('admin/getdata/'); ?>'+id,
                method: 'POST',
                dataType: 'JSON',
                data: {id: id },
                success: function(data) {
                    $('#username').val(data.username);
                    $('#nama_lengkap').val(data.nama_lengkap);
                    $('#password').val('');
                    $('#konfir-pass').val('');
                    $('.text-warning').fadeIn();
                }
            })
        });

    });
</script>