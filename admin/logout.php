<?php
session_start();

// Mengosongkan semua variabel sesi
session_unset();

// Menghancurkan sesi
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - GENBI</title>
    
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- SWEETALERT2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f7fe;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Latar belakang jika mode gelap aktif di localStorage */
        body.dark-mode {
            background: #0f172a;
        }
    </style>
</head>
<body>

    <!-- SWEETALERT2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Mengecek apakah user sedang menggunakan dark mode
        const isDark = localStorage.getItem('darkMode') === 'enabled';
        
        if (isDark) {
            document.body.classList.add('dark-mode');
        }

        // Menampilkan SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Logout!',
            text: 'Sampai jumpa kembali, Admin.',
            showConfirmButton: false,
            timer: 1500, // Durasi animasi 1.5 detik
            timerProgressBar: true,
            background: isDark ? '#1e293b' : '#ffffff',
            color: isDark ? '#ffffff' : '#1e293b',
            borderRadius: '20px'
        }).then(() => {
            // Redirect ke halaman utama setelah alert selesai
            window.location.href = '../index.php';
        });
    </script>

</body>
</html>