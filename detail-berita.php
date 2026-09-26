<?php
include 'config/koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$query = mysqli_query(
    $conn,
    "SELECT * FROM berita WHERE id='$id'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: index.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| FUNGSI MEMBUAT URL MENJADI LINK
|--------------------------------------------------------------------------
*/
function linkify($text)
{
    if (empty($text)) {
        return '';
    }

    $text = html_entity_decode(
        $text,
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );

    $text = strip_tags($text);

    $text = preg_replace(
        '/\b(?:href|target|rel|class|id|style)\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i',
        '',
        $text
    );

    $text = str_replace(
        ['>', '<'],
        '',
        $text
    );

    $text = htmlspecialchars(
        $text,
        ENT_QUOTES,
        'UTF-8'
    );

    $pattern = '~(https?://[^\s<]+|www\.[^\s<]+)~i';

    $text = preg_replace_callback(
        $pattern,
        function ($matches) {
            $url = $matches[1];

            $ending = '';
            while (
                !empty($url) &&
                preg_match('/[.,!?;:)\\]}]$/', $url)
            ) {
                $ending = substr($url, -1) . $ending;
                $url = substr($url, 0, -1);
            }

            $href = $url;
            if (stripos($url, 'www.') === 0) {
                $href = 'https://' . $url;
            }

            return '<a href="' . $href . '" target="_blank" rel="noopener noreferrer" class="berita-link">' . $url . '</a>' . $ending;
        },
        $text
    );

    return nl2br($text);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['judul']); ?> - GENBI UIN SSC</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #004AAD;
            --secondary: #001F54;
            --bg-color: #f4f7fe;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg-color);
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* =========================
           BACKGROUND DECORATION
        ========================= */
        .bg-shape-1 {
            position: absolute;
            top: -150px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(0,74,173,0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
        
        .bg-shape-2 {
            position: absolute;
            bottom: 100px;
            left: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0,31,84,0.08) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: -1;
        }

        /* =========================
           ANIMATION
        ========================= */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* =========================
           SECTION & CARD
        ========================= */
        .detail-section {
            padding: 60px 0 100px;
            display: flex;
            align-items: center;
        }

        .container-custom {
            max-width: 1000px;
            margin: auto;
        }

        .detail-card {
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            border: 1px solid rgba(0,0,0,0.03);
        }

        /* =========================
           IMAGE COVER WRAPPER
        ========================= */
        .detail-img-wrapper {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
        }

        .detail-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .detail-card:hover .detail-img {
            transform: scale(1.03);
        }

        .detail-img-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 150px;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        }

        /* =========================
           CONTENT AREA
        ========================= */
        .detail-content {
            padding: 50px;
            background: #ffffff;
            position: relative;
            border-radius: 30px 30px 0 0;
            margin-top: -30px; /* Efek menumpuk ke gambar */
            z-index: 2;
        }

        .tanggal-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(0, 74, 173, 0.08);
            color: var(--primary);
            padding: 10px 22px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .detail-content h1 {
            font-size: 40px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 30px;
            line-height: 1.3;
            letter-spacing: -0.5px;
        }

        .isi {
            line-height: 2;
            color: #475569;
            font-size: 17px;
            word-wrap: break-word;
            overflow-wrap: anywhere;
            text-align: justify;
        }

        /* =========================
           LINK DALAM BERITA
        ========================= */
        .berita-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
            transition: .2s;
            word-break: break-word;
        }

        .berita-link:hover {
            color: var(--secondary);
            text-decoration-thickness: 2px;
        }

        /* =========================
           GAMBAR DI DALAM BERITA
        ========================= */
        .gambar-isi {
            width: 100%;
            max-width: 750px;
            display: block;
            margin: 40px auto;
            border-radius: 20px;
            object-fit: cover;
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }

        /* =========================
           BUTTON KEMBALI
        ========================= */
        .btn-kembali {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--secondary);
            color: white;
            border-radius: 50px;
            padding: 15px 35px;
            font-weight: 600;
            font-size: 15px;
            margin-top: 40px;
            border: none;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 31, 84, 0.15);
        }

        .btn-kembali:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0, 74, 173, 0.25);
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media(max-width: 768px){
            .detail-section { padding: 30px 15px; }
            .detail-img-wrapper { height: 300px; }
            .detail-content { padding: 35px 25px; }
            .detail-content h1 { font-size: 28px; }
            .isi { font-size: 16px; line-height: 1.9; }
            .btn-kembali { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

<!-- Dekorasi Background -->
<div class="bg-shape-1"></div>
<div class="bg-shape-2"></div>

<section class="detail-section">
    <div class="container container-custom">
        <div class="detail-card">

            <!-- GAMBAR COVER -->
            <div class="detail-img-wrapper">
                <img src="assets/upload/<?php echo htmlspecialchars($data['gambar']); ?>" 
                     class="detail-img" 
                     alt="<?php echo htmlspecialchars($data['judul']); ?>">
            </div>

            <div class="detail-content">

                <!-- TANGGAL TERBIT -->
                <div class="tanggal-badge">
                    <i class="fa-regular fa-calendar-days"></i>
                    <?php 
                        // Mengubah format tanggal database menjadi format cantik, misal: 20 November 2024
                        echo date('d F Y', strtotime($data['tanggal'])); 
                    ?>
                </div>

                <!-- JUDUL BERITA -->
                <h1><?php echo htmlspecialchars($data['judul']); ?></h1>

                <!-- DESKRIPSI BAGIAN ATAS -->
                <div class="isi">
                    <?php echo linkify($data['deskripsi_atas']); ?>
                </div>

                <!-- GAMBAR TENGAH / ISI (JIKA ADA) -->
                <?php if (!empty($data['gambar_isi'])) { ?>
                    <img src="assets/upload/<?php echo htmlspecialchars($data['gambar_isi']); ?>" 
                         class="gambar-isi" 
                         alt="Gambar Isi Berita">
                <?php } ?>

                <!-- DESKRIPSI BAGIAN BAWAH -->
                <?php if (!empty($data['deskripsi_bawah'])) { ?>
                    <div class="isi mt-4">
                        <?php echo linkify($data['deskripsi_bawah']); ?>
                    </div>
                <?php } ?>

                <!-- TOMBOL KEMBALI -->
                <a href="index.php#berita" class="btn-kembali">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>

            </div>

        </div>
    </div>
</section>

</body>
</html>