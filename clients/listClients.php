<?php
require_once '../config/db_connect.php';
require_once '../auth/authFunctions.php';

if (!hasRole("standard") && !hasRole("directeur")&&!hasRole("responsable")){
 $encodedMessage = urlencode("ERREUR : Vous n'avez pas les bonnes permissions.");
 header("Location: /resaHotelCalifornia/index.php?message=$encodedMessage");
 exit;
 }

$conn = openDatabaseConnection();
$stmt = $conn->query("SELECT * FROM clients ORDER BY nom");
$clients= $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<style>
              body {
            background-image: url('../assets/listClients.jpg'); /* chemin vers ton image */
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
table th {
    color: rgb(255, 0, 0);
}
table td {
    color:white;
}
</style>
</head>
<body>
<?php include_once '../assets/gestionMessage.php'; ?>
<?php include '../assets/navbar.php'; ?>
<h1> <p class="dore"> Liste des clients </p></h1>
<a href="createClient.php">
  <i class="fas fa-user"></i> <br> Ajouter un client</a>
<table border="1" style="width: 60%; min-width: 400px; margin: 0 auto;">
<tr>
<th>ID</th>
<th>Nom</th>
<th>email</th>
<th>telephone</th>
</tr>
<?php foreach($clients as $clients): ?>
<tr>
<td><?php echo $clients['id']; ?></td>
<td><?= $clients['nom'] ?></td>
<td><?= $clients['email'] ?></td>
<td><?= $clients['telephone'] ?></td>
<td>
<a href="editClient.php?id=<?= $clients['id'] ?>">Modifier</a>
<a href="deleteClient.php?id=<?= $clients['id'] ?>" onclick="return confirm('Êtes-vous sûr?')">Supprimer</a>
</td>
</tr>
<?php endforeach; ?>
</table>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
