<!-- =========================
FILE : index.php
========================= -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <!-- META -->
    <meta charset="UTF-8">

    <meta 
        name="viewport" 
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        GENBI - Generasi Baru Indonesia
    </title>

    <!-- BOOTSTRAP -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <!-- FONT AWESOME -->
    <link 
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- AOS ANIMATION -->
    <link 
        href="https://unpkg.com/aos@2.3.1/dist/aos.css" 
        rel="stylesheet"
    >

    <!-- GOOGLE FONT -->
    <link 
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" 
        rel="stylesheet"
    >

    <!-- CSS -->
    <link 
        rel="stylesheet" 
        href="assets/css/style.css"
    >

</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(isset($_SESSION['success'])) : ?>

<script>
Swal.fire({
    icon: 'success',
    title: 'Pesan Terkirim!',
    text: '<?php echo $_SESSION['success']; ?>',
    timer: 2500,
    showConfirmButton: false,
    timerProgressBar: true
});
</script>

<?php unset($_SESSION['success']); endif; ?>

    <!-- Navbar -->
    <?php include 'components/navbar.php'; ?>

<!-- HERO SECTION -->
<section class="hero d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6">

                <div class="hero-text" data-aos="fade-right">

                    <h1>
                        GENERASI BARU INDONESIA
                    </h1>

                    <p>
                        Wadah Generasi Muda Penerima Program Bantuan Pendidikan Kebanksentralan Bank Indonesia yang aktif, inovatif, dan berdampak bagi Masyarakat
                    </p>

                    <a href="#about" class="btn btn-genbi">
                        Explore More
                    </a>

                </div>

            </div>

        </div>
    </div>
</section>

    <!-- ABOUT -->
<section class="about section-padding" id="about">

    <div class="container">

        <div class="section-title text-center" data-aos="fade-up">

            <h2>
                Tentang GENBI UIN SSC
            </h2>

            <p>
                Generasi Baru Indonesia (GENBI) UIN Siber Syekh Nurjati Cirebon 
                merupakan komunitas mahasiswa penerima beasiswa Bank Indonesia 
                yang aktif dalam pengembangan karakter, kepemimpinan, 
                pendidikan, sosial masyarakat, dan inovasi generasi muda.
            </p>

        </div>

        <div class="row mt-5">

    <!-- PILAR 1 -->
    <div class="col-lg-4 mb-4" data-aos="zoom-in">

        <div class="about-card">

            <div class="about-icon">
                🌟
            </div>

            <h3>
                Frontliner
            </h3>

            <p>
                Menjadi garda terdepan dalam menyampaikan informasi, nilai, 
                serta kebijakan Bank Indonesia kepada masyarakat secara aktif, 
                komunikatif, dan inspiratif.
            </p>

        </div>

    </div>

    <!-- PILAR 2 -->
    <div class="col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="200">

        <div class="about-card">

            <div class="about-icon">
                🔄
            </div>

            <h3>
                Change Agent
            </h3>

            <p>
                Menjadi agen perubahan yang mampu menghadirkan inovasi, 
                solusi, dan kontribusi nyata bagi lingkungan kampus, 
                masyarakat, dan bangsa.
            </p>

        </div>

    </div>

    <!-- PILAR 3 -->
    <div class="col-lg-4 mb-4" data-aos="zoom-in" data-aos-delay="400">

        <div class="about-card">

            <div class="about-icon">
                🚀
            </div>

            <h3>
                Future Leader
            </h3>

            <p>
                Membentuk generasi pemimpin masa depan yang berintegritas, 
                visioner, berdaya saing, serta siap membawa perubahan positif 
                untuk Indonesia.
            </p>

        </div>

    </div>

</div>

    </div>

</section>

<!-- =====================================================
VISI MISI GENBI
===================================================== -->
<section class="visi-misi-section section-padding" id="visi-misi">

    <div class="container">

        <!-- TITLE -->
        <div class="section-title text-center" data-aos="fade-up">

            <h2>
                Visi & Misi
            </h2>

            <p>
                Menjadi generasi muda yang inspiratif, inovatif, 
                dan berdampak bagi masyarakat serta Indonesia.
            </p>

        </div>

        <div class="row mt-5 align-items-center">

            <!-- =====================================================
            VISI
            ====================================================== -->
            <div class="col-lg-5 mb-4" data-aos="fade-right">

                <div class="visi-card">

                    <div class="visi-icon">
                        🌟
                    </div>

                    <h3>
                        Visi
                    </h3>

                    <p>
                        Menjadikan GENBI UIN SSC sebagai komunitas 
                        generasi muda yang aktif, unggul, kreatif, 
                        dan mampu memberikan kontribusi nyata bagi 
                        masyarakat, lingkungan, dan Indonesia.
                    </p>

                </div>

            </div>

            <!-- =====================================================
            MISI
            ====================================================== -->
            <div class="col-lg-7" data-aos="fade-left">

                <div class="misi-card">

                    <h3>
                        Misi GENBI
                    </h3>

                    <!-- ITEM -->
                    <div class="misi-item">

                        <span>01</span>

                        <p>
                            Mengembangkan potensi mahasiswa melalui 
                            kegiatan kepemimpinan, pendidikan, dan pelatihan.
                        </p>

                    </div>

                    <!-- ITEM -->
                    <div class="misi-item">

                        <span>02</span>

                        <p>
                            Menumbuhkan rasa kepedulian sosial dan 
                            pengabdian kepada masyarakat.
                        </p>

                    </div>

                    <!-- ITEM -->
                    <div class="misi-item">

                        <span>03</span>

                        <p>
                            Mendorong generasi muda untuk aktif, 
                            kreatif, inovatif, dan kolaboratif.
                        </p>

                    </div>

                    <!-- ITEM -->
                    <div class="misi-item">

                        <span>04</span>

                        <p>
                            Menjadi wadah pengembangan karakter dan 
                            semangat kontribusi bagi Indonesia.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- PROGRAM -->
