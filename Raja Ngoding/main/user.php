<?php include 'header.php'; ?>
<?php
include '../library/config.php';
include '../library/opendb.php';

$username = $_SESSION['username'];
$sql = "SELECT username, nrp, nama_lengkap, jurusan, semester, kelas, alamat, no_hp, asal_sma, pp_file FROM akun WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $nama = $user['nama_lengkap'];
    $nrp = $user['nrp'];
    $jurusan = $user['jurusan'];
    $semester = $user['semester'];
    $kelas = $user['kelas'];
    $alamat = $user['alamat'];
    $no_hp = $user['no_hp'];
    $asal_sma = $user['asal_sma'];
    $pp_file = $user['pp_file'];
}

mysqli_free_result($result);
include '../library/closedb.php'

?>

<div class="main">
    <div class="mainContent user">
        <div class="kiri">
            <div class="kiriContent">
                <img src="<?php echo $pp_file; ?>" alt="Profile Picture">
            </div>
            <br>
            <div class="kiriContent">
                <p><?php echo '@' . $_SESSION['username'] ?></p>
            </div>
            <br>
            <div class="kiriContent">
                <a href="../account/edit.php">Edit Profile <i class="fa-solid fa-pen"></i></a>
            </div>
        </div>
        <div class="kanan">
            <div class="kananRow">
                <div class="dataName">
                    <p>Nama Lengkap</p>
                </div>
                <p>:</p>
                <div class="data">
                    <p><?php echo $nama ?></p>
                </div>
            </div>
            <div class="kananRow">
                <div class="dataName">
                    <p>NRP</p>
                </div>
                <p>:</p>
                <div class="data">
                    <p><?php echo $nrp ?></p>
                </div>
            </div>
            <div class="kananRow">
                <div class="dataName">
                    <p>Jurusan</p>
                </div>
                <p>:</p>
                <div class="data">
                    <p><?php echo $jurusan ?></p>
                </div>
            </div>
            <div class="kananRow">
                <div class="dataName">
                    <p>Semester</p>
                </div>
                <p>:</p>
                <div class="data">
                    <p><?php echo $semester ?></p>
                </div>
            </div>
            <div class="kananRow">
                <div class="dataName">
                    <p>Kelas</p>
                </div>
                <p>:</p>
                <div class="data">
                    <p><?php echo $kelas ?></p>
                </div>
            </div>
            <div class="kananRow">
                <div class="dataName">
                    <p>Alamat</p>
                </div>
                <p>:</p>
                <div class="data">
                    <p><?php echo $alamat ?></p>
                </div>
            </div>
            <div class="kananRow">
                <div class="dataName">
                    <p>No HP</p>
                </div>
                <p>:</p>
                <div class="data">
                    <p><?php echo $no_hp ?></p>
                </div>
            </div>
            <div class="kananRow">
                <div class="dataName">
                    <p>Asal SMA</p>
                </div>
                <p>:</p>
                <div class="data">
                    <p><?php echo $asal_sma ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>