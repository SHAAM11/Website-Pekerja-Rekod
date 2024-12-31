<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pekerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">ADD MAKLUMAT</h1>
        <form action="add.php" method="post" class="p-4 border rounded">
            <div class="mb-3">
                <label for="ic" class="form-label">No. IC</label>
                <input type="text" name="ic" id="ic" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="no_tel" class="form-label">No. Telefon</label>
                <input type="text" name="no_tel" id="no_tel" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jantina" class="form-label">Jantina</label>
                <select name="jantina" id="jantina" class="form-select" required>
                    <option value="" disabled selected>Sila Pilih</option>
                    <option value="Lelaki">Lelaki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

            </div>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $ic = $_POST['ic'];
        $nama = $_POST['nama'];
        $no_tel = $_POST['no_tel'];
        $jantina = $_POST['jantina'];

        $conn = new mysqli('localhost', 'root', '', 'rekod_pekerja');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO pekerja (ic, nama, no_tel, jantina) VALUES ('$ic', '$nama', '$no_tel', '$jantina')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Rekod berjaya ditambah!'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    ?>
</body>

</html>