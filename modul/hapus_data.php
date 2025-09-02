<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM modul WHERE id = $id";

    if ($koneksi->query($query) === TRUE) {
        echo "Data berhasil dihapus";
        echo "<br><a href='index.php'>Kembali ke Data Siswa</a>";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
} else {
    echo "ID tidak ditemukan!";
}
?>