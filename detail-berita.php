<?php

include 'config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
    "SELECT * FROM berita WHERE id='$id'"
);

$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $data['judul']; ?>
    </title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONT -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body{
            background:#f4f7fe;
            font-family:Poppins;
        }

        .detail-section{
            padding:120px 0;
        }

        .detail-card{
            background:white;

            border-radius:25px;

            overflow:hidden;

            box-shadow:
            0 10px 30px rgba(0,0,0,0.08);
        }

        .detail-img{
            width:100%;
            height:500px;

            object-fit:cover;
        }

        .detail-content{
            padding:40px;
        }

        .detail-content h1{
            font-size:40px;
            font-weight:700;

            color:#001F54;

            margin-bottom:20px;
        }

        .tanggal{
            color:#777;

            margin-bottom:30px;
        }

        .isi{
            line-height:2;
            color:#444;

            font-size:17px;
        }

        .gambar-isi{

            width:100%;

            max-width:750px;

            display:block;

            margin:30px auto;

            border-radius:20px;

            object-fit:cover;

            box-shadow:
            0 10px 25px rgba(0,0,0,0.08);

        }

    </style>

</head>
<body>

<section class="detail-section">

    <div class="container">

        <div class="detail-card">

            <!-- GAMBAR COVER -->
            <img 
                src="assets/upload/<?php echo $data['gambar']; ?>"
                class="detail-img"
            >

            <div class="detail-content">

                <!-- JUDUL -->
                <h1>
                    <?php echo $data['judul']; ?>
                </h1>

                <!-- TANGGAL -->
                <div class="tanggal">

                    <i class="fa fa-calendar"></i>

                    <?php echo $data['tanggal']; ?>

                </div>

                <!-- DESKRIPSI ATAS -->
                <div class="isi">

                    <?php echo nl2br($data['deskripsi_atas']); ?>

                </div>

                <!-- GAMBAR DI TENGAH -->
                <?php if(!empty($data['gambar_isi'])){ ?>

                    <img
                        src="assets/upload/<?php echo $data['gambar_isi']; ?>"
                        class="gambar-isi"
                        alt="Gambar Isi Berita">

                <?php } ?>

                <!-- DESKRIPSI BAWAH -->
                <div class="isi mt-4">

                    <?php echo nl2br($data['deskripsi_bawah']); ?>

                </div>

                <!-- BUTTON -->
                <a href="index.php#berita" class="btn btn-primary mt-4">

                    ← Kembali

                </a>

            </div>

        </div>

    </div>

</section>

</body>
</html>