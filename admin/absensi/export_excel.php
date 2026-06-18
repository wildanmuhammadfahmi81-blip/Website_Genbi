<?php

session_start();

include '../../config/koneksi.php';

$id = $_GET['id'];

$kegiatan = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
        FROM kegiatan_absensi
        WHERE id='$id'"
    )
);

$data = mysqli_query(
    $conn,
    "SELECT
    absensi.*,
    anggota.nama,
    anggota.divisi

    FROM absensi

    JOIN anggota
    ON absensi.anggota_id = anggota.id

    WHERE absensi.kegiatan_id='$id'

    ORDER BY waktu_absen ASC"
);

$totalPeserta = mysqli_num_rows($data);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Absensi_".$kegiatan['nama_kegiatan'].".xls");

?>

<html>
<head>
<meta charset="UTF-8">
</head>

<body>

<table border="0">

<tr>
<td colspan="6" align="center">
<h2>GENBI UIN SSC</h2>
</td>
</tr>

<tr>
<td colspan="6" align="center">
<h3>LAPORAN ABSENSI KEGIATAN</h3>
</td>
</tr>

</table>

<br>

<table border="0">

<tr>
<td><b>Nama Kegiatan</b></td>
<td>: <?php echo $kegiatan['nama_kegiatan']; ?></td>
</tr>

<tr>
<td><b>Tanggal</b></td>
<td>: <?php echo $kegiatan['tanggal']; ?></td>
</tr>

<tr>
<td><b>Total Peserta</b></td>
<td>: <?php echo $totalPeserta; ?> Orang</td>
</tr>

</table>

<br>

<table border="1" cellpadding="8" cellspacing="0">

<tr style="
background:#001F54;
color:white;
font-weight:bold;
text-align:center;
">

<th width="50">No</th>

<th width="250">
Nama
</th>

<th width="180">
Divisi
</th>

<th width="180">
Waktu Absen
</th>

<th width="120">
Status
</th>

<th width="200">
Bukti Foto
</th>

</tr>

<?php

$no = 1;

mysqli_data_seek($data,0);

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td align="center">
<?php echo $no++; ?>
</td>

<td>
<?php echo $row['nama']; ?>
</td>

<td>
<?php echo $row['divisi']; ?>
</td>

<td>
<?php echo $row['waktu_absen']; ?>
</td>

<td align="center">

<?php

if($row['status']=="Hadir"){

echo "✅ Hadir";

}else{

echo $row['status'];

}

?>

</td>

<td>

<?php if(!empty($row['foto'])){ ?>

<a href="http://localhost/genbi/assets/upload_absensi/<?php echo $row['foto']; ?>">

Lihat Foto

</a>

<?php }else{ ?>

Tidak Ada

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

<br><br><br>

<!-- BAGIAN TANDA TANGAN -->
<table border="0">
    <tr>
        <!-- Kolom kosong untuk menggeser tanda tangan ke kanan -->
        <td colspan="4"></td>
        
        <!-- Kolom isi tanda tangan -->
        <td colspan="2" align="center" style="vertical-align: top;">
            Cirebon, <?php echo date('d-m-Y'); ?>
            <br>
            <b>Ketua Umum GenBI UINSSC</b>
            
            <br><br><br><br><br>
            
            <u><b>Suci Saefiani</b></u>
        </td>
    </tr>
</table>

</body>
</html>
