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
header("Location: listChambres.php");
exit;
} 
$conn = openDatabaseConnection();
$errors = [];

// Méthode POST : Traitement du formulaire si soumis

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $numero = trim($_POST['numero']);
  //Verifie si la clef existe et la convertie en entier (et assigne 0 sinon)
  $capacite = isset($_POST['capacite']) ? (int)$_POST['capacite'] : 0 ;
// Validation des données

if (empty($numero)) {
  $errors[] = "Le numéro de chambre est obligatoire.";
}

if ($capacite <= 0) {
  $errors[] = "La capacité doit être un nombre positif.";
}

// Si pas d'erreurs, mettre à jour les données

if (empty($errors)) {
  $stmt = $conn->prepare("UPDATE chambres SET numero = ?, capacite = ? WHERE id = ?");
  $stmt->execute([$numero, $capacite, $id]);

// Rediriger vers la liste des chambres
  header("Location: listChambres.php?success=1");
  exit;
  }

} else {

// Méthode GET : Récupérer les données de la chambre

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
    <meta charset="UTF-8">
    <title>Modifier une chambre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <style>
                body {
            background-image: url('../assets/EditChambre.jpg'); /* chemin vers ton image */
            background-repeat: no-repeat;   /* Ne pas répéter l'image */
            background-size: cover;         /* L'image couvre tout l'écran */
            background-position: center;    /* Centre l'image */
            background-attachment: fixed;   /* L'image reste fixe lors du scroll */
        }
                .dore {
    color: #FFD700; /* Couleur dorée */
    /* Optionnel : ajouter un léger effet de brillance */
    text-shadow: 0 0 5px #FFD700, 0 0 10px #FFA500;
}
  </style>
 </head>

<body>
  <?php include_once '../assets/gestionMessage.php'; ?>
  <?php include '../assets/navbar.php'; ?>
  
<div class="container">
  <h1><p class=dore>Modifier une Chambre</p></h1> 
  <?php if (isset($errors) && !empty($errors)): ?>

    <div class="error-message">
      <?php foreach($errors as $error): ?>
      <p><?= $error ?></p>
      <?php endforeach; ?>
    </div>
</div>

<?php endif; ?>

<form method="post">
  <div class="form-group">
    <p class=dore><label for="numero">Numéro de Chambre:</label></p>
    <input type="text" id="numero" name="numero"
    value="<?= htmlspecialchars($chambre['numero']) ?>" required>
  </div>

  <div class="form-group">
    <p class=dore><label for="capacite">Capacité (nombre de personnes):</label></p>
    <input type="number" id="capacite" name="capacite" value="<?= $chambre['capacite'] ?>" min="1" required>
  </div>

  <div class="actions">
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    <a href="listChambres.php" class="btn btn-danger">Annuler</a>
  </div>

</form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" referrerpolicy="no-referrer">

</script>
</body>
</html>
