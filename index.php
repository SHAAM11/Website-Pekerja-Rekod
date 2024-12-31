<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekod Pekerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-body {
            text-align: center; /* Center the text */
        }
        .modal-footer {
            justify-content: flex-start; /* Align buttons to the left */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Senarai Pekerja</h1>
        
        <!-- Add New Worker Button -->
        <a href="add.php" class="btn btn-primary mb-3">Tambah Pekerja Baru</a>
         <!-- Logout Button -->
         <a href="login.php" class="btn btn-danger mb-3">Log Keluar</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA PEKERJA</th>
                    <th>NO.KP</th>
                    <th>NO.HP</th>
                    <th>JANTINA</th>
                    <th>TINDAKAN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'rekod_pekerja');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM pekerja";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['ic']}</td>
                                <td>{$row['no_tel']}</td>
                                <td>{$row['jantina']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Kemaskini</a>
                                    <a href='#' class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#confirmModal'>Padam</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tiada data dijumpai</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for confirmation -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">DELETE!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Adakah anda pasti untuk menghapuskan rekod ini?</h5>
                    <p>Sila Pastikan dengan betul!</p>
                </div>
                <div class="modal-footer">
                    <!-- YES DELETE button -->
                    <form method="POST" id="deleteForm">
                        <button type="submit" name="confirm_delete" class="btn btn-danger">YES DELETE!</button>
                    <!-- CANCEL button -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Attach delete ID to the modal and handle the delete action
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var recordId = this.getAttribute('data-id');
                // Set the ID in the form for deletion
                document.getElementById('deleteForm').action = 'delete.php?id=' + recordId;
            });
        });
    </script>
</body>
</html>