<section class="program section-padding" id="program">

    <div class="container">

        <!-- TITLE -->
        <div class="section-title text-center" data-aos="fade-up">

            <h2>
                Program & Movement GENBI
            </h2>

            <p>
                GENBI UIN SSC hadir melalui berbagai program inspiratif 
                untuk membangun generasi muda yang aktif, kreatif, 
                dan berdampak bagi masyarakat.
            </p>

        </div>

        <!-- PROGRAM LIST -->
        <div class="row mt-5">

            <!-- 1 -->
            <div class="col-lg-4 mb-4">

                <div class="program-card modern-card" data-aos="zoom-in">

                    <div class="program-number">
                        01
                    </div>

                    <h3>
                        GENBI Teaching
                    </h3>

                    <p>
                        Program pengabdian pendidikan untuk meningkatkan 
                        semangat belajar dan literasi masyarakat.
                    </p>

                </div>

            </div>

            <!-- 2 -->
            <div class="col-lg-4 mb-4">

                <div class="program-card modern-card" data-aos="zoom-in" data-aos-delay="150">

                    <div class="program-number">
                        02
                    </div>

                    <h3>
                        Social Action
                    </h3>

                    <p>
                        Aksi sosial, bakti masyarakat, dan kegiatan kemanusiaan 
                        sebagai bentuk kepedulian GENBI terhadap lingkungan sekitar.
                    </p>

                </div>

            </div>

            <!-- 3 -->
            <div class="col-lg-4 mb-4">

                <div class="program-card modern-card" data-aos="zoom-in" data-aos-delay="300">

                    <div class="program-number">
                        03
                    </div>

                    <h3>
                        Leadership Camp
                    </h3>

                    <p>
                        Program pengembangan leadership dan karakter 
                        untuk menciptakan mahasiswa yang visioner.
                    </p>

                </div>

            </div>

            <!-- 4 -->
            <div class="col-lg-4 mb-4">

                <div class="program-card modern-card" data-aos="zoom-in">

                    <div class="program-number">
                        04
                    </div>

                    <h3>
                        Green Movement
                    </h3>

                    <p>
                        Gerakan peduli lingkungan melalui kampanye hijau, 
                        penanaman pohon, dan aksi bersih lingkungan.
                    </p>

                </div>

            </div>

            <!-- 5 -->
            <div class="col-lg-4 mb-4">

                <div class="program-card modern-card" data-aos="zoom-in" data-aos-delay="150">

                    <div class="program-number">
                        05
                    </div>

                    <h3>
                        Creative Media
                    </h3>

                    <p>
                        Media kreatif GENBI dalam menyebarkan informasi, 
                        edukasi, dan inspirasi melalui platform digital.
                    </p>

                </div>

            </div>

            <!-- 6 -->
            <div class="col-lg-4 mb-4">

                <div class="program-card modern-card" data-aos="zoom-in" data-aos-delay="300">

                    <div class="program-number">
                        06
                    </div>

                    <h3>
                        GENBI Collaboration
                    </h3>

                    <p>
                        Kolaborasi dengan berbagai pihak untuk menciptakan 
                        kegiatan yang inovatif dan bermanfaat bagi masyarakat.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

    <!-- =========================
STRUKTUR ORGANISASI
========================= -->
<section class="struktur section-padding" id="struktur">

    <div class="container struktur-container">

        <!-- TITLE -->
        <div class="section-title text-center" data-aos="fade-up">

            <h2>Struktur Kepengurusan</h2>

            <p>
                GENBI UIN SSC Periode 2025
            </p>

        </div>

        <!-- =====================================================
SECTION STRUKTUR ORGANISASI
===================================================== -->
<section class="organization-section py-5">

    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5" data-aos="fade-up">

            <h2 class="main-title">
                Struktur Organisasi
            </h2>

            <p class="main-subtitle">
                Kepengurusan Organisasi Mahasiswa
            </p>

        </div>

<!-- =====================================================
BADAN PENGURUS HARIAN
===================================================== -->
<div class="text-center mb-4">

    <h3 class="division-title">
        Badan Pengurus Harian
    </h3>

</div>

<!-- ================= ROW 1 ================= -->
<div class="row justify-content-center">

    <!-- Ketua -->
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="leader-card" data-aos="zoom-in">

            <img 
                src="assets/image/ketua.jpg"
                class="leader-img"
            >

            <div class="leader-content">

                <h4>
                    Suci Saefiani
                </h4>

                <span>
                    Ketua Umum
                </span>

            </div>

        </div>

    </div>

    <!-- Wakil -->
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="leader-card" data-aos="zoom-in">

            <img 
                src="assets/image/wakil.jpg"
                class="leader-img"
            >

            <div class="leader-content">

                <h4>
                    Muhammad Dhika Nuriadhy
                </h4>

                <span>
                    Wakil Ketua Umum
                </span>

            </div>

        </div>

    </div>

