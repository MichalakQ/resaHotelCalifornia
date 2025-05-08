<?php
require_once '../config/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nom = $_POST['nom'];
$email = $_POST['email'];
$telephone=$_POST['telephone'];
$nombre_personnes=$_POST['nombre_personnes'];
$conn = openDatabaseConnection();
$stmt = $conn->prepare("INSERT INTO chambres (nom, email, telephone, nombre_personnes) VALUES (?, ?, ?, ?)");
$stmt->execute([$nom, $nombre_personnes]);
closeDatabaseConnection($conn);
header("Location: listClient.php");
exit;
}
?>
