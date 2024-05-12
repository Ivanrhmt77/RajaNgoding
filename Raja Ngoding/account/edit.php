<?php
session_start();
include '../library/config.php';
include '../library/opendb.php';

$username = $_SESSION['username'];
$query = "SELECT * FROM akun WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (
    !isset($_SESSION['user_is_logged_in']) ||
    $_SESSION['user_is_logged_in'] !== true
) {
    header('Location: login.php');
    exit;
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../library/config.php';
    include '../library/opendb.php';

    $uploadDir = '../Resource/profile/';
    $uploadedFilePath = $user['pp_file'];

    if (!empty($_FILES['pp_file']['name'])) {
        $fileName = basename($_FILES['pp_file']['name']);
        $uploadedFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($uploadedFilePath, PATHINFO_EXTENSION);

        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['pp_file']['tmp_name'], $uploadedFilePath)) {
                echo "File uploaded successfully.";
            } else {
                echo "File upload failed, please try again.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    }

    $nama = $_POST['nama_lengkap'];
    $nrp = $_POST['nrp'];
    $jurusan = $_POST['jurusan'];
    $semester = $_POST['semester'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $asal_sma = $_POST['asal_sma'];
    $username = $_SESSION['username'];
    $sql = "UPDATE akun SET 
                nama_lengkap='$nama', 
                nrp='$nrp', 
                jurusan='$jurusan', 
                semester='$semester', 
                kelas='$kelas', 
                alamat='$alamat', 
                no_hp='$no_hp', 
                asal_sma='$asal_sma',
                pp_file='$uploadedFilePath'
            WHERE username='$username'";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "Update successful. Redirecting...";
            header("Location: ../main/home.php");
        } else {
            echo "No changes were made.";
        }
    } else {
        echo "Error updating record: " . mysqli_error($conn);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>RajaNgoding</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fileInput = document.querySelector('input[name="pp_file"]');
            var previewImage = document.querySelector('.profile img');

            fileInput.addEventListener('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

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

    <!-- EDIT FORM -->
    <div class="frame edit">
        <div class="isi-edit">
            <form action="edit.php" method="post" id="editForm" enctype="multipart/form-data">
                <div class="profile">
                    <img src="<?php echo $user['pp_file']; ?>" alt="">
                    <label class="editButton">
                        <input type="file" name="pp_file">
                        <span><i class="fa-solid fa-pen"></i></span>
                    </label>
                    <h1><?php echo '@' . $_SESSION['username'] ?></h1>
                </div>
                <div class="insertData">
                    <div class="formContent">
                        Nama Lengkap :
                        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $user['nama_lengkap'] ?? ''; ?>" required>
                    </div>
                    <div class="formContent">
                        NRP :
                        <input type="text" name="nrp" placeholder="NRP" value="<?php echo $user['nrp']; ?>" required>
                    </div>
                    <br>
                    <div class="formContent selection">
                        <select name="jurusan" required>
                            <option value="" disabled hidden <?php echo empty($user['jurusan']) ? 'selected' : ''; ?>>Jurusan</option>
                            <option value="D4 Teknik Informatika" <?php echo $user['jurusan'] == 'D4 Teknik Informatika' ? 'selected' : ''; ?>>D4 Teknik Informatika</option>
                            <option value="D3 Teknik Informatika" <?php echo $user['jurusan'] == 'D3 Teknik Informatika' ? 'selected' : ''; ?>>D3 Teknik Informatika</option>
                            <option value="D4 Sains Data Terapan" <?php echo $user['jurusan'] == 'D4 Sains Data Terapan' ? 'selected' : ''; ?>>D4 Sains Data Terapan</option>
                        </select>
                        <select name="semester" required>
                            <option value="" disabled hidden <?php echo empty($user['semester']) ? 'selected' : ''; ?>>Semester</option>
                            <?php for ($i = 1; $i <= 8; $i++) : ?>
                                <option value="<?php echo $i; ?>" <?php echo (int)$user['semester'] === $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        <select name="kelas" required>
                            <option value="" disabled hidden <?php echo empty($user['kelas']) ? 'selected' : ''; ?>>Kelas</option>
                            <option value="A" <?php echo $user['kelas'] == 'A' ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?php echo $user['kelas'] == 'B' ? 'selected' : ''; ?>>B</option>
                            <option value="C" <?php echo $user['kelas'] == 'C' ? 'selected' : ''; ?>>C</option>
                            <option value="D" <?php echo $user['kelas'] == 'D' ? 'selected' : ''; ?>>D</option>
                        </select>
                    </div>
                    <br>
                    <div class="formContent">
                        Alamat :
                        <textarea name="alamat" id="" placeholder="Alamat"><?php echo htmlspecialchars($user['alamat']); ?></textarea>

                    </div>
                    <div class="formContent">
                        No HP :
                        <input type="text" name="no_hp" placeholder="Nomor Telepon" value="<?php echo $user['no_hp']; ?>">
                    </div>
                    <div class="formContent">
                        Asal SMA :
                        <input type="text" name="asal_sma" placeholder="Asal Sekolah" value="<?php echo $user['asal_sma']; ?>">
                    </div>
                </div>
                <div class="formButton">
                    <a href="../main/home.php">Batal</a>
                    <input name="btn" type="submit" id="btn" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</body>

</html>