</div>

<!-- ================= ROW 2 ================= -->
<div class="row justify-content-center mt-2">

    <!-- Sekum 1 -->
    <div class="col-lg-3 col-md-6 mb-4">

        <div class="leader-card" data-aos="zoom-in">

            <img 
                src="assets/image/sekum1.jpg"
                class="leader-img"
            >

            <div class="leader-content">

                <h4>
                    Najwa Fauriah
                </h4>

                <span>
                    Sekretaris Umum I
                </span>

            </div>

        </div>

    </div>

    <!-- Sekum 2 -->
    <div class="col-lg-3 col-md-6 mb-4">

        <div class="leader-card" data-aos="zoom-in">

            <img 
                src="assets/image/sekum2.jpg"
                class="leader-img"
            >

            <div class="leader-content">

                <h4>
                    Aulia Chantika S.
                </h4>

                <span>
                    Sekretaris Umum II
                </span>

            </div>

        </div>

    </div>

    <!-- Bendum 1 -->
    <div class="col-lg-3 col-md-6 mb-4">

        <div class="leader-card" data-aos="zoom-in">

            <img 
                src="assets/image/bendum1.jpg"
                class="leader-img"
            >

            <div class="leader-content">

                <h4>
                    Syifa Nurlatifah
                </h4>

                <span>
                    Bendahara Umum I
                </span>

            </div>

        </div>

    </div>

    <!-- Bendum 2 -->
    <div class="col-lg-3 col-md-6 mb-4">

        <div class="leader-card" data-aos="zoom-in">

            <img 
                src="assets/image/bendum2.jpg"
                class="leader-img"
            >

            <div class="leader-content">

                <h4>
                    Ira Yulistin
                </h4>

                <span>
                    Bendahara Umum II
                </span>

            </div>

        </div>

    </div>

</div>

        <!-- =====================================================
        SEMUA DIVISI
        ====================================================== -->
        <div class="row mt-5 justify-content-center">

           <!-- DIVISI PENDIDIKAN -->
<div class="col-lg-4 col-md-6 mb-4">

    <div class="division-card-modern">

        <img 
            src="assets/image/divisi/divisi-pendidikan1.jpg"
            class="division-cover"
        >

        <div class="division-body">

            <h3>
                Divisi Pendidikan
            </h3>

            <button 
                class="btn-modern"
                data-bs-toggle="modal"
                data-bs-target="#pendidikanModal">

                Lihat Anggota

            </button>

        </div>

    </div>

</div>

<!-- =====================================================
            DIVISI KEWIRAUSAHAAN
            ====================================================== -->
            <div class="col-lg-4 col-md-6 mb-4">

    <div class="division-card-modern">

        <img 
            src="assets/image/divisi/divisi-kewirausahaan1.jpg"
            class="division-cover"
        >

        <div class="division-body">

            <h3>
                Divisi Kewirausahaan
            </h3>

            <button 
                class="btn-modern"
                data-bs-toggle="modal"
                data-bs-target="#wirausahaModal">

                Lihat Anggota

            </button>

        </div>

    </div>

</div>

           <!-- =====================================================
DIVISI PENGABDIAN MASYARAKAT
===================================================== -->
<div class="col-lg-4 col-md-6 mb-4">

    <div class="division-card-modern">

        <img 
            src="assets/image/divisi/divisi-pengabdian1.jpg"
            class="division-cover"
        >

        <div class="division-body">

            <h3>
                Divisi Pengabdian Masyarakat
            </h3>

            <button 
                class="btn-modern"
                data-bs-toggle="modal"
                data-bs-target="#pengabdianModal">

                Lihat Anggota

            </button>

        </div>

    </div>

</div>

           <!-- =====================================================
DIVISI LINGKUNGAN HIDUP
===================================================== -->
<div class="col-lg-4 col-md-6 mb-4">

    <div class="division-card-modern">

        <img 
            src="assets/image/divisi/divisi-lingkungan1.jpg"
            class="division-cover"
        >

        <div class="division-body">

            <h3>
                Divisi Lingkungan Hidup
            </h3>

            <button 
                class="btn-modern"
                data-bs-toggle="modal"
                data-bs-target="#lingkunganModal">

                Lihat Anggota

            </button>

        </div>

    </div>

</div>


          <!-- =====================================================
DIVISI PUBLIKASI DAN SOSIALISASI
===================================================== -->
<div class="col-lg-4 col-md-6 mb-4">

    <div class="division-card-modern">

        <img 
            src="assets/image/divisi/divisi-pubsos1.jpg"
            class="division-cover"
        >

        <div class="division-body">

            <h3>
                Divisi Publikasi & Sosialisasi
            </h3>

            <button 
                class="btn-modern"
                data-bs-toggle="modal"
                data-bs-target="#publikasiModal">

                Lihat Anggota

            </button>

        </div>

    </div>

</div>

