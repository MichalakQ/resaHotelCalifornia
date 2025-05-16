<?php
// Inclusion du fichier de connexion à la base de données
require_once '../config/db_connect.php';
require_once '../auth/authFunctions.php';

if (!hasRole("manager")) {
 $encodedMessage = urlencode("ERREUR : Vous n'avez pas les bonnes permissions.");
 header("Location: /resaHotelCalifornia/index.php?message=$encodedMessage");
 exit;
 }
// Méthode GET : on recherche la chambre demandée
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// Vérifier si l'ID est valide
if ($id <= 0) {
header("Location: listReservations.php");
exit;
}
$conn = openDatabaseConnection();
// Méthode POST : Traitement du formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nom= $_POST['nom'];
$nombre_personnes= (int)$_POST['nombre_personnes'];
$email=$_POST['email'];
$telephone=$_POST['telephone'];
// Validation des données
$errors = [];

if (empty($nom)) {
$errors[] = "Veuillez assigner un client.";
}

if (empty($email)) {
$errors[] = "Veuillez entrer un moyen de contact.";
}

if ($nombre_personnes <= 0) {
$errors[] = "Le nombre de personnes doit être positif.";
}

if (empty($chambre)) {
    $errors[]="Vous devez rentrer une chambre";
}

if (empty($date_depart)){
    $errors[]="vous devez inclure une date de départ";
}


if (empty($date_arrivee)){
    $errors[]="vous devez inclure une date d'arrivée.";
}

// Si pas d'erreurs, mettre à jour les données
if (empty($errors)) {
$stmt = $conn->prepare("UPDATE reservations SET client = ?, nombre_personnes = ?, contact=?, chambre=?, date_arrivee=?, date_depart=?  WHERE id = ?");
$stmt->execute([$client, $nombre_personnes, $contact, $chambre, $date_arrivee, $date_depart, $id]);
// Rediriger vers la liste des chambres
header("Location: listClients.php?success=1");
exit;
}
} else {
// Méthode GET : Récupérer les données du clients
$stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ?");
$stmt->execute([$id]);
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$reservation) {
    header("Location: listReservations.php");
    exit;
}}
closeDatabaseConnection($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
crossorigin="anonymous">
<title>Modifier une Réservation</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include_once '../assets/gestionMessage.php'; ?>
<?php include '../assets/navbar.php'; ?>
<div class="navbar">
  <a href="../index.php">Accueil</a>
<a href="listChambres.php">Chambres</a>
<a href="../clients/listClients.php">Clients</a>
<a href="../reservations/listReservations.php">Réservations</a>
</div>
<div class="container">
<h1>Modifier une Réservation </h1>
<?php if (isset($errors) && !empty($errors)): ?>
<div class="error-message">
<?php foreach($errors as $error): ?>
<p><?= $error ?></p>
<?php endforeach; ?>
</div>
<?php endif; ?>
<form method="post">
<div class="form-group">
<label for="nom">Client:</label>
<input type="text" id="nom" name="nom" required>
<label for="nombre_personnes">Nombre de résidents:</label>
<input type="number" id="nombre_personnes" name="nombre_personnes" min="1" required>
<label for="email">email:</label>
<input type="text" id="email" name="email" required>
<label for="chambre">chambre:</label>
<input type="number" id="chambre" name="chambre" required>
<label for="date_depart">date de départ:</label>
<input type="text" id="date_depart" name="date_depart" required>
<label for="date_arrivee">date de départ:</label>
<input type="text" id="date_arrivee" name="date_arrivee" required
</div>
<div class="actions">
<button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
<a href="listClients.php" class="btn btn-danger">Annuler</a>
</div>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
