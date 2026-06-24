<?php

session_start();

include '../config/koneksi.php';

if(isset($_POST['login'])){

    /* =========================
    GOOGLE RECAPTCHA
    ========================= */

    $secretKey = "6LdMPPYsAAAAAFdCJ-cVt4tOztTkapomJ19jofgG";

    $responseKey =
    $_POST['g-recaptcha-response'];

    $userIP =
    $_SERVER['REMOTE_ADDR'];

    /* =========================
VALIDASI RECAPTCHA
========================= */

$url =
"https://www.google.com/recaptcha/api/siteverify";

$data = [

    'secret'   => $secretKey,
    'response' => $responseKey,
    'remoteip' => $userIP

];

$options = [

    'http' => [

        'header' =>
        "Content-type: application/x-www-form-urlencoded\r\n",

        'method'  => 'POST',

        'content' =>
        http_build_query($data)

    ]

];

$context =
stream_context_create($options);

$response =
file_get_contents(
    $url,
    false,
    $context
);

$response =
json_decode($response);

    /* CAPTCHA GAGAL */

    if(!$response->success){

        $error =
        "Harap verifikasi captcha terlebih dahulu!";

    }else{

        /* LOGIN */

        $username =
        $_POST['username'];

        $password =
        md5($_POST['password']);

        $query = mysqli_query(

            $conn,

            "SELECT * FROM admin
            WHERE username='$username'
            AND password='$password'"

        );

        if(mysqli_num_rows($query) > 0){

            $_SESSION['login'] = true;

            header("Location: dashboard.php");
            exit;

        }else{

            $error =
            "Username atau Password Salah!";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>
        Login Admin GENBI
    </title>

    <!-- GOOGLE RECAPTCHA -->
    <script
    src="https://www.google.com/recaptcha/api.js"
    async
    defer>
    </script>

    <!-- BOOTSTRAP -->
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <!-- FONT AWESOME -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- GOOGLE FONT -->
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

       body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
    135deg,
    rgba(0,31,84,.92),
    rgba(0,77,153,.85)
    ),
    url('../assets/image/bg-login.jpg');

    background-size:cover;
    background-position:center;

    margin:0;
    padding:20px;

    position:relative;

}

.login-box{

    width:100%;
    max-width:500px;

    margin:auto;

    background:rgba(255,255,255,0.12);

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,0.2);

    padding:45px;

    border-radius:30px;

    box-shadow:0 15px 40px rgba(0,0,0,0.25);

    position:relative;

    z-index:2;

    color:white;

}

