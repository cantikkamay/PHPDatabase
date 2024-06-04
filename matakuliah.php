<?php
// Memanggil file koneksi
require_once "koneksi.php";

// Fungsi untuk mendapatkan data matakuliah dari database
function getMataKuliah()
{
    global $link;
    $sql_select = "SELECT * FROM t_matakuliah";
    $result = mysqli_query($link, $sql_select);
    $mataKuliah = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $mataKuliah[] = $row;
        }
    }
    return $mataKuliah;
}

// Fungsi untuk menambahkan data matakuliah ke database
function tambahMataKuliah($kodeMK, $namaMK, $sks, $jam)
{
    global $link;
    $sql_insert = "INSERT INTO t_matakuliah (kodeMK, namaMK, sks, jam) VALUES ('$kodeMK', '$namaMK', '$sks', '$jam')";
    return mysqli_query($link, $sql_insert);
}

// Fungsi untuk mengedit data matakuliah di database
function editMataKuliah($kodeMK, $namaMK, $sks, $jam)
{
    global $link;
    $sql_update = "UPDATE t_matakuliah SET namaMK='$namaMK', sks='$sks', jam='$jam' WHERE kodeMK='$kodeMK'";
    return mysqli_query($link, $sql_update);
}

// Fungsi untuk menghapus data matakuliah dari database
function hapusMataKuliah($kodeMK)
{
    global $link;
    $sql_delete = "DELETE FROM t_matakuliah WHERE kodeMK='$kodeMK'";
    return mysqli_query($link, $sql_delete);
}

// Proses tambah data matakuliah
if (isset($_POST['tambah'])) {
    $kodeMK = $_POST['kodeMK'];
    $namaMK = $_POST['namaMK'];
    $sks = $_POST['sks'];
    $jam = $_POST['jam'];
    tambahMataKuliah($kodeMK, $namaMK, $sks, $jam);
}

// Proses edit data matakuliah
if (isset($_POST['edit'])) {
    $kodeMK = $_POST['kodeMK'];
    $namaMK = $_POST['namaMK'];
    $sks = $_POST['sks'];
    $jam = $_POST['jam'];
    editMataKuliah($kodeMK, $namaMK, $sks, $jam);
}

// Proses hapus data matakuliah
if (isset($_GET['hapus'])) {
    $kodeMK = $_GET['hapus'];
    hapusMataKuliah($kodeMK);
}

// Memanggil fungsi untuk mendapatkan data matakuliah
$mataKuliah = getMataKuliah();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRUD Matakuliah</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        color: #333;
    }
    form {
        margin-bottom: 20px;
    }
    .form-container {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
    }
    input[type="text"], input[type="number"], input[type="submit"] {
        width: calc(100% - 22px);
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .edit-btn, .delete-btn {
        background-color: #008CBA;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 5px;
    }
    .edit-btn:hover, .delete-btn:hover {
        background-color: #005f6b;
    }
</style>
</head>
<body>

<div class="container">
    <h2>CRUD Matakuliah</h2>

    <form action="" method="post">
    <div class="form-container">
        <label for="kodeMK">Kode MK:</label><br>
        <input type="text" id="kodeMK" name="kodeMK" required><br>
        <label for="namaMK">Nama MK:</label><br>
        <input type="text" id="namaMK" name="namaMK" required><br>
        <label for="sks">SKS:</label><br>
        <input type="number" id="sks" name="sks" required><br>
        <label for="jam">Jam:</label><br>
        <input type="number" id="jam" name="jam" required><br><br>
        <input type="submit" name="tambah" value="Tambah">
    </div>
    </form>

    <?php if (!empty($mataKuliah)) : ?>
    <table>
        <tr>
            <th>Kode MK</th>
            <th>Nama Matakuliah</th>
            <th>SKS</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($mataKuliah as $mk) : ?>
        <tr>
            <td><?php echo $mk['kodeMK']; ?></td>
            <td><?php echo $mk['namaMK']; ?></td>
            <td><?php echo $mk['sks']; ?></td>
            <td><?php echo $mk['jam']; ?></td>
            <td>
                <a class="edit-btn" href="editmatakuliah.php?kodeMK=<?php echo $mk['kodeMK']; ?>">Edit</a>
                <a class="delete-btn" href="?hapus=<?php echo $mk['kodeMK']; ?>">Hapus</a>
            </td>
        </tr
        <?php endforeach; ?>
    </table>
    <?php else : ?>
    <p>Tidak ada data matakuliah.</p>
    <?php endif; ?>
</div>

</body>
</html>
