<?php
// session_start();
// include 'db.php';

// // Cek jika sudah login, arahkan ke index
// if (isset($_SESSION['login'])) {
//     header("Location: index.php");
//     exit();
// }

// // Cek cookie jika ada
// if (isset($_COOKIE['username'])) {
//     $_SESSION['login'] = true;
//     $_SESSION['username'] = $_COOKIE['username'];
//     header("Location: index.php");
//     exit();
// }

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;

        // Jika centang remember me, simpan ke cookie selama 7 hari
        if (isset($_POST['remember'])) {
            setcookie("username", $username, time() + (7 * 24 * 60 * 60), "/"); // 7 hari
        }

        header("Location: index.php");
        exit();
    } else {
        echo "Login gagal!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #efeff0;" class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container">
        <div class="row bg-white rounded-4 d-flex align-items-center">
            <div class="col-6">
                <img src="img/login.svg" alt="" class="col-10 d-flex mx-auto">
            </div>
            <div class="col-6 align-content-center">
                <form action="" method="get" class="col-10 mx-auto">
                    <h1>Login</h1>
                    <div class="mb-3 mt-5">
                        <label for="username" class="form-label fs-5 text-secondary">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukan Username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fs-5 text-secondary">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukan Password">
                    </div>
                    <div class="form-check mb-5">
                        <input class="form-check-input" type="checkbox" value="" id="rememberme" checked>
                        <label class="form-check-label fs-5" for="rememberme">Remember Me</label>
                    </div>
                    <button type="button" name="login" class="btn button1 px-5 rounded-5 d-flex mx-auto fs-5">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

