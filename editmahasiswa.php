<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Mahasiswa</title>
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

    input[type="text"], input[type="number"] {
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
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

</style>
</head>
<body>

<div class="container">
    <h2>Edit Mahasiswa</h2>

    <?php
    // Memanggil file koneksi
    require_once "koneksi.php";

    // Jika parameter npm terdefinisi
    if (isset($_GET['npm'])) {
        $npm = $_GET['npm'];

        // Query untuk mendapatkan data mahasiswa berdasarkan npm
        $sql_select = "SELECT * FROM t_mahasiswa WHERE npm='$npm'";
        $result = mysqli_query($link, $sql_select);

        // Jika data mahasiswa ditemukan
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>

            <form action="" method="post">
                <input type="hidden" name="npm" value="<?php echo $row['npm']; ?>">
                <label for="npm">NPM :</label><br>
                <input type="text" id="npm" name="npm" value="<?php echo $row['npm']; ?>" disabled><br><br>

                <label for="namaMhs">Nama Mahasiswa :</label><br>
                <input type="text" id="namaMhs" name="namaMhs" value="<?php echo $row['namaMhs']; ?>" required><br><br>

                <label for="prodi">Program Studi :</label><br>
                <input type="text" id="prodi" name="prodi" value="<?php echo $row['prodi']; ?>" required><br><br>

                <label for="alamat">Alamat :</label><br>
                <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required><br><br>

                <label for="noHP">Nomor HP :</label><br>
                <input type="text" id="noHP" name="noHP" value="<?php echo $row['noHP']; ?>" required><br><br>

                <input type="submit" name="edit_submit" value="Simpan Perubahan">
            </form>

            <?php
        } else {
            echo "<p>Data mahasiswa tidak ditemukan.</p>";
        }
    } else {
        echo "<p>NPM mahasiswa tidak didefinisikan.</p>";
    }

    // Edit data
    if (isset($_POST['edit_submit'])) {
        $npm = $_POST['npm'];
        $namaMhs = $_POST['namaMhs'];
        $prodi = $_POST['prodi'];
        $alamat = $_POST['alamat'];
        $noHP = $_POST['noHP'];

        $sql_update = "UPDATE t_mahasiswa SET namaMhs='$namaMhs', prodi='$prodi', alamat='$alamat', noHP='$noHP' WHERE npm='$npm'";
        if (mysqli_query($link, $sql_update)) {
            echo "<p>Data mahasiswa berhasil diperbarui.</p>";
        } else {
            echo "<p>Error: " . $sql_update . "<br>" . mysqli_error($link) . "</p>";
        }
    }

    // Menutup koneksi
    mysqli_close($link);
    ?>
</div>

</body>
</html>
