<?php

include 'config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM kegiatan WHERE id='$id'"
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

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        body{
            background:#f4f7fe;
            font-family:'Poppins', sans-serif;
        }

        .detail-section{
            padding:120px 0;
        }

        .detail-card{
            background:white;

            border-radius:30px;

            overflow:hidden;

            box-shadow:
            0 10px 40px rgba(0,0,0,0.08);
        }

        .detail-img{
            width:100%;

            height:500px;

            object-fit:cover;
        }

        .detail-content{
            padding:40px;
        }

        .detail-content small{
            color:#777;

            font-size:15px;
        }

        .detail-content h1{
            font-size:42px;

            font-weight:700;

            color:#001F54;

            margin:20px 0;
        }

        .detail-content p{
            font-size:18px;

            line-height:2;

            color:#555;
        }

        .btn-back{
            background:#001F54;

            color:white;

            padding:12px 30px;

            border-radius:50px;

            text-decoration:none;

            transition:0.3s;
        }

        .btn-back:hover{
            background:#00308F;

            color:white;
        }

        @media(max-width:768px){

            .detail-img{
                height:280px;
            }

            .detail-content{
                padding:25px;
            }

            .detail-content h1{
                font-size:28px;
            }

        }

    </style>

</head>
<body>

<!-- DETAIL -->
<section class="detail-section">

    <div class="container">

        <div class="detail-card">

            <!-- FOTO -->
            <img
                src="assets/upload/kegiatan/<?php echo $data['gambar']; ?>"
                class="detail-img"
            >

            <!-- CONTENT -->
            <div class="detail-content">

                <small>

                    <i class="fa-solid fa-calendar-days"></i>

                    <?php echo $data['tanggal']; ?>

                </small>

                <h1>
                    <?php echo $data['judul']; ?>
                </h1>

                <p>
                    <?php echo $data['deskripsi']; ?>
                </p>

                <!-- BUTTON -->
                <a 
                    href="index.php#kegiatan"
                    class="btn-back mt-3 d-inline-block">

                    ← Kembali

                </a>

            </div>

        </div>

    </div>

</section>

</body>
</html>