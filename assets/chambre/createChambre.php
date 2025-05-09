<?php
  require_once '../config/db_connect.php';
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
</head>

<body>
  <?php include_once '../assets/gestionMessage.php'; ?>
  <?php include '../assets/navbar.php'; ?>
  <h1>Ajouter une Chambre</h1>
  <form method="post">
  
  <div>
  <label>Numéro:</label>
    <input type="text" name="numero" required>
  </div>
  
  <div>
    <label>Capacité:</label>
    <input type="number" name="capacite" required>
  </div>
  <button type="submit">Enregistrer</button>
  </form>
  
  <a href="listChambres.php"><i class="fas fa-house"></i></a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
</body>
</html>
