<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRUD Mahasiswa</title>
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
    <h2>CRUD Mahasiswa</h2>

    <div class="form-container">
        <form action="" method="post">
            <label for="npm">NPM:</label><br>
            <input type="text" id="npm" name="npm" placeholder="NPM" required><br><br>

            <label for="namaMhs">Nama Mahasiswa:</label><br>
            <input type="text" id="namaMhs" name="namaMhs" placeholder="Nama Mahasiswa" required><br><br>

            <label for="prodi">Program Studi:</label><br>
            <input type="text" id="prodi" name="prodi" placeholder="Program Studi" required><br><br>

            <label for="alamat">Alamat:</label><br>
            <input type="text" id="alamat" name="alamat" placeholder="Alamat" required><br><br>

            <label for="noHP">Nomor HP:</label><br>
            <input type="text" id="noHP" name="noHP" placeholder="Nomor HP" required><br><br>

            <!-- Tambahkan input tersembunyi untuk tombol edit -->
            <input type="hidden" name="edit_submit" value="1">
            <!-- Ubah atribut name pada tombol edit -->
            <input type="submit" name="edit_submit" value="Simpan">
        </form>
    </div>

    <?php
    // Memanggil file koneksi
    require_once "koneksi.php";

    // Tambah data
    if (isset($_POST['submit'])) {
        $npm = $_POST['npm'];
        $namaMhs = $_POST['namaMhs'];
        $prodi = $_POST['prodi'];
        $alamat = $_POST['alamat'];
        $noHP = $_POST['noHP'];

        $sql_insert = "INSERT INTO t_mahasiswa (npm, namaMhs, prodi, alamat, noHP) VALUES ('$npm', '$namaMhs', '$prodi', '$alamat', '$noHP')";
        if (mysqli_query($link, $sql_insert)) {
            echo "<p>Data mahasiswa berhasil ditambahkan.</p>";
        } else {
            echo "<p>Error: " . $sql_insert . "<br>" . mysqli_error($link) . "</p>";
        }
    }

    // Hapus data
    if (isset($_GET['hapus'])) {
        $npm = $_GET['hapus'];

        $sql_delete = "DELETE FROM t_mahasiswa WHERE npm='$npm'";
        if (mysqli_query($link, $sql_delete)) {
            echo "<p>Data mahasiswa berhasil dihapus.</p>";
        } else {
            echo "<p>Error: " . $sql_delete . "<br>" . mysqli_error($link) . "</p>";
        }
    }

    // Tampilkan data
    $sql_select = "SELECT * FROM t_mahasiswa";
    $result = mysqli_query($link, $sql_select);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>NPM</th><th>Nama Mahasiswa</th><th>Prodi</th><th>Alamat</th><th>No HP</th><th>Aksi</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["npm"] . "</td>";
            echo "<td>" . $row["namaMhs"] . "</td>";
            echo "<td>" . $row["prodi"] . "</td>";
            echo "<td>" . $row["alamat"] . "</td>";
            echo "<td>" . $row["noHP"] . "</td>";
            echo "<td><a class='edit-btn' href='editmahasiswa.php?npm=" . $row["npm"] . "'>Edit</a> <a class='delete-btn' href='mahasiswa.php?hapus=" . $row["npm"] . "'>Hapus</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Menutup koneksi
    mysqli_close($link);
    ?>
</div>

</body>
</html>