<!-- MODAL DIVISI PENDIDIKAN -->
<div class="modal fade" id="pendidikanModal">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content custom-modal">

            <div class="modal-header border-0">

                <h3 class="modal-title">
                    Divisi Pendidikan
                </h3>

                <button 
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <!-- KADIV & SEKDIV -->
                <div class="row justify-content-center mb-5">

                    <!-- KADIV -->
                    <div class="col-lg-4">

                        <div class="member-card-premium">

                            <img 
                                src="assets/image/anggota/pendidikan/MEITU_20260602_005506786.jpg"
                                class="member-img"
                            >

                            <h4>
                                Nessa Maulidhyna
                            </h4>

                            <span>
                                Kepala Divisi
                            </span>

                        </div>

                    </div>

                    <!-- SEKDIV -->
                    <div class="col-lg-4">

                        <div class="member-card-premium">

                            <img 
                                src="assets/image/anggota/pendidikan/MEITU_20260602_081756279.jpg"
                                class="member-img"
                            >

                            <h4>
                                Rizki Laeli Ramadhani
                            </h4>

                            <span>
                                Sekretaris Divisi
                            </span>

                        </div>

                    </div>

                </div>

                <!-- ANGGOTA -->
                <div class="row">

                    <!-- ANGGOTA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="anggota-card">
                            <img src="assets/image/anggota/pendidikan/angga.jpg" class="anggota-img">
                            <h5>Angga Putra Mahardika</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="anggota-card">
                            <img src="assets/image/anggota/pendidikan/inggar.jpg" class="anggota-img">
                            <h5>Muhammad Inggar Agus Sholihin</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="anggota-card">
                            <img src="assets/image/anggota/pendidikan/aeni.jpg" class="anggota-img">
                            <h5>Aeni Fadilah</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="anggota-card">
                            <img src="assets/image/anggota/pendidikan/natia.jpg" class="anggota-img">
                            <h5>Natia</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="anggota-card">
                            <img src="assets/image/anggota/pendidikan/nazwa.jpg" class="anggota-img">
                            <h5>Najwa Shabira</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="anggota-card">
                            <img src="assets/image/anggota/pendidikan/indah.jpg" class="anggota-img">
                            <h5>Nur Indah Widuri</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="anggota-card">
                            <img src="assets/image/anggota/pendidikan/faiq.jpg" class="anggota-img">
                            <h5>Muhammad Faiq Nizam</h5>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="anggota-card">
                            <img src="assets/image/anggota/pendidikan/naila.jpg" class="anggota-img">
                            <h5>Naila Nururrohmah</h5>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
MODAL DIVISI KEWIRAUSAHAAN
===================================================== -->
<div class="modal fade" id="wirausahaModal">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content custom-modal">

            <!-- HEADER -->
            <div class="modal-header border-0">

                <h3 class="modal-title">
                    Divisi Kewirausahaan
                </h3>

                <button 
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- =====================================================
                KADIV & SEKDIV
                ====================================================== -->
                <div class="row justify-content-center mb-5">

                    <!-- KADIV -->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="member-card-premium">

                            <img 
                                src="assets/image/anggota/kewirausahaan/aldi.jpg"
                                class="member-img"
                            >

                            <h4>
                                Muhammad Aldi
                            </h4>

                            <span>
                                Kepala Divisi
                            </span>

                        </div>

                    </div>

                    <!-- SEKDIV -->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="member-card-premium">

                            <img 
                                src="assets/image/anggota/kewirausahaan/elok.jpg"
                                class="member-img"
                            >

                            <h4>
                                Elok Ramadani
                            </h4>

                            <span>
                                Sekretaris Divisi
                            </span>

                        </div>

                    </div>

                </div>

                <!-- =====================================================
                ANGGOTA
                ====================================================== -->
                <div class="row">

                    <!-- NURIANTI -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/kewirausahaan/nurianti.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Nurianti
                            </h5>

                        </div>

                    </div>

                    <!-- NOVA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/kewirausahaan/nova.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Nova Sukma Arum Andita
                            </h5>

                        </div>

                    </div>

                    <!-- ISMATUL -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/kewirausahaan/ismatul.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Ismatul Khamidah
                            </h5>

                        </div>

                    </div>

                    <!-- FENGKU -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/kewirausahaan/fengku.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Fengku Akhmad Baihaqi
                            </h5>

                        </div>

                    </div>

                    <!-- SALWA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/kewirausahaan/salwa.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Salwa Ulaiyya Khairunnissa
                            </h5>

                        </div>

                    </div>

                    <!-- MOCH SUBCHI -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/kewirausahaan/subchi.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Moch Subchi Ramadhani
                            </h5>

                        </div>

                    </div>

                    <!-- AGNIYAH -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/kewirausahaan/agniyah.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Agniyah Nur Fitri
                            </h5>

                        </div>

                    </div>

                    <!-- FATIMAH -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/kewirausahaan/fatimah.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Fatimah Azzahra
                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
