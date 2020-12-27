<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?> | App Perpustakaan</title>
    <link rel="shortcut icon" href="<?= base_url('assets/dist/img/logo.png') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/dist/img/logo.png') ?>" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/skins/_all-skins.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="<?= base_url(); ?>" class="navbar-brand" style="margin-left: 0">App Perpus</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="<?= ($title == 'Home') ? 'active' : '' ?>"><a href="<?= base_url('/') ?>">Home</a></li>
                            <li class="<?= ($title == 'Buku') ? 'active' : '' ?>"><a href="<?= base_url('page/buku') ?>">Buku</a></li>
                            <?php if (isset($_SESSION['isLogin'])) : ?>
                            <li class="<?= ($title == 'History') ? 'active' : '' ?>"><a href="<?= base_url('page/history') ?>">Riwayat</a></li>
                            <?php endif; ?>
                            <li class="<?= ($title == 'Tentang') ? 'active' : '' ?>"><a href="<?= base_url('page/tentang') ?>">Tentang</a></li>
                            <li class="<?= ($title == 'Kontak') ? 'active' : '' ?>"><a href="<?= base_url('page/kontak') ?>">Kontak Kami</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <?php if (isset($_SESSION['isLogin'])) : ?>
                                <!-- User Account Menu -->
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?= base_url('assets/img/avatar.jpg') ?>" class="user-image" alt="User Image">
                                        <span class="hidden-xs"><?= $this->session->userdata('nama') ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header">
                                            <img src="<?= base_url('assets/img/avatar.jpg ') ?>" class="img-circle" alt="User Image">
                                            <p><?= $this->session->userdata('nama') ?></p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="<?= base_url('user/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?= base_url('auth/logout') ?>" onclick="return confirm('apakah anda yakin?')" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>

                                    </ul>
                                </li>
                            <?php else : ?>
                                <li class="<?= ($title == 'Login') ? 'active' : '' ?>"><a href="<?= base_url('page/login') ?>">Login</a></li>
                                <li class="<?= ($title == 'Register') ? 'active' : '' ?>"><a href="<?= base_url('page/register') ?>">Register</a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <?= $contents; ?>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2020-2021 <a href="">SMP N 1 KEMPO</a>.</strong> All rights
                reserved.
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail Buku</h4>
                </div>
                <form id="form" action="" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img id="sampul" width="200" height="350" src="" alt="foto sampul buku">
                        </div>
                        <div class="col-md-7">
                            <table class="table table-striped">
                                <tr>
                                    <td>Judul Buku</td>
                                    <td id="judul_buku"></td>
                                </tr>
                                <tr>
                                    <td>Penerbit</td>
                                    <td id="penerbit"></td>
                                </tr>
                                <tr>
                                    <td>Pengarang</td>
                                    <td id="pengarang"></td>
                                </tr>
                                <tr>
                                    <td>Tahun Terbit</td>
                                    <td id="tahun_terbit"></td>
                                </tr>
                                <tr>
                                    <td>Nomor Rak</td>
                                    <td id="nomor_rak"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td id="jumlah"></td>
                                </tr>
                            </table>
                            <?php if(!$this->session->userdata('isLogin')):?>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
                                    Silahkan login terlebih dahulu agar dapat melakukan peminjaman buku
                                </div>
                            <?php else: ?>
                            <div class="form-group">
                                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                                <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
                                <small class="text-danger">*maksimal waktu peminjaman adalah 7 hari</small><br>
                                <small class="text-danger">*jika lebih dari itu akan dikenakan denda Rp.1.000/Hari</small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" <?= (!$this->session->userdata('isLogin'))?'disabled':'' ?> name="submit" class="btn btn-primary"  onclick="return confirm('apakah anda yakin?')">Pinjam</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.detail', function() {
                let id = $(this).data('id');
                $('#form').attr('action', "<?= base_url('transaksi/userpinjam/') ?>"+id)
                console.log(id);
                $.ajax({
                    url: '<?= base_url('buku/getdata/'); ?>'+id,
                    method: 'POST',
                    dataType: 'JSON',
                    data: {id: id },
                    success: function(data) {
                        console.log(data);
                        $('#sampul').attr('src', "<?= base_url('assets/img/buku/') ?>"+data.sampul)
                        $('#judul_buku').html(": "+data.judul_buku);
                        $('#pengarang').html(": "+data.pengarang);
                        $('#penerbit').html(": "+data.penerbit);
                        $('#tahun_terbit').html(": "+data.tahun_terbit);
                        $('#nomor_rak').html(": "+data.nomor_rak);
                        $('#jumlah').html(": "+data.jumlah);
                    }
                })
            });
        });
    </script>
</body>

</html>