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
</body>
</html>