MODAL DIVISI PENGABDIAN
===================================================== -->
<div class="modal fade" id="pengabdianModal">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content custom-modal">

            <!-- HEADER -->
            <div class="modal-header border-0">

                <h3 class="modal-title">
                    Divisi Pengabdian Masyarakat
                </h3>

                <button 
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- =====================================================
KADIV & SEKDIV
===================================================== -->
<div class="row justify-content-center mb-5">

    <!-- KADIV -->
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="member-card-premium">

            <img 
                src="assets/image/anggota/pengabdian/yudi.jpg"
                class="member-img"
            >

            <h4>
                Yudi Prasetya  
            </h4>

            <span>
                Kepala Divisi
            </span>

        </div>

    </div>

    <!-- SEKDIV -->
    <div class="col-lg-4 col-md-6 mb-4">

        <div class="member-card-premium">

            <img 
                src="assets/image/anggota/pengabdian/sekdiv.jpg"
                class="member-img"
            >

            <h4>
                Volyn Visya Handini
            </h4>

            <span>
                Sekretaris Divisi
            </span>

        </div>

    </div>

</div>

                <!-- =====================================================
                ANGGOTA
                ====================================================== -->
                <div class="row">

                    <!-- Nisa -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/pengabdian/nissa.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Nisa Nur Aprilia Nisa
                            </h5>

                        </div>

                    </div>

                    <!-- NURMUAMANATI -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/pengabdian/Nurmuamanati Sa'adah-Staff.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Nurmuamanati Saadah
                            </h5>

                        </div>

                    </div>

                    <!-- AHMAD -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/pengabdian/staff.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Ahmad Aldi Triana
                            </h5>

                        </div>

                    </div>

                    <!-- SYAMSUL -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/pengabdian/samsul.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Syamsul Ma'arif
                            </h5>

                        </div>

                    </div>

                    <!-- LUCKYANA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/pengabdian/Luckyana Rifa Muzakki .jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Luckyana Rifa Muzakki
                            </h5>

                        </div>

                    </div>

                    <!-- AMALYA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/pengabdian/Amalya Putri.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Amalya Putri
                            </h5>

                        </div>

                    </div>

                    <!-- RAHMADIAN -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/pengabdian/Rahmadian Fatmawati .jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Rahmadian Fatmawati
                            </h5>

                        </div>

                    </div>

                    <!-- INDRI -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/pengabdian/INDRI SETIAWATI.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Indri Setiawati
                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
MODAL DIVISI LINGKUNGAN HIDUP
===================================================== -->
<div class="modal fade" id="lingkunganModal">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content custom-modal">

            <!-- HEADER -->
            <div class="modal-header border-0">

                <h3 class="modal-title">
                    Divisi Lingkungan Hidup
                </h3>

                <button 
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- =====================================================
                KADIV & SEKDIV
                ====================================================== -->
                <div class="row justify-content-center mb-5">

                    <!-- KADIV -->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="member-card-premium">

                            <img 
                                src="assets/image/anggota/lingkungan/kadiv.jpg"
                                class="member-img"
                            >

                            <h4>
                                Fifi Nur Aisah
                            </h4>

                            <span>
                                Kepala Divisi
                            </span>

                        </div>

                    </div>

                    <!-- SEKDIV -->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="member-card-premium">

                            <img 
                                src="assets/image/anggota/lingkungan/Jihan Nabila Putri .jpg"
                                class="member-img"
                            >

                            <h4>
                                Jihan Nabila Putri
                            </h4>

                            <span>
                                Sekretaris Divisi
                            </span>

                        </div>

                    </div>

                </div>

                <!-- =====================================================
                ANGGOTA
                ====================================================== -->
                <div class="row">

                    <!-- HAIKAL -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/lingkungan/haikal.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Haikal Azkal Azkiya
                            </h5>

                        </div>

                    </div>

                    <!-- ASYROF -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/lingkungan/asyrof.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Muhammad Asyrof
                            </h5>

                        </div>

                    </div>

                    <!-- SITI -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/lingkungan/hamidah.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Siti Hamidah
                            </h5>

                        </div>

                    </div>

                    <!-- Abdullah -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/lingkungan/abdulah Hamam.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Abdullah Hamam 
                            </h5>

                        </div>

                    </div>

                    <!-- AMELIA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/lingkungan/amelia.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Amelia Agustina
                            </h5>

                        </div>

                    </div>

                    <!-- Angelia -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/lingkungan/angelia.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Angelia 
                            </h5>

                        </div>

                    </div>

                    <!-- HANNA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/lingkungan/Hanna Izmi Himayatillah.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Hanna Izmi Himayatillah
                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
