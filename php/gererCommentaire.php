<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 


if ($_POST['submit-supprimer']) {
$idCommentaire = $_POST['idCommentaire'];
$idPhoto = $_POST['idPhoto'];


$sql = "DELETE FROM commentaire WHERE id_commentaire = $idCommentaire";
mysqli_query($db,$sql);
mysqli_close($db);
header("Refresh: 0.001; ../pages/photoZoom?idPhoto=$idPhoto");
echo "<script>alert('Votre commentaire a été supprimé !');</script>";

}


if ($_POST['submit-envoyer']) {
$text = mysqli_real_escape_string($db,htmlspecialchars($_POST['commentaire']));   
$idPhoto = $_POST['idPhoto'];
$idUtilisateur = $_SESSION['idUtilisateur'];
date_default_timezone_set('America/New_york');
$date = date("Y-m-d H:i:s");

$sql = "INSERT INTO commentaire (fk_id_auteur,fk_id_photo,message,date) VALUES ('".$idUtilisateur."', $idPhoto, '".$text."','".$date."' )";
mysqli_query($db,$sql);
mysqli_close($db);
header("Refresh: 0.001; ../pages/photoZoom?idPhoto=$idPhoto");


}

?>