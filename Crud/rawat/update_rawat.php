<?php
include_once '../../classes/Database.php';
include_once '../../classes/Rawat.php';

$database = new Database();
$db = $database->getConnection();

$rawat = new Rawat($db);

$message = "";

// Ambil data rawat untuk mengisi form
if (isset($_GET['id'])) {
    $rawat->id_rawat = $_GET['id'];
    $stmt = $rawat->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $rawat->id_pasien = $row['id_pasien'];
        $rawat->id_dokter = $row['id_dokter'];
        $rawat->diagnosis = $row['diagnosis'];
        $rawat->obat = $row['obat'];
        $rawat->tgl_rawat = $row['tgl_rawat'];
    } else {
        $message = "Rawat tidak ditemukan.";
    }
}

// Proses update data rawat
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rawat->id_rawat = $_POST['id_rawat'];
    $rawat->id_pasien = $_POST['id_pasien'];
    $rawat->id_dokter = $_POST['id_dokter'];
    $rawat->diagnosis = $_POST['diagnosis'];
    $rawat->obat = $_POST['obat'];
    $rawat->tgl_rawat = $_POST['tgl_rawat'];

    if ($rawat->update()) {
        $message = "Rawat updated successfully.";
    } else {
        $message = "Unable to update rawat.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Rawat</title>
    <link rel="stylesheet" href="../update1.css"> <!-- Ganti dengan path yang sesuai -->
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <h2>Update Rawat</h2>
        <form action="update_rawat.php" method="post">
            <input type="hidden" name="id_rawat" value="<?php echo htmlspecialchars($rawat->id_rawat, ENT_QUOTES, 'UTF-8'); ?>" />
            <label>ID Rawat: <?php echo htmlspecialchars($rawat->id_rawat, ENT_QUOTES, 'UTF-8'); ?></label><br>
            <input type="text" name="id_pasien" placeholder="ID Pasien" value="<?php echo htmlspecialchars($rawat->id_pasien, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="id_dokter" placeholder="ID Dokter" value="<?php echo htmlspecialchars($rawat->id_dokter, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="diagnosis" placeholder="Diagnosis" value="<?php echo htmlspecialchars($rawat->diagnosis, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="obat" placeholder="Obat" value="<?php echo htmlspecialchars($rawat->obat, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="date" name="tgl_rawat" placeholder="Tanggal Rawat" value="<?php echo htmlspecialchars($rawat->tgl_rawat, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="submit" value="Update Rawat" />
        </form>
        <a class="kembali" href="read_rawat.php">Kembali</a>
    </div>
</body>
</html>
