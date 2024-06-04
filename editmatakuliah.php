<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Matakuliah</title>
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

</style>
</head>
<body>

<div class="container">
    <h2>Edit Matakuliah</h2>

    <?php
    // Memanggil file koneksi
    require_once "koneksi.php";

    // Jika parameter kodeMK terdefinisi
    if (isset($_GET['kodeMK'])) {
        $kodeMK = $_GET['kodeMK'];

        // Query untuk mendapatkan data matakuliah berdasarkan kodeMK
        $sql_select = "SELECT * FROM t_matakuliah WHERE kodeMK='$kodeMK'";
        $result = mysqli_query($link, $sql_select);

        // Jika data matakuliah ditemukan
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>

            <form action="" method="post">
                <div class="form-container">
                    <label for="kodeMK">Kode MK:</label><br>
                    <input type="text" id="kodeMK" name="kodeMK" value="<?php echo $row['kodeMK']; ?>" required><br>
                    <label for="namaMK">Nama MK:</label><br>
                    <input type="text" id="namaMK" name="namaMK" value="<?php echo $row['namaMK']; ?>" required><br>
                    <label for="sks">SKS:</label><br>
                    <input type="number" id="sks" name="sks" value="<?php echo $row['sks']; ?>" required><br>
                    <label for="jam">Jam:</label><br>
                    <input type="number" id="jam" name="jam" value="<?php echo $row['jam']; ?>" required><br><br>
                    <input type="submit" name="edit" value="Simpan Perubahan">
                </div>
            </form>

            <?php
        } else {
            echo "<p>Data matakuliah tidak ditemukan.</p>";
        }
    } else {
        echo "<p>Kode MK matakuliah tidak didefinisikan.</p>";
    }

    // Edit data matakuliah
    if (isset($_POST['edit'])) {
        $kodeMK = $_POST['kodeMK'];
        $namaMK = $_POST['namaMK'];
        $sks = $_POST['sks'];
        $jam = $_POST['jam'];

        $sql_update = "UPDATE t_matakuliah SET namaMK='$namaMK', sks='$sks', jam='$jam' WHERE kodeMK='$kodeMK'";
        if (mysqli_query($link, $sql_update)) {
            echo "<p>Data matakuliah berhasil diperbarui.</p>";
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
