<?php
// Initialiser la session
function initialiserSession() {
 if (session_status() == PHP_SESSION_NONE) {
 session_start();
 }
}
// Vérifier si l'employé est connecté
function isLoggedIn() {
 initialiserSession();
 return isset($_SESSION['user_id']);
}
/** Vérifier si l'utilisateur a un niveau d'accès suffisant pour le rôle requis
 * rôle allant de 1 (admin) à 10 (aucun droit)
 * Renvoie True si rôle <= rôle attendu (less is better)
 */
function hasRole($required_role) {
 initialiserSession();

 // Si l'employé n'est pas connecté, aucun accès
 if (!isLoggedIn()) return false;

 // Table de correspondance des rôles et de leurs niveaux d'accès
 $role_levels = [
 'admin' => 1, // Niveau administrateur maximum
 'directeur' => 2, // Directeur
 'manager' => 3, // Gestionnaire
 '-reserve-' => 4, // un chef de service plus tard ?
 'standard' => 5, // Utilisateur standard
 'interimaire' => 7, // employé temporaire
 'client' => 8 // éventuellement les client...
 ];
 // Récupérer le niveau requis
 if (isset($role_levels[$required_role])) {
 $required_level = $role_levels[$required_role];
 } else {
 $required_level = 10;
 }
 // Récupérer le rôle actuel de l'employé
 $user_role = $_SESSION['role'] ?? '';

 // Déterminer le niveau de l'employé
 $user_level = isset($role_levels[$user_role]) ? $role_levels[$user_role] : 10;
return $user_level <= $required_level;
}

