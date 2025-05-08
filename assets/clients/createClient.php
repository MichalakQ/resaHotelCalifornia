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
<h1>Ajouter un client</h1>
<form method="post">
<div>
<label>Nom:</label>
<input type="text" name="nom" required>
</div>
<div>
<label>Email:</label>
<input type="text" name="email" required>
</div>
<div>
<label>téléphone:</label>
<input type="number" name="telephone" required>
</div>
<div>
<label>Nombre de personnes:</label>
<input type="number" name="nombre_personnes" required>
</div>
<button type="submit">Enregistrer</button>
</form>
<a href="listClient.php">Retour à la liste</a>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
