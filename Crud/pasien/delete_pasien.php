<?php
include_once '../../classes/Database.php';
include_once '../../classes/Pasien.php';

$database = new Database();
$db = $database->getConnection();

$pasien = new Pasien($db);

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_pasien'])) {
    $pasien->id_pasien = $_POST['id_pasien'];

    if ($pasien->delete()) {
        $message = "Pasien berhasil dihapus.";
        echo '<a class="btn btn-secondary" href="read_pasien.php">Kembali</a>';
    } else {
        $message = "Gagal menghapus pasien.";
    }
}

// Ambil data pasien untuk konfirmasi
if (isset($_GET['id'])) {
    $pasien->id_pasien = $_GET['id'];

    // Ambil data pasien berdasarkan ID
    $stmt = $pasien->read();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nama_pasien = htmlspecialchars($row['nama']);
        $id_pasien = htmlspecialchars($row['id_pasien']);
    } else {
        $message = "Pasien tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Penghapusan Pasien</title>
    <link rel="stylesheet" href="../confirm.css">
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if (isset($num) && $num > 0): ?>
            <h2>Konfirmasi Delete Pasien</h2>
            <p>Apakah Anda yakin ingin menghapus pasien dengan ID: <?php echo $id_pasien; ?> - <?php echo $nama_pasien; ?>?</p>
            <form action="delete_pasien.php" method="post">
                <input type="hidden" name="id_pasien" value="<?php echo $id_pasien; ?>" />
                <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                <a href="read_pasien.php" class="btn btn-secondary">Tidak</a>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
