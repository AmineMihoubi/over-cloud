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
header("Refresh: 0.001; ../pages/photos.php");


}


if ($_POST['ajouter-commentaire']) {
    $text = mysqli_real_escape_string($db,htmlspecialchars($_POST['ajouter-commentaire']));   
    $idPhoto = $_POST['idPhoto'];
    $idUtilisateur = $_SESSION['idUtilisateur'];
    
    $sql = "INSERT INTO commentaire (fk_id_auteur,fk_id_photo,message) VALUES ('".$idUtilisateur."', $idPhoto, '".$text."' )";
    mysqli_query($db,$sql);
    mysqli_close($db);
    
    header("Refresh: 0.001; ../pages/photos.php");
    
    }

?>