<?php
include_once '../../classes/Database.php';
include_once '../../classes/Dokter.php';

$database = new Database();
$db = $database->getConnection();

$dokter = new Dokter($db);

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dokter->id_dokter = $_POST['id_dokter'];
    $dokter->nama = $_POST['nama'];
    $dokter->spesialis = $_POST['spesialis'];
    $dokter->alamat = $_POST['alamat'];
    $dokter->hp = $_POST['hp'];

    if($dokter->create()) {
        header('location: read_dokter.php');
    } else {
        $message = "Unable to create dokter.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Dokter</title>
    <link rel="stylesheet" href="../create.css"> <!-- Ganti dengan path yang sesuai -->
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <h2>Create Dokter</h2>
        <form action="create_dokter.php" method="post">
            <input type="text" name="id_dokter" placeholder="ID Dokter" required />
            <input type="text" name="nama" placeholder="Nama" required />
            <input type="text" name="spesialis" placeholder="Spesialis" required />
            <input type="text" name="alamat" placeholder="Alamat" required />
            <input type="text" name="hp" placeholder="HP" required />
            <input type="submit" value="Create Dokter" />
        </form>
        <a class="kembali" href="read_dokter.php">Kembali</a>
    </div>
</body>
</html>
