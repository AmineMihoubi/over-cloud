<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 


if ($_POST['submit']) {
$text = mysqli_real_escape_string($db,htmlspecialchars($_POST['commentaire']));   
$idCommentaire = $_POST['idCommentaire'];
$idPhoto = $_POST['idPhoto'];


$sql = "DELETE FROM commentaire WHERE id_commentaire = $idCommentaire";
mysqli_query($db,$sql);
mysqli_close($db);
header("Refresh: 0.001; ../pages/photoZoom?idPhoto=$idPhoto");


}

?>