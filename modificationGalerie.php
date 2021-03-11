<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 
$id_galerie = $_SESSION['idGalerie'];

 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $nomGalerie = mysqli_real_escape_string($db,htmlspecialchars($_POST['nomGalerie'])); 

 if($nomGalerie !== "")
 {
    $sql = "UPDATE galerie SET nom = '".$nomGalerie."' where id_galerie = '".$id_galerie."'";
    mysqli_query($db,$sql);
    $_SESSION['nomGalerie'] = $nomGalerie;
 }


mysqli_close($db);
header('Refresh: 0.2; parametresGalerie.php');
echo "<script>alert('Les changements ont été effectués ');</script>"; 

?>