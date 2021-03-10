<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 
$id_utilisateur = $_SESSION['idUtilisateur'];

 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $nom = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom'])); 
 $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
 $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['new-mdp'])); 

 if($nom !== "")
 {
    $sql = "UPDATE utilisateur SET nom = '".$nom."' where id_utilisateur = '".$id_utilisateur."'";
    mysqli_query($db,$sql);
    $_SESSION['nom'] = $nom;
 
 }
 if($email !== "") 
 {
    $sql = "UPDATE utilisateur SET email = '".$email."' where id_utilisateur = '".$id_utilisateur."'";
    mysqli_query($db,$sql);
    $_SESSION['email'] = $email;

 }
 if($password !=="")
 {
    $sql = "UPDATE utilisateur SET password = '".$password."' where id_utilisateur = '".$id_utilisateur."'";
    mysqli_query($db,$sql);

 }

mysqli_close($db);
header('Refresh: 0.2; parametresUtilisateurs.php');
echo "<script>alert('Les changements ont été effectués ');</script>"; 

?>