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
        anggota.nim,
        anggota.jurusan,
        anggota.divisi
    FROM absensi
    JOIN anggota
    ON absensi.anggota_id = anggota.id
    WHERE absensi.kegiatan_id='$id'
    ORDER BY absensi.waktu_absen ASC"
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

<table border="0" width="100%">
<tr>
    <td colspan="8" align="center">
        <h2>GENERASI BARU INDONESIA (GENBI)</h2>
        <h3>UIN SYEKH NURJATI CIREBON</h3>
        <h4>LAPORAN ABSENSI KEGIATAN</h4>
    </td>
</tr>
</table>

<hr>

<br>

<table border="0">
<tr>
    <td><b>Nama Kegiatan</b></td>
    <td>: <?php echo $kegiatan['nama_kegiatan']; ?></td>
</tr>

<tr>
    <td><b>Tanggal</b></td>
    <td>: <?php echo date('d F Y', strtotime($kegiatan['tanggal'])); ?></td>
</tr>

<tr>
    <td><b>Total Peserta</b></td>
    <td>: <?php echo $totalPeserta; ?> Orang</td>
</tr>
</table>

<br>

<table border="1" cellspacing="0" cellpadding="6">

<tr style="
background:#0A3278;
color:white;
font-weight:bold;
text-align:center;
">

<th>No</th>
<th>Nama</th>
<th>NIM</th>
<th>Jurusan</th>
<th>Divisi</th>
<th>Pesan & Kesan</th>
<th>Waktu Absen</th>
<th>Status</th>

</tr>

<?php

$no = 1;

mysqli_data_seek($data,0);

while($row = mysqli_fetch_assoc($data)){

?>

<tr>

<td align="center">
<?php echo $no++; ?>
</td>

<td>
<?php echo $row['nama']; ?>
</td>

<td>
<?php echo !empty($row['nim']) ? $row['nim'] : '-'; ?>
</td>

<td>
<?php echo !empty($row['jurusan']) ? $row['jurusan'] : '-'; ?>
</td>

<td>
<?php echo $row['divisi']; ?>
</td>

<td>
<?php echo !empty($row['pesan_kesan']) ? $row['pesan_kesan'] : '-'; ?>
</td>

<td>
<?php echo $row['waktu_absen']; ?>
</td>

<td align="center">

<?php
if($row['status']=="Hadir"){
    echo "Hadir";
}else{
    echo $row['status'];
}
?>

</td>

</tr>

<?php } ?>

</table>

<br><br><br><br>

<table border="0" width="100%">
<tr>

<td width="60%"></td>

<td align="center">

Cirebon,

<?php echo date('d F Y'); ?>

<br><br>

Mengetahui,

<br>

<b>Ketua Umum GENBI UIN SSC</b>

<br><br><br><br><br>

<u><b>Suci Saefiani</b></u>

</td>

</tr>
</table>

</body>
</html>
