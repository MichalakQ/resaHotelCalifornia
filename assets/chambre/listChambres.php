
<?php
//Appelle le fichier PHP et importe les champs de chambre
  
require_once '../config/db_connect.php';
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
  </head>
<body>
  <?php include_once '../assets/gestionMessage.php'; ?>
  <?php include '../assets/navbar.php'; ?>
  <h1>Liste des Chambres</h1>
  <i class="fas fa-file">
    <a href="createChambre.php">Ajouter une chambre</a>
  </i>
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
