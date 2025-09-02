<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $nama = $_POST['nama'];
    $sekolah = $_POST['sekolah'];
    $jurusan = $_POST['jurusan'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO siswa (nama,sekolah,jurusan,no_hp,alamat) VALUES ('$nama',
    '$sekolah','$jurusan','$no_hp','$alamat')";

    if($conn->query($sql)===TRUE){
        header('Location: index.php');
        exit();
    } else {
        echo "Error: ".$sql."<br>".$conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <link rel="stylesheet" href="includes/style.css">
    <style>
        input[type="text"] {
            padding: 10px; 
            width: calc(100% - 22px); 
            margin-bottom: 20px; 
            border: 1px solid #ccc; 
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 15px; 
            border: none; 
            border-radius: 4px; 
            background-color: #4CAF50; 
            color: white; 
            cursor: pointer; 
            width: 100%;
        }
        input[type="submit"]:hover { 
            background-color: #45a049; 
        }
    </style>
</head>
<body>
    <div class="container-2">
        <h2>Tambah Data Siswa</h2>
        <form action="" method="post">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required>

            <label for="sekolah">Sekolah:</label>
            <input type="text" name="sekolah" required>

            <label for="jurusan">Jurusan:</label>
            <input type="text" name="jurusan" required>

            <label for="no_hp">No HP:</label>
            <input type="text" name="no_hp" required>

            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" required>

            <input type="submit" value="Tambah">
        </form>
        <div class="back-link">
            <a href="index.php">Kembali ke Daftar Siswa</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>