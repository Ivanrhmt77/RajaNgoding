<?php include 'header.php'; ?>

<div class="main">
    <div class="mainContent">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>username</td>
                    <td>NRP</td>
                    <td>Nama Lengkap</td>
                    <td>Jurusan</td>
                    <td>Semester</td>
                    <td>Kelas</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../library/config.php';
                include '../library/opendb.php';

                $sql = "SELECT username, nrp, nama_lengkap, jurusan, semester, kelas FROM akun ORDER BY nrp ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='mid'>" . $no++ . "</td>";
                        echo "<td class='notMid'><a href='otherUser.php?username=" . urlencode($row['username']) . "'>@" . $row['username'] . "</a></td>";
                        echo "<td class='mid'>" . $row['nrp'] . "</td>";
                        echo "<td class='notMid'>" . $row['nama_lengkap'] . "</a></td>";
                        echo "<td class='mid'>" . $row['jurusan'] . "</td>";
                        echo "<td class='mid'>" . $row['semester'] . "</td>";
                        echo "<td class='mid'>" . $row['kelas'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                }

                include  '../library/closedb.php'
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>