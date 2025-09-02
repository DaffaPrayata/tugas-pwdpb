<?php
include 'koneksi.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM modul WHERE id = $id";
    $result = $koneksi->query($query);
    $data = $result->fetch_assoc();
} else {
    echo "ID tidak ditemukan";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
</head>
<body>
    <h2>Edit Data Siswa</h2>
    <form action="proses_edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= $data['nama']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?= $data['email']; ?>" required><br><br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" id="alamat" required><?= $data['alamat']; ?></textarea><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>