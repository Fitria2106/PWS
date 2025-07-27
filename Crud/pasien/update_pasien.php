<?php
include_once '../../classes/Database.php';
include_once '../../classes/Pasien.php';

$database = new Database();
$db = $database->getConnection();

$pasien = new Pasien($db);

$message = "";

// Ambil data pasien untuk mengisi form
if (isset($_GET['id'])) {
    $pasien->id_pasien = $_GET['id'];
    $stmt = $pasien->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $pasien->nama = $row['nama'];
        $pasien->umur = $row['umur'];
        $pasien->jenis_kelamin = $row['jenis_kelamin'];
        $pasien->alamat = $row['alamat'];
        $pasien->hp = $row['hp'];
        $pasien->riwayat_medis = $row['riwayat_medis'];
    } else {
        $message = "Pasien tidak ditemukan.";
    }
}

// Proses update data pasien
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pasien->id_pasien = $_POST['id_pasien'];
    $pasien->nama = $_POST['nama'];
    $pasien->umur = $_POST['umur'];
    $pasien->jenis_kelamin = $_POST['jenis_kelamin'];
    $pasien->alamat = $_POST['alamat'];
    $pasien->hp = $_POST['hp'];
    $pasien->riwayat_medis = $_POST['riwayat_medis'];

    if ($pasien->update()) {
        $message = "Pasien updated successfully.";
    } else {
        $message = "Unable to update pasien.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pasien</title>
    <link rel="stylesheet" href="../update1.css"> <!-- Ganti dengan path yang sesuai -->
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <h2>Update Pasien</h2>
        <form action="update_pasien.php" method="post">
            <input type="hidden" name="id_pasien" value="<?php echo htmlspecialchars($pasien->id_pasien, ENT_QUOTES, 'UTF-8'); ?>" />
            <label>ID Pasien: <?php echo htmlspecialchars($pasien->id_pasien, ENT_QUOTES, 'UTF-8'); ?></label><br>
            <input type="text" name="nama" placeholder="Nama" value="<?php echo htmlspecialchars($pasien->nama, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="number" name="umur" placeholder="Umur" value="<?php echo htmlspecialchars($pasien->umur, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo htmlspecialchars($pasien->jenis_kelamin, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="alamat" placeholder="Alamat" value="<?php echo htmlspecialchars($pasien->alamat, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="hp" placeholder="HP" value="<?php echo htmlspecialchars($pasien->hp, ENT_QUOTES, 'UTF-8'); ?>" required />
            <input type="text" name="riwayat_medis" placeholder="Riwayat Medis" value="<?php echo htmlspecialchars($pasien->riwayat_medis, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" value="Update Pasien" />
        </form>
        <a class="kembali" href="read_pasien.php">Kembali</a>
    </div>
</body>
</html>
