<?php
include_once '../../classes/Database.php';
include_once '../../classes/Pasien.php';

$database = new Database();
$db = $database->getConnection();

$pasien = new Pasien($db);

$stmt = $pasien->read();
$num = $stmt->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <meta charset="UTF-8">
    <title>CRUD PASIEN</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>CRUD DATA PASIEN</h1>
            <p class="tes_p">Fitria Yosefina Rossa Waroy (215410067)</p>
        </header>
        <nav>
            <ul class="nav-list">
                <li class="nav-item"><a href="../../index.php">HOME</a></li>
                <li class="nav-item"><a href="read_pasien.php">PASIEN</a></li>
                <li class="nav-item"><a href="../dokter/read_dokter.php">DOKTER</a></li>
                <li class="nav-item"><a href="../rawat/read_rawat.php">RAWAT</a></li>
            </ul>
        </nav>
        <main>
            <h2>DATA PASIEN</h2>
            <a class="a" href="create_pasien.php">Tambah Pasien</a>
            <?php if ($num > 0): ?>
                <div class="data-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pasien</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>HP</th>
                                <th>Riwayat Medis</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id_pasien']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($row['umur']); ?></td>
                                    <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                    <td><?php echo htmlspecialchars($row['hp']); ?></td>
                                    <td><?php echo htmlspecialchars($row['riwayat_medis']); ?></td>
                                    <td>
                                        <a class="a-edit" href="update_pasien.php?id=<?php echo $row['id_pasien']; ?>">Edit</a> 
                                        <a class="a-hapus" href="delete_pasien.php?id=<?php echo $row['id_pasien']; ?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>Tidak ada data pasien.</p>
            <?php endif; ?>
        </main>
    </div> <!-- Penutup container -->
</body>
</html>
