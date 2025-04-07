<?php
require_once '../config/db_connect.php';
$conn = openDatabaseConnection();
$stmt = $conn->query("SELECT * FROM clients ORDER BY nom");
$chambres = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <title>Liste des clients</title>
</head>
<body>
<h1>Liste des clients</h1>
<a href="createClient.php">Ajouter une client</a>
<table border="1" style="width: 60%; min-width: 400px; margin: 0 auto;">
<tr>
<th>ID</th>
<th>Nom</th>
<th>email</th>
<th>telephone</th>
<th>nombre_personnes</th>
</tr>
<?php foreach($clients as $clients): ?>
<tr>
<td><?php echo $clients['id']; ?></td>
<td><?= $clients['nom'] ?></td>
<td><?= $clients['email'] ?></td>
<td><?= $clients['telephone'] ?></td>
<td><?= $clients['nombre_personnes'] ?></td>
<td>
<a href="editClient.php?id=<?= $chambre['id'] ?>">Modifier</a>
<a href="deleteClient.php?id=<?= $chambre['id'] ?>" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
</td>
</tr>
<?php endforeach; ?>
</table>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
