<div class="row">
    <div class="col">
        <h3>Riwayat Peminjaman</h3>
        <div class="box">
            <div class="box-body">
                <table id="dataTable" class="table display responsive nowrap" style="width:100%">
                    <thead class="bg-primary">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Denda</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($transaksi as $trx) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $trx['judul_buku'] ?></td>
                                <td><?= date('d-M-Y', strtotime($trx['tgl_pinjam'])) ?></td>
                                <td><?= ($trx['tgl_kembali']!==null)?date('d-M-Y', strtotime($trx['tgl_kembali'])):'-' ?></td>
                                <td><?= 'Rp.'.number_format($trx['denda']) ?></td>
                                <td class="text-center">
                                    <?php if($trx['tgl_kembali'] !== null): ?>
                                        <a href="<?= base_url('laporan/laporanuser/'.$trx['id']) ?>" target="_blank" class="btn btn-sm btn-success">Cetak</a>
                                    <?php else: ?>
                                        <a href="#" class="btn btn-sm btn-success disabled">Cetak</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>