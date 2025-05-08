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
$stmt = $conn->prepare("INSERT INTO reservations (client, contact, chambre, nombre_personnes, date_depart, date_arrivee) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$client, $nombre_personnes]);
closeDatabaseConnection($conn);
header("Location: listReservations.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
crossorigin="anonymous">
<title>Ajouter un client</title>
</head>
<body>
<?php include '../assets/navbar.php'; ?>
<h1>Ajouter une réservation</h1>
<form method="post">
<div>
<label>Client:</label>
<input type="text" name="client" required>
</div>
  
<div>
<label>Contact:</label>
<input type="text" name="contact" required>
</div>

<div>
<label>Chambre:</label>
<input type="number" name="chambre" required>
</div>

<div>
<label>Nombre de Personnes:</label>
<input type="number" name="nombre_personnes" required>
</div>

<div>
<label>date d'arrivée :</label>
<input type="text" name="date_arrivée" required>
</div>

<div>
<label>date de départ:</label>
<input type="text" name="date_depart" required>
</div>
  
<button type="submit">Enregistrer</button>
</form>
<a href="listClient.php">Retour à la liste</a>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
