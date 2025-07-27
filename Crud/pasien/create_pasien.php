<?php
include_once '../../classes/Database.php';
include_once '../../classes/Pasien.php';

$database = new Database();
$db = $database->getConnection();

$pasien = new Pasien($db);

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pasien->id_pasien = $_POST['id_pasien'];
    $pasien->nama = $_POST['nama'];
    $pasien->umur = $_POST['umur'];
    $pasien->jenis_kelamin = $_POST['jenis_kelamin'];
    $pasien->alamat = $_POST['alamat'];
    $pasien->hp = $_POST['hp'];
    $pasien->riwayat_medis = $_POST['riwayat_medis'];

    if($pasien->create()) {
        $message = "Pasien created successfully.";
    } else {
        $message = "Unable to create pasien.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pasien</title>
    <link rel="stylesheet" href="../create.css"> <!-- Ganti dengan path yang sesuai -->
</head>
<body>
    <div class="container">
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <h2>Create Pasien</h2>
        <form action="create_pasien.php" method="post">
            <input type="text" name="id_pasien" placeholder="ID Pasien" required />
            <input type="text" name="nama" placeholder="Nama" required />
            <input type="number" name="umur" placeholder="Umur" required />
            <select name="jenis_kelamin" required>
                <option value="" disabled selected>Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
                <option value="Lain">Lainnya</option>
            </select>
            <select name="riwayat_medis" required>
                <option value="" disabled selected>- Riwayat Medis -</option>
                <option value="Ada">Ada</option>
                <option value="Tidak Ada">Tidak Ada</option>
            </select>
            <input type="text" name="alamat" placeholder="Alamat" required />
            <input type="text" name="hp" placeholder="HP" required />
            
            <input type="submit" value="Tambah Pasien" />
        </form>
        <a class="kembali" href="read_pasien.php">Kembali</a>
    </div>
</body>
</html>
