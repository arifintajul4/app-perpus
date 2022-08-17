<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="rcontainer">
    <div class="box box-default">
      <div class="box-body">
        <?= $this->session->flashdata('message'); ?>
        <div class="row">
          <div class="col-md-4 text-center">
            <img style="object-fit: cover;" width="100" height="100" src="<?= base_url($siswa['foto'] ? 'assets/img/profile/' . $siswa['foto'] : 'assets/img/avatar.jpg') ?>" class="img-circle" alt="User Image">
            <h3><?= $siswa['nama_siswa'] ?></h3>
          </div>
          <div class="col-md-8">
            <div class="box-body">
              <form action="<?= base_url('/user/update') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="foto">Foto Profil</label>
                  <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                  <small class="text-warning">*Kosongkan jika tidak ingin mengubah Foto</small>
                </div>
                <div class="form-group">
                  <label for="no_reg">No Registration</label>
                  <input readonly type="text" value="<?= $siswa['no_reg'] ?>" name="no_reg" id="no_reg" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="nama_siswa">Nama Lengkap</label>
                  <input type="text" value="<?= $siswa['nama_siswa'] ?>" name="nama_siswa" id="nama_siswa" class="form-control" required>
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
                <div class="d-flex justify-content-end">
                  <button class="btn btn-primary mr-10" type="submit">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->