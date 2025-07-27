<?php
include_once '../../classes/Database.php';
include_once '../../classes/Dokter.php';

$database = new Database();
$db = $database->getConnection();

$dokter = new Dokter($db);

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_dokter'])) {
    $dokter->id_dokter = $_POST['id_dokter'];

    if ($dokter->delete()) {
        $message = "Dokter berhasil dihapus.";
        echo '<a class="btn btn-secondary" href = "read_dokter.php"> Kembali </a> ';
    } else {
        $message = "Gagal menghapus dokter.";
    }
}

// Ambil data dokter untuk konfirmasi
if (isset($_GET['id'])) {
    $dokter->id_dokter = $_GET['id'];

    // Ambil data dokter berdasarkan ID
    $stmt = $dokter->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nama_dokter = htmlspecialchars($row['nama']);
        $id_dokter = htmlspecialchars($row['id_dokter']);
    } else {
        $message = "Dokter tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Penghapusan Dokter</title>
    <link rel="stylesheet" href="../confirm.css">
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if (isset($num) && $num > 0): ?>
            <h2>Konfirmasi Delete Dokter</h2>
            <p>Apakah Anda yakin ingin menghapus dokter dengan ID: <?php echo $id_dokter; ?> - <?php echo $nama_dokter; ?>?</p>
            <form action="delete_dokter.php" method="post">
                <input type="hidden" name="id_dokter" value="<?php echo $id_dokter; ?>" />
                <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                <a href="read_dokter.php" class="btn btn-secondary">Tidak</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
