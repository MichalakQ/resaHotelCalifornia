
<?php
//Appelle le fichier PHP et importe les champs de chambre
  
require_once '../config/db_connect.php';
require_once '../auth/authFunctions.php';

if (!hasRole("standard")) {
 $encodedMessage = urlencode("ERREUR : Vous n'avez pas les bonnes permissions.");
 header("Location: /resaHotelCalifornia/index.php?message=$encodedMessage");
 exit;
 }

  $conn = openDatabaseConnection();
  $stmt = $conn->query("SELECT * FROM chambres ORDER BY numero");

//Affiche les chambres sous forme de tableau

$chambres = $stmt->fetchAll(PDO::FETCH_ASSOC);
  closeDatabaseConnection($conn);

?>

<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <title>Liste des Chambres</title>
    <style>
            body {
            background-image: url('../assets/listChambre.jpg'); /* chemin vers ton image */
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
table td {
    color: rgb(255, 17, 0);
}
table th {
    color:rgb(0, 255, 242);
}
    </style>
  </head>
<body>
  <?php include_once '../assets/gestionMessage.php'; ?>
  <?php include '../assets/navbar.php'; ?>
  <h1><p class="dore">Liste des Chambres</h1></p>
<a href="createChambre.php" class="dore">
  <i class="fas fa-bed"></i> <br>Ajouter une chambre
</a>
  <table border="1" style="width: 60%; min-width: 400px; margin: 0 auto;">
  <tr>
    <th>ID</th>
    <th>Numéro</th>
    <th>Capacité</th>
    <th>Actions</th>
  </tr>
  <?php foreach($chambres as $chambre): ?>
  <tr>
    <td>
      <?php echo $chambre['id']; ?>
    </td>
    <td>
      <?= $chambre['numero'] ?>
    </td>
    <td>
      <?= $chambre['capacite'] ?>
    </td>
    <td>
      <a href="editChambre.php?id=<?= $chambre['id'] ?>">Modifier </a>
      <a href="deleteChambre.php?id=<?= $chambre['id'] ?>" onclick="return confirm('Êtes-vous sûr?')"> Supprimer </a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
</body>
</html>
