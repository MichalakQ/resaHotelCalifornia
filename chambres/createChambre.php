<?php
  require_once '../config/db_connect.php';
  require_once '../auth/authFunctions.php';
  if (!hasRole("directeur")) {
 $encodedMessage = urlencode("ERREUR : Vous n'avez pas les bonnes permissions.");
 header("Location: /resaHotelCalifornia/index.php?message=$encodedMessage");
 exit;
 }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = $_POST['numero'];
    $capacite = $_POST['capacite'];
    $conn = openDatabaseConnection();
    $stmt = $conn->prepare("INSERT INTO chambres (numero, capacite) VALUES (?, ?)");
    $stmt->execute([$numero, $capacite]);
    closeDatabaseConnection($conn);
    header("Location: listChambres.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
  crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <title>Ajouter une Chambre</title>
  <style>
                body {
            background-image: url('../assets/creerChambre.jpg'); /* chemin vers ton image */
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
  <h1><p class="dore">Ajouter une Chambre</p></h1>
  <form method="post">
  
  <div>
  <label><p class="dore">Numéro: </p></label>
    <input type="text" name="numero" required>
  </div>
  
  <div>
    <label><p class="dore">Capacité:</p></label>
    <input type="number" name="capacite" required>
  </div>
  <button type="submit">Enregistrer</button>
  </form>
  
  <a href="../chambres/listChambres.php"><i class="fas fa-bed"></i></a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
</body>
</html>
