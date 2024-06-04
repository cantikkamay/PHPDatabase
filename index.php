<?php
// Include file koneksi database
include 'koneksi.php';

// Inisialisasi variabel pencarian untuk dosen
$pencarianDosen = '';
if (isset($_GET['cariDosen'])) {
    $pencarianDosen = $_GET['cariDosen'];
}

// Query untuk mencari data dosen berdasarkan nama
$sqlDosen = "SELECT * FROM t_dosen WHERE namaDosen LIKE '%$pencarianDosen%'";
$resultDosen = mysqli_query($link, $sqlDosen);

if (!$resultDosen) {
    die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
}

// Inisialisasi variabel pencarian untuk mahasiswa
$pencarianMahasiswa = '';
if (isset($_GET['cariMahasiswa'])) {
    $pencarianMahasiswa = $_GET['cariMahasiswa'];
}

// Query untuk mencari data mahasiswa berdasarkan nama
$sqlMahasiswa = "SELECT npm, namaMhs, prodi, alamat, noHp FROM t_mahasiswa WHERE namaMhs LIKE '%$pencarianMahasiswa%'";
$resultMahasiswa = mysqli_query($link, $sqlMahasiswa);

if (!$resultMahasiswa) {
    die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
}

// Inisialisasi variabel pencarian untuk matakuliah
$pencarianMatakuliah = '';
if (isset($_GET['cariMatakuliah'])) {
    $pencarianMatakuliah = $_GET['cariMatakuliah'];
}

// Query untuk mencari data matakuliah berdasarkan nama
$sqlMatakuliah = "SELECT * FROM t_matakuliah WHERE namaMK LIKE '%$pencarianMatakuliah%'";
$resultMatakuliah = mysqli_query($link, $sqlMatakuliah);

if (!$resultMatakuliah) {
    die("Query Error: " . mysqli_errno($link) . " - " . mysqli_error($link));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen, Mahasiswa, dan Mata Kuliah</title>
    <style>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .container {
    max-width: 800px;
    width: 100%;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan */
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    a {
        text-decoration: none;
        color: #007bff;
        transition: color 0.3s;
    }

    a:hover {
        color: #0056b3;
    }

    input[type="text"], button {
        padding: 10px;
        margin-right: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Tombol tambah */
    .btn-add {
        display: inline-block;
        padding: 12px 24px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-add:hover {
        background-color: #218838;
    }

    /* Form pencarian */
    .search-form {
        margin-bottom: 20px;
        text-align: center;
    }

    .search-form input[type="text"],
    .search-form button {
        margin: 0;
    }
    </style>

</head>
<body>
    <h1>Data Dosen</h1>
    
    <!-- Form pencarian dosen -->
<form action="index.php" method="GET">
    <input type="text" name="cariDosen" placeholder="Cari dosen berdasarkan nama" value="<?php echo $pencarianDosen; ?>">
    <input type="hidden" name="searchType" value="dosen">
    <button type="submit">Cari</button>
</form>

    <!-- Tabel data dosen -->
    <table>
        <tr>
            <th>ID Dosen</th>
            <th>Nama Dosen</th>
            <th>Nomor HP</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Perulangan untuk menampilkan data dosen
        while ($data = mysqli_fetch_assoc($resultDosen)) {
            echo "<tr>";
            echo "<td>" . $data['idDosen'] . "</td>";
            echo "<td>" . $data['namaDosen'] . "</td>";
            echo "<td>" . $data['noHP'] . "</td>";
            echo '<td>
                    <a href="editdosen.php?idDosen=' . $data['idDosen'] . '">Edit</a> |
                    <a href="index.php?hapusDosen=' . $data['idDosen'] . '" onclick="return confirm(\'Anda yakin akan menghapus data ini?\')">Hapus</a>
                  </td>';
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Tombol tambah dosen -->
    <a href="input.php">Tambah Dosen</a>

    <h1>Data Mahasiswa</h1>
    
    <!-- Form pencarian mahasiswa -->
<form action="mahasiswa.php" method="GET">
    <input type="text" name="cariMahasiswa" placeholder="Cari mahasiswa berdasarkan nama" value="<?php echo $pencarianMahasiswa; ?>">
    <input type="hidden" name="searchType" value="mahasiswa">
    <button type="submit">Cari</button>
</form>

    <!-- Tabel data mahasiswa -->
    <table>
        <tr>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Prodi</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Perulangan untuk menampilkan data mahasiswa
        while ($data = mysqli_fetch_assoc($resultMahasiswa)) {
            echo "<tr>";
            echo "<td>" . $data['npm'] . "</td>";
            echo "<td>" . $data['namaMhs'] . "</td>";
            echo "<td>" . $data['prodi'] . "</td>";
            echo "<td>" . $data['alamat'] . "</td>";
            echo "<td>" . $data['noHp'] . "</td>";
            echo '<td>
                    <a href="editmahasiswa.php?npm=' . $data['npm'] . '">Edit</a> |
                    <a href="index.php?hapusMahasiswa=' . $data['npm'] . '" onclick="return confirm(\'Anda yakin akan menghapus data ini?\')">Hapus</a>
                  </td>';
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Tombol tambah mahasiswa -->
    <a href="mahasiswa.php">Tambah Mahasiswa</a>

    <h1>Data Mata Kuliah</h1>
    
    <!-- Form pencarian matakuliah -->
<form action="matakuliah.php" method="GET">
    <input type="text" name="cariMatakuliah" placeholder="Cari matakuliah berdasarkan nama" value="<?php echo $pencarianMatakuliah; ?>">
    <input type="hidden" name="searchType" value="matakuliah">
    <button type="submit">Cari</button>
</form>

    <!-- Tabel data matakuliah -->
    <table>
        <tr>
            <th>Kode Mata Kuliah</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Perulangan untuk menampilkan data matakuliah
        while ($data = mysqli_fetch_assoc($resultMatakuliah)) {
            echo "<tr>";
            echo "<td>" . $data['kodeMK'] . "</td>";
            echo "<td>" . $data['namaMK'] . "</td>";
            echo "<td>" . $data['sks'] . "</td>";
            echo "<td>" . $data['jam'] . "</td>";
            echo '<td>
                    <a href="editmatakuliah.php?kodeMK=' . $data['kodeMK'] . '">Edit</a> |
                    <a href="index.php?hapusMatakuliah=' . $data['kodeMK'] . '" onclick="return confirm(\'Anda yakin akan menghapus data ini?\')">Hapus</a>
                  </td>';
            echo "</tr>";
        }
        ?>
    </table>

    <!-- Tombol tambah matakuliah -->
    <a href="matakuliah.php">Tambah Mata Kuliah</a>
</body>
</html>
