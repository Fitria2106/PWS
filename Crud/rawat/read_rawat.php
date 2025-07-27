<?php
// Include necessary classes
include_once '../../classes/Database.php';
include_once '../../classes/Rawat.php';

$database = new Database();
$db = $database->getConnection();

$rawat = new Rawat($db);

$stmt = $rawat->read();
$num = $stmt->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head><meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta charset="UTF-8">
    <title>CRUD RAWAT</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>CRUD RAWAT</h1>
            <p class="tes_p">Fitria Yosefina Rossa Waroy (215410067)</p>
        </header>
        <nav>
            <ul class="nav-list">
                <li class="nav-item"><a href="../../index.php">HOME</a></li>
                <li class="nav-item"><a href="../pasien/read_pasien.php">PASIEN</a></li>
                <li class="nav-item"><a href="../dokter/read_dokter.php">DOKTER</a></li>         
                <li class="nav-item"><a href="read_rawat.php">RAWAT</a></li>
            </ul>
        </nav>
        <main>
            <h2>DATA RAWAT</h2>
            <a class="a" href="create_rawat.php">Tambah Data</a>
            <?php if ($num > 0): ?>
                <table border='1'>
                    <tr>
                        <th>ID Rawat</th>
                        <th>ID Pasien</th>
                        <th>ID Dokter</th>
                        <th>Diagnosis</th>
                        <th>Obat</th>
                        <th>Tanggal Rawat</th>
                        <th>Opsi</th>
                    </tr>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_rawat']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_pasien']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_dokter']); ?></td>
                            <td><?php echo htmlspecialchars($row['diagnosis']); ?></td>
                            <td><?php echo htmlspecialchars($row['obat']); ?></td>
                            <td><?php echo htmlspecialchars($row['tgl_rawat']); ?></td>
                            <td>
                                <a class="a-edit" href="update_rawat.php?id=<?php echo $row['id_rawat']; ?>">Edit</a> 
                                <a class="a-hapus" href="delete_rawat.php?id=<?php echo $row['id_rawat']; ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Tidak ada data rawat.</p>
            <?php endif; ?>
        </main>
    </div> <!-- Penutup container -->
</body>
</html>