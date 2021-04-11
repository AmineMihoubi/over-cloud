<?php
session_start();
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
$courriel = $_GET['courriel'];
$idAlbum = $_GET['idAlbum'];


/**
 * Si l'utilisateur clique sur supprimer
 */
if(isset($_POST['supprimer'])) {
$sql = "DELETE FROM utilisateur where courriel = '".$courriel."'";
mysqli_query($db,$sql);
header('Refresh: 0.2; ../admin/listeUtilisateur.php');
}

/**
 * Si l'utilisateur clique sur voir les photos d'un Album
 */
else if(isset($_POST['voirPhotos'])) { 

header("Refresh: 0.2; ../admin/admin-photos.php?album=$idAlbum");

}

/**
 * Si l'utilisateur clique sur voir les albums
 */
else if(isset($_POST['sd'])) {
    $sql = "SELECT id_utilisateur FROM utilisateur where courriel = '".$courriel."'";
$exec_requete = mysqli_query($db,$sql);
$reponse      = mysqli_fetch_assoc($exec_requete);
$id = $reponse['id_utilisateur'];

header("Refresh: 0.2; ../admin/listeGaleries.php?id=$id");

}



?>