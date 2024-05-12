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
                    <td>Mata Kuliah</td>
                    <td>Nama File</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../library/config.php';
                include '../library/opendb.php';

                $sql = "SELECT akun.*, files.* FROM akun INNER JOIN files ON akun.username = files.username";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='mid'>" . $no++ . "</td>";
                        echo "<td class='notMid'><a href='otherUser.php?username=" . urlencode($row['username']) . "'>@" . $row['username'] . "</a></td>";
                        echo "<td class='mid'>" . $row['nrp'] . "</td>";
                        echo "<td class='notMid'>" . $row['nama_lengkap'] . "</a></td>";
                        echo "<td class='mid'>" . $row['matkul'] . "</td>";
                        echo "<td class='mid'>" . $row['filename'] . "</td>";
                        echo "<td class='mid'><a class='download' href='download.php?file=" . urlencode($row['path']) . "'>Download</a></td>";
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