<?php
include_once '../../classes/Database.php';
include_once '../../classes/Rawat.php';

$database = new Database();
$db = $database->getConnection();

$rawat = new Rawat($db);

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_rawat'])) {
    $rawat->id_rawat = $_POST['id_rawat'];

    if ($rawat->delete()) {
        $message = "Rawat berhasil dihapus.";
        echo '<a class="btn btn-secondary" href="read_rawat.php">Kembali</a>';
    } else {
        $message = "Gagal menghapus rawat.";
    }
}

// Ambil data rawat untuk konfirmasi
if (isset($_GET['id'])) {
    $rawat->id_rawat = $_GET['id'];

    // Ambil data rawat berdasarkan ID
    $stmt = $rawat->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_rawat = htmlspecialchars($row['id_rawat']);
        $id_pasien = htmlspecialchars($row['id_pasien']);
        $id_dokter = htmlspecialchars($row['id_dokter']);
    } else {
        $message = "Rawat tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Penghapusan Rawat</title>
    <link rel="stylesheet" href="../confirm.css">
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if (isset($num) && $num > 0): ?>
            <h2>Konfirmasi Delete Rawat</h2>
            <p>Apakah Anda yakin ingin menghapus rawat dengan ID: <?php echo $id_rawat; ?>, ID Pasien: <?php echo $id_pasien; ?>, ID Dokter: <?php echo $id_dokter; ?>?</p>
            <form action="delete_rawat.php" method="post">
                <input type="hidden" name="id_rawat" value="<?php echo $id_rawat; ?>" />
                <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                <a href="read_rawat.php" class="btn btn-secondary">Tidak</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
