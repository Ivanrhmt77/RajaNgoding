<?php include 'header.php';
include '../library/config.php';
include '../library/opendb.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $sql = "SELECT * FROM akun WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $nama = $user['nama_lengkap'];
            $nrp = $user['nrp'];
            $jurusan = $user['jurusan'];
            $semester = $user['semester'];
            $kelas = $user['kelas'];
            $alamat = $user['alamat'];
            $no_hp = $user['no_hp'];
            $asal_sma = $user['asal_sma'];
            $pp_file = $user['pp_file'];
        } else {
            echo 'No records found.';
        }
        $stmt->close();
        $result->free();
    } else {
        echo "Failed to prepare statement: (" . $conn->errno . ") " . $conn->error;
    }

    include '../library/closedb.php';
} else {
    echo 'No username specified.';
}
?>

<div class="main">
    <div class="mainContent user">
        <div class="kiri">
            <div class="kiriContent">
                <img src="<?php echo $pp_file; ?>" alt="Profile Picture">
            </div>
            <br>
            <div class="kiriContent">
                <p><?php echo '@' . $username ?></p>
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