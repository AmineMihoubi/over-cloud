<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 

 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $nomAlbum = mysqli_real_escape_string($db,htmlspecialchars($_POST['nom'])); 
 $idGalerie = $_SESSION['idGalerie'];


 $sql = "INSERT INTO album (nom,fk_id_galerie,date) VALUES ('".$nomAlbum."', $idGalerie,curdate())";
 mysqli_query($db,$sql);
 mysqli_close($db);
 header('Refresh: 0.001; ../pages/albums.php?id='.$idGalerie.'');
 ?>
