<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 


if ($_POST['submit']) {
$text = mysqli_real_escape_string($db,htmlspecialchars($_POST['commentaire']));   
$idPhoto = $_POST['idPhoto'];
$idUtilisateur = $_SESSION['idUtilisateur'];

$sql = "INSERT INTO commentaire (fk_id_auteur,fk_id_photo,message) VALUES ('".$idUtilisateur."', $idPhoto, '".$text."' )";
mysqli_query($db,$sql);
mysqli_close($db);
header("Refresh: 0.001; ../pages/photoZoom?idPhoto=$idPhoto");


}

?>