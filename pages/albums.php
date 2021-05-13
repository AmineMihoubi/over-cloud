<?php
session_start();
require '../php/ConnectDb.php';
if ($_GET['id'] != null) {
  $_SESSION['idGalerie'] = $_GET['id'];
  $_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
  <div>
    <!-- bare de navigation-->
    <div id=navigationBar></div>
    <script>
      $(function() {
        $("#navigationBar").load("navigationbar.php");
      });
    </script>

    <?php
    if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
      header('Location: ../index.php');
    }

    if ($_GET['id'] != null) {
      $_SESSION['idGalerie'] = $_GET['id'];
    }
    ?>

    <div class="container">
      <?php
      $id = $_SESSION['idGalerie'];
      $db = ConnectDb::getInstance();

      $typeSql = "SELECT * FROM galerie where id_galerie = '$id'";
      $resultType = mysqli_query($db, $typeSql);
      $row1 =  mysqli_fetch_array($resultType);
      $typeGalerie = $row1['type'];
      $statusGalerie = $row1['status'];
      if ($statusGalerie != 0) { //if the galerie is not public
        if ($typeGalerie == 1) { //if the galerie is individual. check if we're the owner
          $ownerSQL = "SELECT fk_id_utilisateur FROM utilisateur_galerie where fk_id_galerie = '$id' AND fk_id_type_utilisateur = 1";
          $resultOwner = mysqli_query($db, $ownerSQL);
          $row2 =  mysqli_fetch_array($resultOwner);
          $ownerID = $row2['fk_id_utilisateur'];
          if ($_SESSION['idUtilisateur'] != $ownerID) {
            header('Location: 404.php');
          }
        } else { //if the galery is group, check if we're one of the users allowed.
          $sqlInviteId = "SELECT fk_id_utilisateur FROM utilisateur_galerie where fk_id_galerie = '$id'";
          $resIdInvite = mysqli_query($db, $sqlInviteId);
          $hasAccess = false;
          while ($row = mysqli_fetch_assoc($resIdInvite)) {
            $idUserInvited = $row['fk_id_utilisateur'];
            if ($idUserInvited == $_SESSION['idUtilisateur']) {
              $hasAccess = true;
            }
          }
          if (!$hasAccess) {
            header('Location: 404.php');
          }
        }
      }


      $sql = "SELECT id_album, nom FROM album where fk_id_galerie = '$id'";
      $result = mysqli_query($db, $sql);
      ?>

      <div class="display">
        <?php
        $id = $_SESSION['idGalerie'];
        $sql = "SELECT id_album, nom FROM album where fk_id_galerie = '$id'";
        $result = mysqli_query($db, $sql);

        while ($row =  mysqli_fetch_array($result)) {
          $idAlbum = $row['id_album'];
          $nom = $row['nom'];

          echo "
            <a href='photoAlbum?id=$idAlbum'>
                <div class = card>
                <img src= ../image/album.png> 
                <h3>$nom</h3>
               
                </div> </a>";
        }
        ?>
        <a href='creation-album.php'>
          <div class=creation>
            <h1>+</h1>
          </div>
        </a>

      </div>
    </div>
  </div>

</body>