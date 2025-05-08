<?php
require_once '../config/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$client = $_POST['client'];
$contact = $_POST['contact'];
$chambre=$_POST['chambre'];
$nombre_personnes=$_POST['nombre_personnes'];
$date_depart=$_POST['date_depart'];
$date_arrivee=$_POST['date_arrivee'];
$statut=$_POST['statut'];
$conn = openDatabaseConnection();
$stmt = $conn->prepare("INSERT INTO chambres (nom, email, telephone, nombre_personnes) VALUES (?, ?, ?, ?)");
$stmt->execute([$nom, $nombre_personnes]);
closeDatabaseConnection($conn);
header("Location: listClient.php");
exit;
}
?>
