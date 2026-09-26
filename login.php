<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | GENBI UIN SSC</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 10% 20%,
                    rgba(37, 99, 235, .25),
                    transparent 35%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(14, 165, 233, .18),
                    transparent 35%
                ),
                linear-gradient(
                    135deg,
                    #020b24 0%,
                    #05265f 48%,
                    #064fc4 100%
                );

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 20px;

            overflow-x: hidden;
        }


        /* =====================================================
           BACKGROUND DECORATION
        ===================================================== */

        .background-circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .circle-one {
            width: 350px;
            height: 350px;

            top: -160px;
            left: -120px;

            background: rgba(59, 130, 246, .13);

            filter: blur(2px);
        }

        .circle-two {
            width: 300px;
            height: 300px;

            right: -100px;
            bottom: -120px;

            background: rgba(14, 165, 233, .12);

            filter: blur(2px);
        }


        /* =====================================================
           LOGIN WRAPPER
        ===================================================== */

        .login-wrapper {
            width: 100%;
            max-width: 1080px;

            position: relative;
            z-index: 2;
        }


        /* =====================================================
           MAIN CARD
        ===================================================== */

        .login-box {

            width: 100%;

            background: rgba(255, 255, 255, .97);

            border-radius: 32px;

            overflow: hidden;

            box-shadow:
                0 35px 80px rgba(0, 0, 0, .28);

            border: 1px solid rgba(255,255,255,.5);
        }


        /* =====================================================
           LEFT SIDE
        ===================================================== */

        .left-side {

            min-height: 620px;

            padding: 65px 55px;

            color: white;

            position: relative;

            overflow: hidden;

            display: flex;
            flex-direction: column;
            justify-content: center;

            background:
                linear-gradient(
                    145deg,
                    #031b4e 0%,
                    #063f91 55%,
                    #075bd7 100%
                );
        }


        .left-side::before {

            content: "";

            position: absolute;

            width: 330px;
            height: 330px;

            border-radius: 50%;

            top: -150px;
            right: -120px;

            background: rgba(255,255,255,.07);
        }


        .left-side::after {

            content: "";

            position: absolute;

            width: 230px;
            height: 230px;

            border-radius: 50%;

            bottom: -110px;
            left: -100px;

            background: rgba(255,255,255,.06);
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo-wrapper {

            position: relative;
            z-index: 2;

            margin-bottom: 30px;
        }

        .logo-icon {

            width: 92px;
            height: 92px;

            border-radius: 26px;

            background: rgba(255,255,255,.98);

            color: #075bd7;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 42px;

            box-shadow:
                0 15px 35px rgba(0,0,0,.15);
        }


        /* =====================================================
           LEFT TEXT
        ===================================================== */

        .brand-title {

            position: relative;
            z-index: 2;

            font-size: 42px;

            font-weight: 800;

            letter-spacing: -1.5px;

            margin-bottom: 18px;
        }


        .brand-description {

            position: relative;
            z-index: 2;

            max-width: 440px;

            color: rgba(255,255,255,.86);

            font-size: 15px;

            line-height: 1.9;

            margin-bottom: 35px;
        }


        /* =====================================================
           INFORMATION BADGE
        ===================================================== */

        .organization-badge {

            position: relative;
            z-index: 2;

            display: inline-flex;

            align-items: center;

            gap: 10px;

            width: fit-content;

            padding: 11px 17px;

            border-radius: 50px;

            background: rgba(255,255,255,.10);

            border: 1px solid rgba(255,255,255,.16);

            color: rgba(255,255,255,.9);

            font-size: 13px;
        }

        .organization-badge i {
            color: #7dd3fc;
        }


        /* =====================================================
           RIGHT SIDE
        ===================================================== */

        .right-side {

            min-height: 620px;

            padding: 65px 60px;

            display: flex;

            flex-direction: column;

            justify-content: center;

            background: #ffffff;
        }


        /* =====================================================
           LOGIN HEADER
        ===================================================== */

        .login-header {

            margin-bottom: 35px;
        }


        .login-header .small-title {

            color: #2563eb;

            font-size: 13px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 2px;

            margin-bottom: 10px;
        }


        .login-header h2 {

            color: #0b1f44;

            font-size: 36px;

            font-weight: 800;

            margin-bottom: 12px;

            letter-spacing: -1px;
        }


        .login-header p {

            color: #64748b;

            font-size: 15px;

            line-height: 1.7;

            margin: 0;

            max-width: 470px;
        }


        /* =====================================================
           ADMIN CARD
        ===================================================== */

        .admin-card {

            background:
                linear-gradient(
                    145deg,
                    #f8fbff,
                    #eef6ff
                );

            border: 1px solid #dbeafe;

            border-radius: 26px;

            padding: 32px;

            position: relative;

            overflow: hidden;

            transition: .3s ease;

            box-shadow:
                0 12px 35px rgba(37,99,235,.07);
        }


        .admin-card::before {

            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            border-radius: 50%;

            top: -100px;
            right: -80px;

            background: rgba(37,99,235,.07);
        }


        .admin-card:hover {

            transform: translateY(-4px);

            box-shadow:
                0 20px 45px rgba(37,99,235,.13);

            border-color: #bfdbfe;
        }


        /* =====================================================
           ADMIN ICON
        ===================================================== */

        .admin-icon {

            width: 72px;
            height: 72px;

            border-radius: 20px;

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #0ea5e9
                );

            color: white;

            font-size: 30px;

            margin-bottom: 22px;

            box-shadow:
                0 10px 25px rgba(37,99,235,.25);

            position: relative;
            z-index: 2;
        }


        .admin-card h3 {

            color: #0f274f;

            font-size: 24px;

            font-weight: 700;

            margin-bottom: 10px;

            position: relative;
            z-index: 2;
        }


        .admin-card p {

            color: #64748b;

            font-size: 14px;

            line-height: 1.8;

            margin-bottom: 25px;

            position: relative;
            z-index: 2;
        }


        /* =====================================================
           LOGIN BUTTON
        ===================================================== */

        .btn-login {

            width: 100%;

            border: none;

            padding: 15px 25px;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #075bd7
                );

            color: white;

            font-family: 'Poppins', sans-serif;

            font-size: 15px;

            font-weight: 600;

            text-decoration: none;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 10px;

            box-shadow:
                0 10px 25px rgba(37,99,235,.25);

            transition: .3s ease;

            position: relative;
            z-index: 2;
        }


        .btn-login:hover {

            color: white;

            transform: translateY(-2px);

            background:
                linear-gradient(
                    135deg,
                    #1d4ed8,
                    #0346aa
                );

            box-shadow:
                0 15px 30px rgba(37,99,235,.32);
        }


        .btn-login i {

            transition: .3s ease;
        }


        .btn-login:hover i {

            transform: translateX(4px);
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {

            text-align: center;

            color: #94a3b8;

            font-size: 12px;

            margin-top: 28px;
        }


        .footer span {

            color: #2563eb;

            font-weight: 600;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 991px) {

            .left-side {

                min-height: auto;

                padding: 50px 40px;

                text-align: center;

                align-items: center;
            }

            .brand-description {

                margin-left: auto;
                margin-right: auto;
            }

            .right-side {

                min-height: auto;

                padding: 50px 40px;
            }

        }


        @media (max-width: 575px) {

            body {

                padding: 15px;
            }

            .login-box {

                border-radius: 24px;
            }

            .left-side {

                padding: 45px 25px;
            }

            .logo-icon {

                width: 78px;
                height: 78px;

                font-size: 34px;

                border-radius: 22px;
            }

            .brand-title {

                font-size: 30px;

                letter-spacing: -1px;
            }

            .brand-description {

                font-size: 13px;

                line-height: 1.8;
            }

            .right-side {

                padding: 40px 25px;
            }

            .login-header h2 {

                font-size: 29px;
            }

            .admin-card {

                padding: 25px;
            }

        }

    </style>

</head>


<body>


<!-- Background decoration -->

<div class="background-circle circle-one"></div>
<div class="background-circle circle-two"></div>


<div class="login-wrapper">

    <div class="login-box">

        <div class="row g-0">


            <!-- =================================================
                 LEFT SIDE
            ================================================== -->

            <div class="col-lg-5">

                <div class="left-side">

                    <div class="logo-wrapper">

                        <div class="logo-icon">

                            <i class="fa-solid fa-graduation-cap"></i>

                        </div>

                    </div>


                    <h1 class="brand-title">

                        GENBI UIN SSC

                    </h1>


                    <p class="brand-description">

                        Sistem Informasi Organisasi untuk mendukung
                        pengelolaan anggota, kegiatan, berita,
                        absensi, serta berbagai aktivitas
                        Generasi Baru Indonesia UIN Siber
                        Syekh Nurjati Cirebon.

                    </p>


                    <div class="organization-badge">

                        <i class="fa-solid fa-shield-halved"></i>

                        <span>
                            Sistem Manajemen GENBI
                        </span>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 RIGHT SIDE
            ================================================== -->

            <div class="col-lg-7">

                <div class="right-side">


                    <!-- Header -->

                    <div class="login-header">

                        <div class="small-title">

                            Secure Access

                        </div>

                        <h2>

                            Login Sistem

                        </h2>

                        <p>

                            Silakan masuk menggunakan akun administrator
                            untuk mengakses dan mengelola sistem
                            informasi GENBI UIN SSC.

                        </p>

                    </div>


                    <!-- Admin Login -->

                    <div class="admin-card">


                        <div class="admin-icon">

                            <i class="fa-solid fa-user-shield"></i>

                        </div>


                        <h3>

                            Administrator

                        </h3>


                        <p>

                            Kelola data anggota, kegiatan, berita,
                            absensi, laporan, dan seluruh informasi
                            organisasi melalui panel administrator.

                        </p>


                        <a
                            href="admin/login.php"
                            class="btn-login"
                        >

                            <span>
                                Masuk ke Panel Admin
                            </span>

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>


                    </div>


                    <!-- Footer -->

                    <div class="footer">

                        © <?= date('Y'); ?>

                        <span>GENBI UIN SSC</span>

                        · Sistem Informasi Organisasi

                    </div>


                </div>

            </div>


        </div>

    </div>

</div>


</body>

</html>