<?php
require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chambre_id = $_POST['numero_chambre'];

    $conn = openDatabaseConnection();

    $stmt = $conn->prepare("DELETE FROM chambres WHERE id = ?");
    $stmt->execute([$client_id]);

    closeDatabaseConnection($conn);

    header("Location: listChambres.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
  <title>Supprimer une Chambre </title>
</head>
<body>
<?php include '../assets/navbar.php'; ?>
<h1>Supprimer une chambre </h1>
<form method="post">
  <div class="mb-3">
    <label for="chambre_id" class="form-label">ID de la chambre à supprimer :</label>
    <input type="number" class="form-control" name="chambre_id" id="chambre_id" required>
  </div>
  <button type="submit" class="btn btn-danger">Supprimer</button>
</form>
<a href="listChambres.php" class="btn btn-secondary mt-3">Retour à la liste</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
