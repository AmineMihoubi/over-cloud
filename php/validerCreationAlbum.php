<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 

 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $nomAlbum = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom'])); 
 $idGalerie = $_SESSION['idGalerie'];
 $galerieSQL = "SELECT nom FROM album where id_galerie = '$idGalerie'";
 $resultGalerie = mysqli_query($db, $galerieSQL);
 $row0 =  mysqli_fetch_array($resultGalerie);
 $nomGalerie = $row0['nom'];


 $sql = "INSERT INTO album (nom,fk_id_galerie,date) VALUES ('".$nomAlbum."', $idGalerie,curdate())";
 mysqli_query($db,$sql);
 $sql2 = "INSERT INTO historique(fk_id_utilisateur, action, date) VALUES ('{$_SESSION['idUtilisateur']}', 'à créer l'album $nomAlbum dans la galerie $nomGalerie', '2021-03-14')";
 mysqli_query($db,$sql2);
 mysqli_close($db);
 header('Refresh: 0.001; ../pages/albums.php?id='.$idGalerie.'');
 ?>
