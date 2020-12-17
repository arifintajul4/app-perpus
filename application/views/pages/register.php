
<div class="row" style="margin-top:50px">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h3>Register Page</h3>
        <?= $this->session->flashdata('message'); ?>
        <div class="box">
            <div class="box-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama_siswa">Nama Lengkap</label>
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
                        <label for="password">Konfirmasi Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary pull-right btn-flat">Sign In</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>