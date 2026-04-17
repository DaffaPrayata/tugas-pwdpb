<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$harga = [
    'GRD' => [
        'nama' => 'Garuda',
        'Eksekutif' => 1500000,
        'Bisnis' => 900000,
        'Ekonomi' => 500000
    ],
    'MPT' => [
        'nama' => 'Merpati',
        'Eksekutif' => 1200000,
        'Bisnis' => 800000,
        'Ekonomi' => 400000
    ],
    'BTV' => [
        'nama' => 'Batavia',
        'Eksekutif' => 1000000,
        'Bisnis' => 700000,
        'Ekonomi' => 300000
    ]
];

$result = null;

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $kode   = $_POST['kode'];
    $kelas  = $_POST['kelas'];
    $jumlah = (int)$_POST['jumlah'];

    $namaPesawat = $harga[$kode]['nama'];
    $hargaTiket  = $harga[$kode][$kelas];
    $totalBayar  = $hargaTiket * $jumlah;

    $result = [
        'nama' => $nama,
        'pesawat' => $namaPesawat,
        'kelas' => $kelas,
        'harga' => $hargaTiket,
        'jumlah' => $jumlah,
        'total' => $totalBayar
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Travelok Ticket</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
font-family:'DM Sans',sans-serif;
min-height:100vh;
background:linear-gradient(180deg,#0d1b3e,#305fa8,#84b6e8,#d9ecff);
display:flex;
justify-content:center;
align-items:center;
padding:30px;
}

.wrap{
width:100%;
max-width:950px;
display:grid;
grid-template-columns:1fr 1fr;
gap:25px;
}

.card{
background:rgba(8,18,40,.62);
backdrop-filter:blur(18px);
border:1px solid rgba(255,255,255,.15);
border-radius:22px;
padding:30px;
color:white;
box-shadow:0 25px 70px rgba(0,0,0,.35);
}

.brand{
font-family:'Playfair Display',serif;
font-size:28px;
margin-bottom:10px;
color:#f5e8c8;
}

.sub{
font-size:14px;
opacity:.7;
margin-bottom:25px;
}

label{
display:block;
font-size:13px;
margin-bottom:6px;
opacity:.8;
}

input,select{
width:100%;
padding:12px 14px;
border:none;
outline:none;
border-radius:10px;
margin-bottom:15px;
background:rgba(255,255,255,.08);
color:white;
}

option{
color:black;
}

.radio-box{
margin-bottom:15px;
line-height:1.9;
}

button{
padding:13px 18px;
border:none;
border-radius:10px;
cursor:pointer;
font-weight:600;
}

.btn{
background:linear-gradient(135deg,#e8c97d,#c8953a);
color:#111;
width:100%;
}

.btn:hover{
opacity:.9;
}

.logout{
display:inline-block;
margin-top:15px;
font-size:13px;
color:#f6d38f;
text-decoration:none;
}

.result p{
margin-bottom:12px;
padding-bottom:10px;
border-bottom:1px solid rgba(255,255,255,.08);
}

.total{
font-size:24px;
color:#ffd977;
font-weight:bold;
margin-top:20px;
}

@media(max-width:850px){
.wrap{
grid-template-columns:1fr;
}
}
</style>
</head>
<body>

<div class="wrap">

<div class="card">
<div class="brand">Travelok</div>
<div class="sub">Pesan tiket Jakarta ke Malaysia</div>

<form method="post">

<label>Nama Penumpang</label>
<input type="text" name="nama" required>

<label>Kode Pesawat</label>
<select name="kode">
<option value="GRD">GRD - Garuda</option>
<option value="MPT">MPT - Merpati</option>
<option value="BTV">BTV - Batavia</option>
</select>

<label>Kelas</label>
<div class="radio-box">
<input type="radio" name="kelas" value="Eksekutif" checked> Eksekutif<br>
<input type="radio" name="kelas" value="Bisnis"> Bisnis<br>
<input type="radio" name="kelas" value="Ekonomi"> Ekonomi
</div>

<label>Jumlah Tiket</label>
<select name="jumlah">
<?php
for($i=1;$i<=10;$i++){
echo "<option>$i</option>";
}
?>
</select>

<button class="btn" type="submit" name="simpan">Pesan Sekarang</button>

<a href="logout.php" class="logout">Logout</a>

</form>
</div>


<div class="card">

<div class="brand">Detail Ticket</div>
<div class="sub">Informasi pemesanan</div>

<?php if($result): ?>

<div class="result">
<p>Nama : <?= $result['nama']; ?></p>
<p>Pesawat : <?= $result['pesawat']; ?></p>
<p>Kelas : <?= $result['kelas']; ?></p>
<p>Harga : Rp <?= number_format($result['harga'],0,',','.'); ?></p>
<p>Jumlah : <?= $result['jumlah']; ?></p>

<div class="total">
Total Rp <?= number_format($result['total'],0,',','.'); ?>
</div>
</div>

<?php else: ?>

<p style="opacity:.7;">Belum ada pemesanan tiket.</p>

<?php endif; ?>

</div>

</div>

</body>
</html>