@media(max-width:768px){

    body{

        display:block;
        padding:15px;

    }

    .login-box{

        margin:20px auto;

    }

}

        /* OVERLAY */

        body::before{

            content:"";

            position:absolute;

            width:100%;
            height:100%;

            backdrop-filter:blur(8px);

            background:
            rgba(0,0,0,0.15);
        }

        /* LOGIN BOX */

        .login-box{

            width:100%;
            max-width:500px;

            background:
            rgba(255,255,255,0.12);

            backdrop-filter:blur(20px);

            border:
            1px solid rgba(255,255,255,0.2);

            padding:45px;

            border-radius:30px;

            box-shadow:
            0 15px 40px rgba(0,0,0,0.25);

            position:relative;

            z-index:2;

            color:white;

            animation:fadeUp 1s ease;
        }

        /* ANIMATION */

        @keyframes fadeUp{

            from{
                opacity:0;
                transform:translateY(50px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }

        }

        /* SHAKE */

        .shake{
            animation:shake 0.5s;
        }

        @keyframes shake{

            0%{transform:translateX(0);}
            25%{transform:translateX(-6px);}
            50%{transform:translateX(6px);}
            75%{transform:translateX(-6px);}
            100%{transform:translateX(0);}

        }

        /* LOGO */

        .login-logo{

            width:95px;
            height:95px;

            object-fit:cover;

            border-radius:50%;

            border:4px solid white;

            display:block;

            margin:auto;

            margin-bottom:20px;

            box-shadow:
            0 10px 30px rgba(0,0,0,0.25);
        }

        /* TITLE */

        .login-title{

            text-align:center;

            font-size:34px;

            font-weight:700;

            margin-bottom:5px;
        }

        .login-subtitle{

            text-align:center;

            color:#dbeafe;

            margin-bottom:35px;

            font-size:15px;
        }

        /* INPUT */

        .input-group{

            position:relative;
        }

        .input-group > i{

    position:absolute;

    top:18px;
    left:18px;

    color:#dbeafe;

    z-index:10;
}

        .form-control{

            height:56px;

            border:none;

            border-radius:15px;

            padding-left:50px;

            background:
            rgba(255,255,255,0.15);

            color:white;

            font-size:15px;
        }

        .form-control::placeholder{
            color:#dbeafe;
        }

        .form-control:focus{

            background:
            rgba(255,255,255,0.2);

            color:white;

            box-shadow:none;

            border:
            1px solid rgba(255,255,255,0.4);
        }

        /* SHOW PASSWORD */

        .toggle-password{

            position:absolute;

            right:18px;
            top:17px;

            color:white;

            cursor:pointer;

            z-index:20;
        }

        /* CAPTCHA */

        .captcha-box{

            display:flex;

            justify-content:center;

            margin-bottom:20px;
        }

        /* BUTTON */

        .btn-login{

            width:100%;

            height:56px;

            border:none;

            border-radius:15px;

            background:white;

            color:#001F54;

            font-weight:700;

            font-size:17px;

            transition:0.4s;
        }

        .btn-login:hover{

            background:#dbeafe;

            transform:translateY(-3px);
        }

        /* ALERT */

        .alert-custom{

            background:
            rgba(255,0,0,0.15);

            border:
            1px solid rgba(255,255,255,0.2);

            color:white;

            border-radius:15px;

            padding:12px;

            margin-bottom:20px;

            text-align:center;
        }

        /* FOOTER */

        .login-footer{

            text-align:center;

            margin-top:25px;

            color:#dbeafe;

            font-size:14px;
        }

@media(max-width:768px){

    body{

        display:block;
        min-height:auto;

        padding:15px;

        overflow-y:auto;

    }

    .login-box{

        width:100%;
        max-width:100%;

        margin:20px auto;

        padding:30px 20px;

        border-radius:25px;

    }

    .login-logo{

        width:70px;
        height:70px;

    }

    .login-title{

        font-size:24px;

    }

    .login-subtitle{

        font-size:13px;

    }

}

    </style>

</head>
<body>

<!-- LOGIN BOX -->
<div class="login-box">

    <!-- LOGO -->
    <img
        src="../assets/image/logo.jpg"
        class="login-logo"
    >

    <!-- TITLE -->
    <h2 class="login-title">
        Admin GENBI
    </h2>

    <p class="login-subtitle">
        Generasi Baru Indonesia UIN SSC
    </p>

    <!-- ALERT -->
    <?php if(isset($error)){ ?>

        <div class="alert-custom">

            <i class="fa-solid fa-circle-exclamation"></i>

            <?php echo $error; ?>

        </div>

    <?php } ?>

    <!-- FORM -->
    <form method="POST">

        <!-- USERNAME -->
        <div class="mb-4">

            <div class="input-group">

                <i class="fa-solid fa-user"></i>

                <input
                    type="text"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan Username"
                    required
                >

            </div>

        </div>

        <!-- PASSWORD -->
        <div class="mb-4">

            <div class="input-group">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Masukkan Password"
                    required
                >

                <span
                    class="toggle-password"
                    onclick="togglePassword()">

                    <i class="fa-solid fa-eye"></i>

                </span>

            </div>

        </div>

        <!-- RECAPTCHA -->
        <div class="captcha-box">

            <div
            class="g-recaptcha"
            data-sitekey="6LdMPPYsAAAAAP55vih8VnQx7xWQkdEiu_8mFbQs">
            </div>

        </div>

        <!-- BUTTON -->
        <button
            type="submit"
            name="login"
            class="btn-login">

            <i class="fa-solid fa-right-to-bracket"></i>

            Login Sekarang

        </button>

    </form>

    <!-- FOOTER -->
    <div class="login-footer">

        © 2026 GENBI UIN SSC

    </div>

</div>

<!-- SCRIPT -->
<script>

function togglePassword(){

    const password =
    document.getElementById('password');

    if(password.type === "password"){

        password.type = "text";

    }else{

        password.type = "password";

    }

}

/* SHAKE EFFECT */

<?php if(isset($error)){ ?>

document.querySelector('.login-box')
.classList.add('shake');

<?php } ?>

</script>

</body>
</html>