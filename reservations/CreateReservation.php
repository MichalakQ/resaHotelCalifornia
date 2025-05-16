<?php
require_once '../config/db_connect.php';
require_once '../auth/authFunctions.php';
  if (!hasRole("directeur")) {
 $encodedMessage = urlencode("ERREUR : Vous n'avez pas les bonnes permissions.");
 header("Location: /resaHotelCalifornia/index.php?message=$encodedMessage");
 exit;
 }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nom = $_POST['nom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$nombre_personnes=$_POST['nombre_personnes'];

$numero=$_POST['numero'];
$date_depart=$_POST['date_depart'];
$date_arrivee=$_POST['date_arrivee'];
$conn = openDatabaseConnection();
$stmt = $conn->prepare("INSERT INTO clients (nom, email, telephone, nombre_personnes) VALUES (?, ?, ?, ?)");
$stmt->execute([$nom, $email, $telephone, $nombre_personnes]);
$client_id = $conn->lastInsertId(); // ID du client inséré

$stmt = $conn->prepare("SELECT id FROM chambres WHERE numero = ?");
$stmt->execute([$numero]);
$chambre = $stmt->fetch(PDO::FETCH_ASSOC);
$chambre_id = $chambre['id'];

$stmt = $conn->prepare("INSERT INTO reservations (client_id, chambre_id,  date_arrivee, date_depart) VALUES (?, ?, ?, ?)");
$stmt->execute([$client_id, $chambre_id,  $date_arrivee, $date_depart]);



closeDatabaseConnection($conn);
header("Location: listReservations.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
crossorigin="anonymous">
<title>Ajouter un client</title>
<style>
            body {
            background-image: url('../assets/createReservation.png'); /* chemin vers ton image */
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
<h1><p class=dore> Ajouter une réservation</p></h1>
<form method="post">
  <h3><p class=dore> Informations client </p></h3>
  <div>
  <p class=dore> <label>Nom:</label> </p>
  <input type="text" name="nom" required>
  </div>

  <div>
  <p class=dore> <label>Email:</label> </p>
  <input type="email" name="email" required>
  </div>

  <div>
  <p class=dore><label>Téléphone:</label></p>
  <input type="text" name="telephone" required>
  </div>

  <div>
  <p class=dore><label>Nombre de personnes:</label></p>
  <input type="number" name="nombre_personnes" required>
  </div>

  <div>
  <p class=dore> <label>Chambre:</label></p>
  <input type="number" name="numero" required>
  </div>

  <div>
  <p class=dore> <label>Date d'arrivée:</label> </p>
  <input type="date" name="date_arrivee" required>
  </div>
  <div>
  <p class=dore> <label>Date de départ:</label> </p>
  <input type="date" name="date_depart" required>
  </div>

  <button type="submit">Créer la réservation</button>
</form>

 <a href="../reservations/listReservations.php"><p class=dore><i class="fas fa-item"></i><br>Retour à la liste </p></a> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
