
<div class="row" style="margin-top:50px">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h3>Login Page</h3>
        <?= $this->session->flashdata('message'); ?>
        <div class="box">
            <div class="box-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="no_reg">No Registrasi</label>
                        <input type="text" name="no_reg" id="no_reg" min="0" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" min="0" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary pull-right btn-flat">Sign In</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>