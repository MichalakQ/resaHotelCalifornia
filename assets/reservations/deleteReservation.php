<?php
require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = $_POST['reservation_id'];

    $conn = openDatabaseConnection();

    $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
    $stmt->execute([$reservation_id]);

    closeDatabaseConnection($conn);

    header("Location: listReservations.php");
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
  <title>Supprimer une réservation</title>
</head>
<body>
<?php include '../assets/navbar.php'; ?>
<h1>Supprimer une réservation</h1>
<form method="post">
  <div>
    <label>ID de la réservation à supprimer :</label>
    <input type="number" name="reservation_id" required>
  </div>
  <button type="submit" class="btn btn-danger mt-2">Supprimer</button>
</form>
<a href="listReservations.php">Retour à la liste</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
