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
                    <span class="info-box-number"></span>
                    <a href="<?= base_url('buku') ?>">lihat selengkapnya ></a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Jumlah<br>Kategori</span>
                    <span class="info-box-number"></span>
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
                    <span class="info-box-number"></span>
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
                    <span class="info-box-number"></span>
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
    <!-- /.row -->
    <h3>Data Transaksi Terkini</h3>
    <div class="row ">
       <div class="col-xs-12">
           <div class="box">
               <div class="box-body">
                    <table  id="dataTable" class="table display responsive nowrap" style="width:100%">
                        <thead class="bg-primary">
                            <tr>
                                <td>No</td>
                                <td>Nama Peminjam</td>
                                <td>Tgl Pinjam</td>
                                <td>Tgl Kembali</td>
                                <td>Status</td>
                                <td>Denda</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tajul</td>
                                <td>12 Agustus 1945</td>
                                <td>-</td>
                                <td>OnGoing</td>
                                <td>-</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-warning">Kembali</a>
                                    <a href="" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                             <tr>
                                <td>2</td>
                                <td>Ahmad</td>
                                <td>13 Agustus 1945</td>
                                <td>23 Agustus 1945</td>
                                <td>Selesai</td>
                                <td>-</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-warning disabled">Kembali</a>
                                    <a href="" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </div>
           </div>
       </div>
    </div>

</section>
<!-- /.content -->