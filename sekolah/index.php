<?php
include 'config.php';

$search = '';
if (isset($_POST['search'])){
    $search = $_POST['search'];
}

$sql = "SELECT * FROM siswa WHERE nama LIKE '%$search%' OR sekolah LIKE '%$search%' OR jurusan LIKE '$search'";
$result = $conn->query($sql);

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM siswa WHERE id=$id");
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="includes/style.css?v=2">
</head>
<body>
    <div class="container-1">
        <h2>Daftar Siswa</h2>
        <form action="" method="post">
            <input type="text" name="search" value="<?= htmlspecialchars($search);?>" placeholder="Cari siswa" required>
            <input type="submit" value="Cari">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Sekolah</th>
                <th>Jurusan</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['nama']."</td>";
                    echo "<td>".$row['sekolah']."</td>";
                    echo "<td>".$row['jurusan']."</td>";
                    echo "<td>".$row['no_hp']."</td>";
                    echo "<td>".$row['alamat']."</td>";
                    echo "<td>
                        <a href='update.php?id=".$row["id"]."'><button>Edit</button></a>
                        <a href='index.php?delete=".$row["id"]."' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'><button>Hapus</button></a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
            }
            ?>
        </table>
        <a href="create.php"><button>Tambah Data Siswa</button></a>
    </div>
</body>
</html>
<?php
$conn->close();
?>
