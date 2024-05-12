<?php
session_start();
$message = '';

if (isset($_POST['usernameText']) && isset($_POST['passwordText'])) {
    include '../library/config.php';
    include '../library/opendb.php';

    $user = $_POST['usernameText'];
    $pass = $_POST['passwordText'];
    $confirm = $_POST['passwordConfirm'];

    if ($pass !== $confirm) {
        $message = 'Confirm password tidak sesuai';
    } else {
        $checkUser = "SELECT username FROM akun WHERE username = '$user'";
        $checkResult = mysqli_query($conn, $checkUser);
        if (mysqli_num_rows($checkResult) > 0) {
            $message = 'Username sudah ada, silahkan ganti username';
        } else {
            $sql = "INSERT INTO akun (username, password, pp_file) VALUES ('$user', '$pass', '../Resource/profile/default.jpg')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['user_is_logged_in'] = true;
                $_SESSION['username'] = $user;
                $message = 'Register Berhasil';
            } else {
                $message = 'Register gagal, silahkan coba lagi';
            }
        }
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

    <!-- REGISTER FORM -->
    <div class="frame register">
        <div class="isi">
            <div class="kiri">
                <div class="content">
                    <div class="logo">
                        <h1>Raja</h1>
                        <h1 class="ungu">Ngoding</h1>
                    </div>
                    <div class="teksKiri">
                        <h1 class="welcome">Welcome New User 👋</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi cupiditate aperiam animi iure, atque commodi blanditiis placeat beatae nobis expedita molestiae neque quos id ipsam suscipit architecto. Placeat quisquam quia nam enim, quasi cumque aliquid pariatur expedita incidunt rem explicabo minus ducimus exercitationem perspiciatis voluptatem tempore.</p>
                        <img src="../Resource/illustrasi1.webp" alt="" class="illustrasi1">
                    </div>
                </div>
            </div>
            <div class="kanan">
                <div class="registerFrame">
                    <h1 class="title">Register</h1>
                    <form action="" method="post" name="registerForm" id="registerForm">
                        Username
                        <input name="usernameText" type="text" id="usernameText" placeholder="Buat Username" required> <br>
                        Password
                        <input name="passwordText" type="password" id="passwordText" placeholder="Buat Password" required> <br>
                        Confirm Password
                        <input name="passwordConfirm" type="password" id="passwordConfirm" placeholder="Confirm Password" required> <br>
                        <hr width="75%"> <br> <br>
                        <input name="btn" type="submit" id="btn" value="Register">
                    </form>
                    <div class="nav">
                        <p>Sudah punya akun?</p>
                        <a href="login.php">Login</a>
                    </div>
                    <div class="buffer" id="buffer"></div>
                    <?php if ($message != '') : ?>
                        <p class="<?php echo ($message == 'Register Berhasil' ? 'successMsg' : 'errorMsg'); ?>">
                            <strong><?php echo $message; ?></strong>
                        </p>
                        <?php if ($message == 'Register Berhasil') : ?>
                            <script>
                                document.getElementById('buffer').style.display = 'block';
                                setTimeout(function() {
                                    window.location.href = 'edit.php';
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