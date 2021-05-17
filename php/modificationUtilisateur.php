<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance();
$id_utilisateur = $_SESSION['idUtilisateur'];

// on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
// pour éliminer toute attaque de type injection SQL et XSS
$nom = mysqli_real_escape_string($db, htmlspecialchars($_POST['nom']));
$prenom = mysqli_real_escape_string($db, htmlspecialchars($_POST['prenom']));
$email = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));
$password = mysqli_real_escape_string($db, htmlspecialchars($_POST['new-mdp']));
$actualpassword = mysqli_real_escape_string($db, htmlspecialchars($_POST['mdp']));

if ($prenom != "") {
   $sql = "UPDATE utilisateur SET prenom = '" . $prenom . "' where id_utilisateur = '" . $id_utilisateur . "'";
   mysqli_query($db, $sql);
   $_SESSION['prenomUtilisateur'] = $prenom;
}
if ($nom != "") {
   $sql = "UPDATE utilisateur SET nom = '" . $nom . "' where id_utilisateur = '" . $id_utilisateur . "'";
   mysqli_query($db, $sql);
   $_SESSION['nomUtilisateur'] = $nom;
}
$_SESSION['blaseUtilisateur'] = $prenom . " " . $nom;
if ($email != "") {
   //Si l'adresse courriel est déja prise ne change pas
   $requete = "SELECT count(*) FROM utilisateur where courriel = '" . $email . "'";
   $exec_requete = mysqli_query($db, $requete);
   $reponse      = mysqli_fetch_array($exec_requete);
   $count = $reponse['count(*)'];
   if ($count != 1) 
   {
      $sql = "UPDATE utilisateur SET courriel = '" . $email . "' where id_utilisateur = '" . $id_utilisateur . "'";
      mysqli_query($db, $sql);
      $_SESSION['email'] = $email;
   } else {
      echo "<script>alert('Ce courriel est déja utilisé !');</script>";
      header('Refresh: 0.001; ../pages/parametres-de-lutilisateur.php');
      exit();
   }
}
if ($password != "") {
   $requete = "SELECT mdp FROM utilisateur where id_utilisateur = '" . $id_utilisateur . "'";
   $exec_requete = mysqli_query($db, $requete);
   $reponse      = mysqli_fetch_assoc($exec_requete);

   if ($actualpassword == $reponse['mdp']) {
      $sql = "UPDATE utilisateur SET mdp = '" . $password . "' where id_utilisateur = '" . $id_utilisateur . "'";
      mysqli_query($db, $sql);
   } else {
      header('Location: ../pages/parametres-de-lutilisateur.php'); // Le mot de passe actuel est incorrect 
   }
}

mysqli_close($db);
header('Refresh: 0.001; ../pages/parametres-de-lutilisateur.php');
echo "<script>alert('Les changements ont été effectués ');</script>";
