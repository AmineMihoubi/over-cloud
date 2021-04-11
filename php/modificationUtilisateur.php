<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 
$id_utilisateur = $_SESSION['idUtilisateur'];

 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $nom = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom'])); 
 $prenom = mysqli_real_escape_string($db,htmlspecialchars($_POST['prenom'])); 
 $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
 $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['new-mdp'])); 
 $actualpassword = mysqli_real_escape_string($db,htmlspecialchars($_POST['mdp'])); 

 if($prenom !== "")
 {
    $sql = "UPDATE utilisateur SET prenom = '".$prenom."' where id_utilisateur = '".$id_utilisateur."'";
    mysqli_query($db,$sql);
    $_SESSION['prenomUtilisateur'] = $prenom;
 
 }
 if($nom !== "")
 {
    $sql = "UPDATE utilisateur SET nom = '".$nom."' where id_utilisateur = '".$id_utilisateur."'";
    mysqli_query($db,$sql);
    $_SESSION['nomUtilisateur'] = $nom;
 
 }
 $_SESSION['blaseUtilisateur'] = $prenom . " " . $nom;
 if($email !== "") 
 {
    $sql = "UPDATE utilisateur SET courriel = '".$email."' where id_utilisateur = '".$id_utilisateur."'";
    mysqli_query($db,$sql);
    $_SESSION['email'] = $email;

 }
 if($password !=="")
 {
    $requete = "SELECT mdp FROM utilisateur where id_utilisateur = '".$id_utilisateur."'";
    $exec_requete = mysqli_query($db,$requete);
    $reponse      = mysqli_fetch_assoc($exec_requete);

    if ($actualpassword == $reponse['mdp']){
      $sql = "UPDATE utilisateur SET mdp = '".$password."' where id_utilisateur = '".$id_utilisateur."'";
      mysqli_query($db,$sql);
    } else {
      header('Location: ../pages/parametresUtilisateurs.php?erreur=1'); // Le mot de passe actuel est incorrect 
    }

 }

mysqli_close($db);
header('Refresh: 0.001; ../pages/parametresUtilisateurs.php');
echo "<script>alert('Les changements ont été effectués ');</script>";