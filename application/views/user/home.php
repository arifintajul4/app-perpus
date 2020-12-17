<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <h4>Selamat datang!</h4>
            </div>
        </div>
    </div>
    <h3 style="margin-top:0">Buku Terbaru</h3>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <?php foreach ($buku as $bk) : ?>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header bg-black" style="background-image: url(<?= base_url('assets/img/buku/'.$bk['sampul']) ?>); background-size:cover; height:350px;">
                    </div>
                    <div class="box-footer" style="padding-top: 10px;">
                        <h3 style="margin-top:0"><?= $bk['judul_buku'] ?></h3>
                        <p>Tahun Terbit: <?= $bk['tahun_terbit'] ?> -  <?= $bk['jumlah'] ?> Lembar</p>
                        <button data-id="<?= $bk['id'] ?>" class="btn btn-sm btn-primary detail" data-toggle="modal" data-target="#modal-default" style="margin-top: 10px;">lihat detail</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (count($buku) <= 0) : ?>
            <div class="col-sm-12 text-center">
                <img src="<?= base_url('assets/dist/img/post.svg'); ?>" class="img-fluid" height="250px">
                <h3><b>Belum ada buku!</b></h3>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- /.content -->