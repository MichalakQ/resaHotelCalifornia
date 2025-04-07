<?php
// Inclusion du fichier de connexion à la base de données
require_once '../config/db_connect.php';
// Méthode GET : on recherche la chambre demandée
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// Vérifier si l'ID est valide
if ($id <= 0) {
header("Location: listClients.php");
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
$errors[] = "Le nom est obligatoire.";
}
if ($nombre_personnes <= 0) {
$errors[] = "Le nombre de personnes doit être positif.";
}
if (empty($email)) {
    $errors[]="Vous devez rentrer un mail";
}
if (empty($telephone)){
    $errors[]="vous devez inclure un numéro de téléphone"
}
// Si pas d'erreurs, mettre à jour les données
if (empty($errors)) {
$stmt = $conn->prepare("UPDATE clients SET nom = ?, nombre_personnes = ?, email=?, telephone=?  WHERE id = ?");
$stmt->execute([$nom, $nombre_personnes, $email, $telephone, $id]);
// Rediriger vers la liste des chambres
header("Location: listClients.php?success=1");
exit;
}
} else {
// Méthode GET : Récupérer les données du clients
$stmt = $conn->prepare("SELECT * FROM chambres WHERE id = ?");
$stmt->execute([$id]);
$chambre = $stmt->fetch(PDO::FETCH_ASSOC);
// Si la chambre n'existe pas, rediriger
if (!$chambre) {
header("Location: listChambres.php");
exit;
}
}
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
<title>Modifier une Chambre</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="navbar">
  <a href="../index.php">Accueil</a>
<a href="listChambres.php">Chambres</a>
<a href="../clients/listClients.php">Clients</a>
<a href="../reservations/listReservations.php">Réservations</a>
</div>
<div class="container">
<h1>Modifier une Chambre</h1>
<?php if (isset($errors) && !empty($errors)): ?>
<div class="error-message">
<?php foreach($errors as $error): ?>
<p><?= $error ?></p>
<?php endforeach; ?>
</div>
<?php endif; ?>
<form method="post">
<div class="form-group">
<label for="nom">Nom:</label>
<input type="text" id="nom" name="nom" required>
<label for="nombre_personnes">Nombre de résidents:</label>
<input type="number" id="nombre_personnes" name="nombre_personnes" min="1" required>
<label for="email">email:</label>
<input type="text" id="email" name="email" required>
<label for="telephone">telephone:</label>
<input type="text" id="telephone" name="telephone" required>
</div>


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
