<?php
session_start();
$message = '';

if (isset($_POST['usernameText']) && isset($_POST['passwordText'])) {
    include '../library/config.php';
    include '../library/opendb.php';

    $user = $_POST['usernameText'];
    $pass = $_POST['passwordText'];
    $sql = "SELECT username FROM akun WHERE username = '$user' AND password ='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user_is_logged_in'] = true;
        $_SESSION['username'] = $user;
        $message = 'Login Berhasil';
    } else {
        $message = 'Maaf username / password salah, silahkan periksa kembali';
    }
    include '../library/closedb.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="x-icon" href="../Resource/logo.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>RajaNgoding</title>
</head>

<body>

    <!-- BACKGROUND -->
    <section class="bg">
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
        <span class="star"></span>
    </section>

    <!-- LOGIN FORM -->
    <div class="frame login">
        <div class="isi">
            <div class="kiri">
                <div class="content">
                    <div class="logo">
                        <h1>Raja</h1>
                        <h1 class="ungu">Ngoding</h1>
                    </div>
                    <div class="teksKiri">
                        <h1 class="welcome">Welcome Back !</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi cupiditate aperiam animi iure, atque commodi blanditiis placeat beatae nobis expedita molestiae neque quos id ipsam suscipit architecto. Placeat quisquam quia nam enim, quasi cumque aliquid pariatur expedita incidunt rem explicabo minus ducimus exercitationem perspiciatis voluptatem tempore.</p>
                        <img src="../Resource/illustrasi2.webp" alt="" class="illustrasi2">
                    </div>
                </div>
            </div>
            <div class="kanan">
                <div class="loginFrame">
                    <h1 class="title">Login</h1>
                    <form action="" method="post" name="loginForm" id="loginForm">
                        Username
                        <input name="usernameText" type="text" id="usernameText" placeholder="Username" required> <br>
                        Password
                        <input name="passwordText" type="password" id="passwordText" placeholder="Password" required> <br>
                        <hr width="75%"> <br> <br>
                        <input name="btn" type="submit" id="btn" value="Login">
                    </form>
                    <div class="nav">
                        <p>Belum punya akun?</p>
                        <a href="register.php">Register</a>
                    </div>
                    <div class="buffer" id="buffer"></div>
                    <?php if ($message != '') : ?>
                        <p class="<?php echo ($message == 'Login Berhasil' ? 'successMsg' : 'errorMsg'); ?>">
                            <strong><?php echo $message; ?></strong>
                        </p>
                        <?php if ($message == 'Login Berhasil') : ?>
                            <script>
                                document.getElementById('buffer').style.display = 'block';
                                setTimeout(function() {
                                    window.location.href = '../main/home.php';
                                }, 2000);
                            </script>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>