MODAL DIVISI PUBLIKASI
===================================================== -->
<div class="modal fade" id="publikasiModal">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content custom-modal">

            <!-- HEADER -->
            <div class="modal-header border-0">

                <h3 class="modal-title">
                    Divisi Publikasi dan Sosialisasi
                </h3>

                <button 
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- =====================================================
                KADIV & SEKDIV
                ====================================================== -->
                <div class="row justify-content-center mb-5">

                    <!-- KADIV -->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="member-card-premium">

                            <img 
                                src="assets/image/anggota/publikasi/kadiv.jpg"
                                class="member-img"
                            >

                            <h4>
                                Dea Apriliyani
                            </h4>

                            <span>
                                Kepala Divisi
                            </span>

                        </div>

                    </div>

                    <!-- SEKDIV -->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="member-card-premium">

                            <img 
                                src="assets/image/anggota/publikasi/sekdiv.jpg"
                                class="member-img"
                            >

                            <h4>
                                Attha Qeisha
                            </h4>

                            <span>
                                Sekretaris Divisi
                            </span>

                        </div>

                    </div>

                </div>

                <!-- =====================================================
                ANGGOTA
                ====================================================== -->
                <div class="row">

                    <!-- azsky -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/publikasi/azsky.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Azsky Azkiyyatunnafsi Nurillathifah
                            </h5>

                        </div>

                    </div>

                    <!-- NISA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/publikasi/nisa.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Nisa Nurmalasari
                            </h5>

                        </div>

                    </div>

                    <!-- MELIANA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/publikasi/meli.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Meliana Rahmawati
                            </h5>

                        </div>

                    </div>

                    <!-- LAELATUL -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/publikasi/lea.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Laelatul Fitria
                            </h5>

                        </div>

                    </div>

                    <!-- MUTIARA -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/publikasi/muti.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Mutiara
                            </h5>

                        </div>

                    </div>

                    <!-- AFAL -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/publikasi/afal.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Muhammad Afal Miratul Adzam
                            </h5>

                        </div>

                    </div>

                    <!-- WILDAN -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/publikasi/wildan.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Wildan Muhammad Fahmi
                            </h5>

                        </div>

                    </div>

                    <!-- Lucy Mareta -->
                    <div class="col-lg-3 col-md-4 col-6 mb-4">

                        <div class="anggota-card">

                            <img 
                                src="assets/image/anggota/publikasi/lucy.jpg"
                                class="anggota-img"
                            >

                            <h5>
                                Lucy Mareta 
                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
