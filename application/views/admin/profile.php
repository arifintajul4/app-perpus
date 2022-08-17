<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Profil Admin
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Profil</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="rcontainer">
    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-4 text-center">
            <img width="100" height="100" src="<?= base_url('assets/img/avatar.jpg') ?>" class="img-circle" alt="User Image">
            <h3><?= $admin['nama_lengkap'] ?></h3>
          </div>
          <div class="col-md-8">
            <div class="box-body">
              <form action="<?= base_url('/admin/update_profile/' . $admin['id']) ?>" method="POST">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" value="<?= $admin['username'] ?>" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="nama_lengkap">Nama Lengkap</label>
                  <input type="text" value="<?= $admin['nama_lengkap'] ?>" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
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
                <button class="btn btn-primary mr-10" name="submit" type="submit">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->