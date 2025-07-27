<?php
include_once '../../classes/Database.php';
include_once '../../classes/Dokter.php';

$database = new Database();
$db = $database->getConnection();

$dokter = new Dokter($db);

$message = "";

// Ambil data dokter untuk mengisi form
if (isset($_GET['id'])) {
    $dokter->id_dokter = $_GET['id'];
    $stmt = $dokter->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $dokter->nama = $row['nama'];
        $dokter->spesialis = $row['spesialis'];
        $dokter->alamat = $row['alamat'];
        $dokter->hp = $row['hp'];
    } else {
        $message = "Dokter tidak ditemukan.";
    }
}

// Proses update data dokter
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dokter->id_dokter = $_POST['id_dokter'];
    $dokter->nama = $_POST['nama'];
    $dokter->spesialis = $_POST['spesialis'];
    $dokter->alamat = $_POST['alamat'];
    $dokter->hp = $_POST['hp'];

    if ($dokter->update()) {
        $message = "Dokter updated successfully.";
    } else {
        $message = "Unable to update dokter.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Dokter</title>
    <link rel="stylesheet" href="../update1.css"> <!-- Ganti dengan path yang sesuai -->
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <h2>Update Dokter</h2>
        <form action="update_dokter.php" method="post">
            <input type="hidden" name="id_dokter" value="<?php echo htmlspecialchars($dokter->id_dokter, ENT_QUOTES, 'UTF-8'); ?>" />
            <label>ID Dokter: <?php echo htmlspecialchars($dokter->id_dokter, ENT_QUOTES, 'UTF-8'); ?></label><br>
            <input type="text" name="nama" placeholder="Nama" value="<?php echo htmlspecialchars($dokter->nama, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="spesialis" placeholder="Spesialis" value="<?php echo htmlspecialchars($dokter->spesialis, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="alamat" placeholder="Alamat" value="<?php echo htmlspecialchars($dokter->alamat, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="hp" placeholder="HP" value="<?php echo htmlspecialchars($dokter->hp, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="submit" value="Update Dokter" />
        </form>
        <a class="kembali" href="read_dokter.php">Kembali</a>
    </div>
</body>
</html>
