<?php
session_start();
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
if (isset($_GET['courriel'])) {
  $courriel = $_GET['courriel'];
}
if (isset($_GET['idGalerie'])) {
  $idGalerie = $_GET['idGalerie'];
}
if (isset($_GET['idPhoto'])) {
  $idPhoto = $_GET['idPhoto'];
}
$idAdmin = $_SESSION['idAdmin'];

date_default_timezone_set('America/New_york');
$date = date("Y-m-d H:i:s");




/**
 * Si l'utilisateur clique sur supprimerGalerie
 */
if (isset($_POST['supprimerGalerie'])) {
  echo '<script>alert("On va retirer la galerie sous peu")</script>';
  $sqlNomGalerie = "SELECT nom FROM galerie where id_galerie = '" . $idGalerie . "'";
  $resultName = mysqli_query($db, $sqlNomGalerie);
  $row =  mysqli_fetch_array($resultName);
  $galerieName = $row['nom'];

  $sql = "DELETE FROM galerie where id_galerie = '" . $idGalerie . "'";
  mysqli_query($db, $sql);
  $sql1 = "DELETE FROM utilisateur_galerie where fk_id_galerie = '" . $idGalerie . "'";
  mysqli_query($db, $sql1);

  $description = "Supprime la galerie : $galerieName";
  $sqlChangement = "INSERT INTO administrateur_changement (id_administrateur,description,date) VALUES ('" . $idAdmin . "','".$description."','" . $date . "')";
  mysqli_query($db, $sqlChangement);

  //echo '<script>alert("Ajout dans les logs ce qui a été fait")</script>';
  header('Refresh: 0; ../admin/listeGaleries.php');
}


/**
 * Si l'utilisateur clique sur supprimer Utilisateur.
 */
else if (isset($_POST['supprimerUtilisateur'])) {
  // echo '<script>alert("On va retirer le user sous peu")</script>';
  $sqlIdUtilisateur = "SELECT id_utilisateur FROM utilisateur where courriel = '" . $courriel . "'";
  $resultName = mysqli_query($db, $sqlIdUtilisateur);
  $row =  mysqli_fetch_array($resultName);
  $idUtilisateur = $row['id_utilisateur'];


  $sql = "DELETE FROM utilisateur where id_utilisateur = '" . $idUtilisateur . "'";
  mysqli_query($db, $sql);
  $description = "Supprime l'utilisateur: $idUtilisateur";

  $sqlChangement = "INSERT INTO administrateur_changement (id_administrateur,description,date) VALUES ('" . $idAdmin . "','" . $description . "','" . $date . "')";
  mysqli_query($db, $sqlChangement);

  $sql1 = "SELECT fk_id_galerie FROM utilisateur_galerie where fk_id_utilisateur = '" . $idUtilisateur . "'";
  $res =  mysqli_query($db, $sql1);
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      $idGalerie = $row['fk_id_galerie'];
      $sqlNomGalerie = "SELECT nom FROM galerie where id_galerie = '" . $idGalerie . "'";
      $resultName = mysqli_query($db, $sqlNomGalerie);
      $row =  mysqli_fetch_array($resultName);
      $galerieName = $row['nom'];

      $sql2 = "DELETE FROM galerie where id_galerie = '" . $idGalerie . "'";
      mysqli_query($db, $sql2);

      //ajout dans les logs.
      $description = "Supprime la galerie  {$galerieName}";
      $sqlChangement = "INSERT INTO administrateur_changement (id_administrateur,description,date) VALUES ('" . $idAdmin . "','" . $description . "','" . $date . "')";
      mysqli_query($db, $sqlChangement);
    }
  }

  /*echo '<script>alert("Ajout dans les logs ce qui a été fait")</script>';*/
  header('Refresh: 0; ../admin/listeUtilisateur.php');
}

/**
 * Si l'utilisateur clique sur voir les photos d'une Galerie
 */
else if (isset($_POST['voirPhotos'])) {

  header("Refresh: 0; ../admin/admin-photos.php?galerie=$idGalerie");
}

/**
 * Si l'utilisateur clique sur voir les commentaires
 */
else if (isset($_POST['voirCommentaires'])) {

  header("Refresh: 0; ../admin/admin-photoCommentaires.php?idPhoto=$idPhoto");
} else if (isset($_POST['supprimerPhoto'])) {
  $sql = "DELETE FROM photo where id_photo = '" . $idPhoto . "'";
  mysqli_query($db, $sql);
  $description = "Supprime une photo";
  $sqlChangement = "INSERT INTO administrateur_changement (id_administrateur,description,date) VALUES ('" . $idAdmin . "','" . $description . "','" . $date . "')";
  mysqli_query($db, $sqlChangement);
  header("Refresh: 0; ../admin/admin-photos.php?galerie=$idGalerie");
}


/**
 * Si l'utilisateur clique sur supprimer commentaire
 */
else if (isset($_POST['supprimerCommentaire'])) {
  $idCommentaire = $_POST['idCommentaire'];
  $idPhoto = $_POST['idPhoto'];


  $sql = "DELETE FROM commentaire WHERE id_commentaire = $idCommentaire";
  mysqli_query($db, $sql);
  $description = "Supprime un commentaire";
  $sqlChangement = "INSERT INTO administrateur_changement (id_administrateur,description,date) VALUES ('" . $idAdmin . "','" . $description . "','" . $date . "')";
  mysqli_query($db, $sqlChangement);
  header("Refresh: 0.001; ../admin/admin-photoCommentaires.php?idPhoto=$idPhoto");
  echo "<script>alert('Le commentaire à bien été supprimé !');</script>";
}
