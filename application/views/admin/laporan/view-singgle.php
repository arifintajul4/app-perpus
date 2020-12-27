<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        #customers {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        #customers td, #customers th {
          border: 1px solid black;
          padding: 8px;
        }

        #customers tr:hover {background-color: #ddd;}

        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #ddd;
          color: black;
        }
    </style>
</head>
<body>
    <center><h3><?= $judul_laporan ?></h3></center>
    <table width="100%" id="customers">
        <thead>
            <tr>
                <th>No</th>
                <th>No Reg</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><?= $transaksi['no_reg'] ?></td>
                <td><?= $transaksi['nama_siswa'] ?></td>
                <td><?= $transaksi['judul_buku'] ?></td>
                <td><?= date('d-M-Y', strtotime($transaksi['tgl_pinjam'])) ?></td>
                <td><?= date('d-M-Y', strtotime($transaksi['tgl_kembali'])) ?></td>
                <td><?= 'Rp.'.number_format($transaksi['denda']) ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>