BERITA SECTION
===================================================== -->
<section class="berita section-padding" id="berita">

    <div class="container">

        <!-- TITLE -->
        <div class="section-title text-center" data-aos="fade-up">

            <h2>
                Berita & Kegiatan
            </h2>

            <p>
                Informasi terbaru seputar kegiatan 
                dan aktivitas GENBI UIN SSC
            </p>

        </div>

        <!-- CONTENT -->
        <div class="row mt-5">

            <?php

            include 'config/koneksi.php';

            $query = mysqli_query(
                $conn,
                "SELECT * FROM berita ORDER BY id DESC"
            );

            while($data = mysqli_fetch_array($query)){

            ?>

            <!-- ITEM -->
            <div class="col-lg-4 col-md-6 mb-4">

                <div class="berita-card">

                    <!-- IMAGE -->
                    <div class="berita-image">

                        <img 
                            src="assets/upload/<?php echo $data['gambar']; ?>"
                            class="img-fluid"
                            alt="<?php echo $data['judul']; ?>"
                        >

                    </div>

                    <!-- CONTENT -->
                    <div class="berita-content">

                        <small>
                            <i class="fa-solid fa-calendar-days"></i>

                            <?php echo $data['tanggal']; ?>
                        </small>

                        <h3>
                            <?php echo $data['judul']; ?>
                        </h3>

                        <p>

                            <?php
                            // Menggunakan Null Coalescing Operator (??) untuk mencegah error null
                            echo substr(
                                $data['deskripsi'] ?? '', 
                                0, 
                                100
                            );
                            ?>...

                        </p>

                        <!-- BUTTON -->
                        <a 
                            href="detail-berita.php?id=<?php echo $data['id']; ?>"
                            class="btn btn-berita mt-3">

                            Baca Selengkapnya

                        </a>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</section>


<!-- =====================================================
KEGIATAN SECTION
===================================================== -->
<section class="kegiatan section-padding" id="kegiatan">

    <div class="container">

        <!-- TITLE -->
        <div class="section-title text-center" data-aos="fade-up">

            <h2>
                Kegiatan GENBI
            </h2>

            <p>
                Dokumentasi kegiatan dan event 
                GENBI UIN SSC
            </p>

        </div>

        <!-- CONTENT -->
        <div class="row mt-5">

            <?php

            $kegiatan = mysqli_query(
                $conn,
                "SELECT * FROM kegiatan ORDER BY id DESC"
            );

            while($row = mysqli_fetch_array($kegiatan)){

            ?>

            <!-- ITEM -->
            <div class="col-lg-4 col-md-6 mb-4">

                <div class="kegiatan-card">

                    <!-- IMAGE -->
                    <div class="kegiatan-image">

                        <img
                            src="assets/upload/kegiatan/<?php echo $row['gambar']; ?>"
                            class="kegiatan-img"
                            alt="<?php echo $row['judul']; ?>"
                        >

                    </div>

                    <!-- CONTENT -->
                    <div class="kegiatan-content">

                        <small>

                            <i class="fa-solid fa-calendar-days"></i>

                            <?php echo $row['tanggal']; ?>

                        </small>

                        <h3>
                            <?php echo $row['judul']; ?>
                        </h3>

                        <p>

                            <?php
                            echo substr(
                                $row['deskripsi'],
                                0,
                                100
                            );
                            ?>...

                        </p>

                        <!-- BUTTON -->
                        <a
                            href="detail-kegiatan.php?id=<?php echo $row['id']; ?>"
                            class="btn btn-primary">

                            Detail Kegiatan

                        </a>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</section>


<!-- =====================================================
FAQ SECTION
===================================================== -->
<section class="faq-section section-padding" id="faq">

    <div class="container">

        <!-- TITLE -->
        <div class="section-title text-center" data-aos="fade-up">

            <h2>
                Frequently Asked Questions
            </h2>

            <p>
                Beberapa pertanyaan yang sering ditanyakan 
                mengenai GENBI UIN SSC.
            </p>

        </div>

        <!-- FAQ -->
        <div class="faq-container mt-5">

            <div class="accordion" id="faqAccordion">

                <!-- ITEM 1 -->
                <div class="accordion-item" data-aos="fade-up">

                    <h2 class="accordion-header">

                        <button 
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1">

                            Apa itu GENBI?

                        </button>

                    </h2>

                    <div 
                        id="faq1"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            GENBI (Generasi Baru Indonesia) adalah komunitas 
                            mahasiswa penerima beasiswa Bank Indonesia yang 
                            aktif dalam bidang pendidikan, sosial, lingkungan, 
                            dan pengembangan leadership.

                        </div>

                    </div>

                </div>

                <!-- ITEM 2 -->
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">

                    <h2 class="accordion-header">

                        <button 
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq2">

                            Apa tujuan GENBI UIN SSC?

                        </button>

                    </h2>

                    <div 
                        id="faq2"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            GENBI UIN SSC bertujuan membentuk generasi muda 
                            yang unggul, aktif, inovatif, dan mampu memberikan 
                            dampak positif bagi masyarakat dan Indonesia.

                        </div>

                    </div>

                </div>

                <!-- ITEM 3 -->
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">

                    <h2 class="accordion-header">

                        <button 
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq3">

                            Program apa saja yang dimiliki GENBI?

                        </button>

                    </h2>

                    <div 
                        id="faq3"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            GENBI memiliki berbagai program seperti 
                            GENBI Mengajar, Leadership Training, 
                            Social Movement, Green Movement, 
                            dan kegiatan pengembangan mahasiswa lainnya.

                        </div>

                    </div>

                </div>

                <!-- ITEM 4 -->
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">

                    <h2 class="accordion-header">

                        <button 
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq4">

                            Bagaimana cara bergabung dengan GENBI?

                        </button>

                    </h2>

                    <div 
                        id="faq4"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Untuk bergabung dengan GENBI, mahasiswa harus 
                            menjadi penerima beasiswa Bank Indonesia dan 
                            mengikuti proses seleksi organisasi GENBI.

                        </div>

                    </div>

                </div>

                <!-- ITEM 5 -->
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">

                    <h2 class="accordion-header">

                        <button 
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq5">

                            Apa manfaat menjadi anggota GENBI?

                        </button>

                    </h2>

                    <div 
                        id="faq5"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Anggota GENBI mendapatkan pengalaman organisasi, 
                            leadership, relasi luas, pengembangan soft skill, 
                            serta kesempatan berkontribusi untuk masyarakat.

                        </div>

                    </div>

                </div>

                    <!-- ITEM 6 -->
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">

                    <h2 class="accordion-header">

                        <button 
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq6">

                            Apa tugas utama Bank Indonesia?

                        </button>

                    </h2>

                    <div 
                        id="faq6"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Bank Indonesia memiliki tugas utama menjaga stabilitas nilai
            rupiah, menjaga sistem pembayaran, serta menjaga stabilitas
            sistem keuangan Indonesia.


                        </div>

                    </div>

                </div>

                <!-- ITEM 7 -->
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">

                    <h2 class="accordion-header">

                        <button 
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq7">

                            Apa yang dimaksud kebanksentralan?

                        </button>

                    </h2>

                    <div 
                        id="faq7"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Kebanksentralan merujuk pada kewenangan dan tanggung jawab Bank Indonesia sebagai lembaga yang bertanggung jawab atas kebijakan moneter dan stabilitas sistem keuangan nasional.

                        </div>

                    </div>

                </div>

                <!-- ITEM 8 -->
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">

                    <h2 class="accordion-header">

                        <button 
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq8">

                            Mengapa mahasiswa perlu memahami kebanksentralan?

                        </button>

                    </h2>

                    <div 
                        id="faq8"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Memahami kebanksentralan penting bagi mahasiswa untuk memahami peran Bank Indonesia dalam menjaga stabilitas ekonomi, serta dampaknya terhadap kehidupan sehari-hari dan masa depan ekonomi Indonesia.  
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
CONTACT SECTION
===================================================== -->
<section class="contact section-padding" id="contact">

    <div class="container">

        <!-- TITLE -->
        <div class="section-title text-center" data-aos="fade-up">

            <h2>
                Contact Us
            </h2>

            <p>
                Hubungi kami untuk kolaborasi, informasi, 
                dan kegiatan GENBI UIN SSC.
            </p>

        </div>

        <div class="row mt-5 align-items-center">

            <!-- =====================================================
            FORM CONTACT
            ====================================================== -->
            <div class="col-lg-7 mb-4" data-aos="fade-right">

                <div class="contact-form">

                    <form id="waForm">

                        <div class="row">

                            <!-- NAMA -->
                            <div class="col-md-6 mb-4">

                                <label>
                                    Nama Lengkap
                                </label>

                                <input 
                                    type="text"
                                    id="nama"
                                    class="form-control"
                                    placeholder="Masukkan nama"
                                    required
                                >

                            </div>

                            <!-- EMAIL -->
                            <div class="col-md-6 mb-4">

                                <label>
                                    Email
                                </label>

                                <input 
                                    type="email"
                                    id="email"
                                    class="form-control"
                                    placeholder="Masukkan email"
                                    required
                                >

                            </div>

                        </div>

                        <!-- SUBJECT -->
                        <div class="mb-4">

                            <label>
                                Subject
                            </label>

                            <input 
                                type="text"
                                id="subject"
                                class="form-control"
                                placeholder="Masukkan subject"
                                required
                            >

                        </div>

                        <!-- PESAN -->
                        <div class="mb-4">

                            <label>
                                Pesan
                            </label>

                            <textarea 
                                id="pesan"
                                class="form-control"
                                rows="6"
                                placeholder="Tulis pesan..."
                                required></textarea>

                        </div>

                        <!-- BUTTON -->
                        <button 
                            type="submit"
                            class="btn btn-contact">

                            <i class="fa-brands fa-whatsapp"></i>

                            Kirim ke WhatsApp

                        </button>

                    </form>

                </div>

            </div>

            <!-- =====================================================
            CONTACT INFO
            ====================================================== -->
            <div class="col-lg-5" data-aos="fade-left">

                <div class="contact-info">

                    <h3>
                        Informasi Kontak
                    </h3>

                    <p>
                        Mari terhubung bersama GENBI 
                        untuk menciptakan generasi muda 
                        yang aktif dan berdampak.
                    </p>

                    <!-- ITEM -->
                    <div class="info-box">

                        <div class="info-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div>

                            <h5>
                                Alamat
                            </h5>

                            <span>
                                Cirebon, Jawa Barat
                            </span>

                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="info-box">

                        <div class="info-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div>

                            <h5>
                                Email
                            </h5>

                            <span>
                                genbiUINSSC@gmail.com
                            </span>

                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="info-box">

                        <div class="info-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>

                        <div>

                            <h5>
                                WhatsApp
                            </h5>

                            <span>
                                +62 812 3456 7890
                            </span>

                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="info-box">

                        <div class="info-icon">
                            <i class="fa-brands fa-instagram"></i>
                        </div>

                        <div>

                            <h5>
                                Instagram
                            </h5>

                            <span>
                                @genbi.UINSSC
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =====================================================
PESAN & KESAN SECTION
===================================================== -->
<section class="pesan-kesan section-padding" id="pesan">

    <div class="container">

        <div class="section-title text-center" data-aos="fade-up">

            <h2>
                Pesan & Kesan untuk GENBI
            </h2>

            <p>
                Tinggalkan pesan, kesan, atau aspirasi
                untuk GENBI UIN SSC
            </p>

        </div>

        <div class="row justify-content-center mt-5">

            <div class="col-lg-8">

                <div class="pesan-card">

                    <form
                    action="kirim-pesan.php"
                    method="POST">

                        <div class="mb-4">

                            <label>
                                Nama
                            </label>

                            <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama"
                            required>

                        </div>

                        <div class="mb-4">

                            <label>
                                Pesan / Kesan
                            </label>

                            <textarea
                            name="pesan"
                            rows="6"
                            class="form-control"
                            placeholder="Tulis pesan atau kesan..."
                            required></textarea>

                        </div>

                        <button
                        type="submit"
                        class="btn btn-pesan">

                            <i class="fa-solid fa-paper-plane"></i>

                            Kirim Pesan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

    <!-- FOOTER -->
    <?php include 'components/footer.php'; ?>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
AOS.init({
    duration: 700,
    once: true,
    offset: 0,
    delay: 0,
    mirror: false,
    throottleDelay: 50
    
});
</script>

<script>

document
.getElementById("waForm")

.addEventListener("submit", function(e){

    e.preventDefault();

    let nama = document.getElementById("nama").value;
    let email = document.getElementById("email").value;
    let subject = document.getElementById("subject").value;
    let pesan = document.getElementById("pesan").value;

    let nomorWA = "6282119484482";

    let text = 
`Halo GENBI UIN SSC

Nama : ${nama}
Email : ${email}
Subject : ${subject}

Pesan :
${pesan}`;

    let url = 
`https://wa.me/${nomorWA}?text=${encodeURIComponent(text)}`;

    window.open(url,'_blank');

});

</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

window.addEventListener('scroll',function(){

    let navbar =
    document.querySelector('.navbar');

    navbar.classList.toggle(
        'scrolled',
        window.scrollY > 50
    );

});

/* AUTO CLOSE MENU MOBILE */

document.querySelectorAll('.nav-link').forEach(link => {

    link.addEventListener('click', () => {

        const navbarCollapse =
        document.querySelector('.navbar-collapse');

        const bsCollapse =
        bootstrap.Collapse.getInstance(navbarCollapse);

        if(bsCollapse){

            bsCollapse.hide();

        }

    });

});

</script>

<script>

const hero = document.querySelector('.hero');

const backgrounds = [
    'assets/image/bkg.jpg',
    'assets/image/bg1.jpg',
    'assets/image/bkg.jpg',
    'assets/image/bg1.jpg'
];

let index = 0;

setInterval(() => {

    index++;

    if(index >= backgrounds.length){
        index = 0;
    }

    hero.style.background =
    `linear-gradient(
        rgba(0,0,0,0.65),
        rgba(0,0,0,0.65)
    ),
    url('${backgrounds[index]}')`;

    hero.style.backgroundSize = 'cover';
    hero.style.backgroundPosition = 'center';

}, 4000);

</script>

</body>
</html>