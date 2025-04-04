<?php
// Inclusion du fichier de connexion à la base de données
require_once '../config/db_connect.php';
// Méthode GET : on recherche la chambre demandée
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
// Vérifier si l'ID est valide
if ($id <= 0) {
header("Location: listChambres.php");
exit;
}
$conn = openDatabaseConnection();
// Méthode POST : Traitement du formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$numero = $_POST['numero'];
$capacite = (int)$_POST['capacite'];
// Validation des données
$errors = [];
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
<title>Modifier une Chambre</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="navbar">
