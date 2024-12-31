<?php
$conn = new mysqli('localhost', 'root', '', 'rekod_pekerja');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "<script>alert('ID tidak sah!'); window.location.href='index.php';</script>";
    exit();
}

if (isset($_POST['confirm_delete'])) {
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM pekerja WHERE id = ?");
    $stmt->bind_param("i", $id);  // 'i' means integer
    if ($stmt->execute()) {
        echo "<script>alert('Rekod berjaya dipadamkan!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='index.php';</script>";
    }
    $stmt->close();
}

$conn->close();
?>
