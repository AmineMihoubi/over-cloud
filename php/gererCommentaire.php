<?php
require 'ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 
$idAlbum = $_POST['idAlbum'];

if ($_POST['submit-supprimer']) {
$idCommentaire = $_POST['idCommentaire'];
$idPhoto = $_POST['idPhoto'];


$sql = "DELETE FROM commentaire WHERE id_commentaire = $idCommentaire";
mysqli_query($db,$sql);
}

if ($_POST['submit-envoyer']) {
        $text = mysqli_real_escape_string($db,htmlspecialchars($_POST['commentaire']));   
        $idPhoto = $_POST['idPhoto'];
        $idUtilisateur = $_SESSION['idUtilisateur'];

        
        $sql = "INSERT INTO commentaire (fk_id_auteur,fk_id_photo,message) VALUES ('".$idUtilisateur."','".$idPhoto."', '".$text."' )";
        mysqli_query($db,$sql);
    }


    if(!empty($_POST['idAlbum'])) {
        header("Refresh: 0.001; ../pages/photoAlbum?id=$idAlbum"); 
    }else {
        header("Refresh: 0.001; ../pages/photos.php");
    }


?>