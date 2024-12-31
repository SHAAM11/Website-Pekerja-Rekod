<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemaskini Pekerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kemaskini Maklumat Pekerja</h1>
        <?php
        $conn = new mysqli('localhost', 'root', '', 'rekod_pekerja');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM pekerja WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "<script>alert('Data tidak dijumpai!'); window.location.href='index.php';</script>";
            }
        }

        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $ic = $_POST['ic'];
            $nama = $_POST['nama'];
            $no_tel = $_POST['no_tel'];
            $jantina = $_POST['jantina'];

            $sql = "UPDATE pekerja SET ic = '$ic', nama = '$nama', no_tel = '$no_tel', jantina = '$jantina' WHERE id = $id";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Rekod berjaya dikemaskini!'); window.location.href='index.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>
        <form action="edit.php?id=<?php echo $row['id']; ?>" method="post" class="p-4 border rounded">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="ic" class="form-label">No. IC</label>
                <input type="text" name="ic" id="ic" class="form-control" value="<?php echo $row['ic']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_tel" class="form-label">No. Telefon</label>
                <input type="text" name="no_tel" id="no_tel" class="form-control" value="<?php echo $row['no_tel']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jantina" class="form-label">Jantina</label>
                <select name="jantina" id="jantina" class="form-select" required>
                    <option value="Lelaki" <?php if ($row['jantina'] == 'Lelaki') echo 'selected'; ?>>Lelaki</option>
                    <option value="Perempuan" <?php if ($row['jantina'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Kemaskini</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
