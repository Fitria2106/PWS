<?php
// Include Database and Dokter classes
include_once '../../Classes/Database.php';
include_once '../../Classes/Dokter.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Initialize Dokter object
$dokter = new Dokter($db);

// Read dokter data
$stmt = $dokter->read();
$num = $stmt->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta charset="UTF-8">
    <title>Data Dokter</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>CRUD DATA DOKTER</h1>
        <p class="tes_p">Fitria Yosefina Rossa Waroy (215410067)</p>
    </header>
    <nav>
        <ul class="nav-list">
            <li class="nav-item"><a href="../../index.php">HOME</a></li>
            <li class="nav-item"><a href="../pasien/read_pasien.php">PASIEN</a></li>
            <li class="nav-item"><a href="read_dokter.php">DOKTER</a></li>
            <li class="nav-item"><a href="../rawat/read_rawat.php">RAWAT</a></li>
        </ul>
    </nav>
    <main>
        <h2>DATA DOKTER</h2>
        <a class="a" href="create_dokter.php">Tambah Dokter</a>     
        <?php if ($num > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Dokter</th>
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th>Alamat</th>
                        <th>HP</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_dokter']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['spesialis']); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                            <td><?php echo htmlspecialchars($row['hp']); ?></td>
                            <td>
                                <a class="a-edit" href="update_dokter.php?id=<?php echo $row['id_dokter']; ?>">Edit</a> 
                                <a class="a-hapus" href="delete_dokter.php?id=<?php echo $row['id_dokter']; ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data dokter.</p>
        <?php endif; ?>
    </main>
</div> <!-- Penutup container -->
</body>
</html>
