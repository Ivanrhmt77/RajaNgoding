<?php
session_start();
if (
  !isset($_SESSION['user_is_logged_in']) ||
  $_SESSION['user_is_logged_in'] !== true
) {
  header('Location: ../account/login.php');
  exit;
}

include '../library/config.php';
include '../library/opendb.php';

$username = $_SESSION['username'];
$sql = "SELECT username, pp_file FROM akun WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
  $pp_file = $user['pp_file'];
}

mysqli_free_result($result);
include '../library/closedb.php'

?>
<html>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" type="x-icon" href="../Resource/logo.png" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <title>RajaNgoding</title>
</head>

<body>

  <div id="navigasi" class="sidebar">
    <div class="sidebarContent">
      <a href="home.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : ''; ?>"><i class="fa-solid fa-house icon"></i></i>Home</a>
      <a href="user.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'user.php') ? 'active' : ''; ?>"><i class="fa-solid fa-user icon"></i>Profile User</a>
      <a href="data.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'data.php') ? 'active' : ''; ?>"><i class="fa-solid fa-database icon"></i>Data Mahasiswa</a>
      <a href="tugas.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'tugas.php') ? 'active' : ''; ?>"><i class="fa-solid fa-book icon"></i>Data Tugas</a>
      <a href="../account/logout.php" class="logout"><i class="fa-solid fa-right-from-bracket icon"></i>Logout</a>
    </div>
    <div class="footer">
      <div class="footerContent">
        <p>©2024 Ivan Rahmat Prakasa</p>
        <br>
        <br>
        <br>
        <a href="">Blog</a>
        <a href="">Terms & Conditions</a>
        <a href="">Privacy Policy</a>
        <a href="">Services</a>
        <a href="">About</a>
      </div>
    </div>
  </div>
  <div id="navigasi" class="navbar">
    <div class="navbarContent">
      <a href="home.php" class="logo">
        <h1>Raja</h1>
        <h1 class="ungu">Ngoding</h1>
      </a>
      <div class="pp">
        <img src="<?php echo $pp_file; ?>" alt="">
        <a href="user.php"><?php echo '@' . $_SESSION['username'] ?></a>
      </div>
    </div>
  </div>