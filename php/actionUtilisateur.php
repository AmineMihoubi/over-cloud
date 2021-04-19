<?php
session_start();
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
$courriel = $_GET['courriel'];
$idAlbum = $_GET['idAlbum'];
$idPhoto = $_GET['idPhoto'];


/**
 * Si l'utilisateur clique sur supprimer
 */
if(isset($_POST['supprimer'])) {
$sql = "DELETE FROM utilisateur where courriel = '".$courriel."'";
mysqli_query($db,$sql);
header('Refresh: 0; ../admin/listeUtilisateur.php');
}

/**
 * Si l'utilisateur clique sur voir les photos d'un Album
 */
else if(isset($_POST['voirPhotos'])) { 

header("Refresh: 0; ../admin/admin-photos.php?album=$idAlbum");

}

/**
 * Si l'utilisateur clique sur voir les commentaires
 */
else if(isset($_POST['voirCommentaires'])) {

header("Refresh: 0; ../admin/admin-photoCommentaires.php?idPhoto=$idPhoto");

}

else if(isset($_POST['supprimerPhoto'])) {
    $sql = "DELETE FROM photo where id_photo = '".$idPhoto."'";
    mysqli_query($db,$sql);
    header("Refresh: 0; ../admin/admin-photos.php?Album=$idAlbum");
}


/**
 * Si l'utilisateur clique sur supprimer commentaire
 */
else if(isset($_POST['supprimerCommentaire'])) {
  $idCommentaire = $_POST['idCommentaire'];
  $idPhoto = $_POST['idPhoto'];
  
  
  $sql = "DELETE FROM commentaire WHERE id_commentaire = $idCommentaire";
  mysqli_query($db,$sql);
  header("Refresh: 0.001; ../admin/admin-photoCommentaires.php?idPhoto=$idPhoto");
  echo "<script>alert('Le commentaire à bien été supprimé !');</script>";
}

?>