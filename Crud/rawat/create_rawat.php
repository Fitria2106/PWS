<?php
include_once '../../classes/Database.php';
include_once '../../classes/Rawat.php';

$database = new Database();
$db = $database->getConnection();

$rawat = new Rawat($db);

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rawat->id_pasien = $_POST['id_pasien'];
    $rawat->id_dokter = $_POST['id_dokter'];
    $rawat->diagnosis = $_POST['diagnosis'];
    $rawat->obat = $_POST['obat'];
    $rawat->tgl_rawat = $_POST['tgl_rawat'];

    if($rawat->create()) {
        $message = "Rawat created successfully.";
    } else {
        $message = "Unable to create rawat.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Rawat</title>
    <link rel="stylesheet" href="../create.css"> <!-- Ganti dengan path yang sesuai -->
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <h2>Create Rawat</h2>
        <form action="create_rawat.php" method="post">
            <input type="text" name="id_pasien" placeholder="ID Pasien" required />
            <input type="text" name="id_dokter" placeholder="ID Dokter" required />
            <input type="text" name="diagnosis" placeholder="Diagnosis" required />
            <input type="text" name="obat" placeholder="Obat" required />
            <input type="date" name="tgl_rawat" placeholder="Tanggal Rawat" required />
            <input type="submit" value="Create Rawat" />
        </form>
        <a class="kembali" href="read_rawat.php">Kembali</a>
    </div>
</body>
</html>
