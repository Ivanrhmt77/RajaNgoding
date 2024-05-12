<?php
include 'header.php';
include '../library/config.php';
include '../library/opendb.php';

$message = "";
error_reporting(0);

$username = $_SESSION['username'];
$query = "SELECT akun.*, files.* FROM akun INNER JOIN files ON akun.username = files.username WHERE akun.username = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $matkul = $_POST['matkul'];

    $filename = $_FILES['file']['name'];
    $fileTmpName  = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    if ($fileError === 0) {
        if ($fileSize < 5000000) {
            $fileDestination = '../Resource/tugas/' . $filename;

            move_uploaded_file($fileTmpName, $fileDestination);
            $sql = "INSERT INTO files (username, matkul, filename, path) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $matkul, $filename, $fileDestination);
            $stmt->execute();

            $message = "Berhasil mengupload file";
            $messageType = "success";
        } else {
            $message = "Ukuran file terlalu besar";
            $messageType = "error";
        }
    } else {
        $message = "Terjadi kesalahan, tidak bisa mengupload file";
        $messageType = "error";
    }
} else {
    $message = "";
}

include '../library/closedb.php';
?>


<div class="main">
    <div class="mainContent">
        <h1>Upload Tugas</h1>
        <br>
        <br>
        <form action="home.php" method="post" enctype="multipart/form-data" class="upload">
            Select File <br>
            <input type="file" name="file" id="file"> <br> <br>
            <select name="matkul" id="matkul" class="matkul">
                <option value="" disabled selected hidden style="color: rgb(169, 169, 169)">--Pilih Matkul--</option>
                <option value="Pemrograman Web">Pemrograman Web</option>
                <option value="Kewarganegaraan">Kewarganegaraan</option>
                <option value="Basis Data">Basis Data</option>
            </select>
            <br>
            <br>
            <div class="button">
                <input type="submit" value="Upload">
                <input type="reset">
            </div>
            <br>
            <br>
            <?php if (!empty($message)) : ?>
                <div id="message" style="color: <?php echo ($messageType == 'error' ? 'red' : 'green'); ?>;">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<script>
    if (document.getElementById('message')) {
        setTimeout(function() {
            document.getElementById('message').style.display = 'none';
        }, 5000);
    }
</script>

</body>

</html>