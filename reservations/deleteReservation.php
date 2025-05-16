<?php
// Inclusion du fichier de connexion à la base de données
require_once '../config/db_connect.php';
require_once '../auth/authFunctions.php';

if (!hasRole("directeur")) {
    $encodedMessage = urlencode("ERREUR : Vous n'avez pas les bonnes permissions.");
    header("Location: /resaHotelCalifornia/index.php?message=$encodedMessage");
    exit;
}

if (!hasRole("directeur")) {
    $encodedMessage = urlencode("ERREUR : Vous n'avez pas les bonnes permissions.");
    header("Location: /resaHotelCalifornia/index.php?message=$encodedMessage");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Vérifier si l'ID est valide
if ($id <= 0) {
    header("Location: listChambres.php");
    exit;
}

$conn = openDatabaseConnection();

// Vérifier si la chambre existe
$stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ?");
$stmt->execute([$id]);
$reservation= $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    header("Location: listReservations.php");
    exit;
}



// Traitement de la suppression si confirmée
if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    // Si la chambre a des réservations et que l'utilisateur souhaite les supprimer aussi
    $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
    $stmt->execute([$id]);

    
   
    
    // Rediriger vers la liste des chambres
    header("Location: listReservations.php?deleted=1");
    exit;
}

closeDatabaseConnection($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une Reservation </title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php include_once '../assets/gestionMessage.php'; ?>
<?php include '../assets/navbar.php'; ?>
    <div class="container">
        <h1>Supprimer une Réservation </h1>
        
        <div class="alert alert-warning">
            <p><i class="fa fa-warning"></i> <strong>Attention :</strong> Vous êtes sur le point de supprimer la réservatio numéro <?= htmlspecialchars($reservation['id']) ?>.</p>
        </div>
            
            <p>Êtes-vous sûr de vouloir supprimer cette réservation ?</p>
            
                <form method="post">
            <div class="actions">
                <input type="hidden" name="confirm" value="yes">
                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                <a href="listChambres.php" class="btn btn-primary" autofocus>Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>
