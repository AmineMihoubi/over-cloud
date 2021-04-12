<?php
session_start();
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
$idPhoto = $_GET['idPhoto'];

?>

<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>


  <!-- bare de navigation-->
  <div id=navigationBar></div>
  <script>
    $(function() {
      $("#navigationBar").load("navigationbar.php");
    });
  </script>

  <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
    <!--Content-->

    <div class="actionsbar-container">

      <ul>
        <li><a id="button" class="button">Supprimer la photo</a></li>
      </ul>

    </div>

    <div class="bg-popup">
      <div class="popup-content">
        <div class="btn-fermer">+</div>
        <form method="POST" action="" enctype="multipart/form-data">
          <br /><br /><br /><br /><br /><br />
          <input class="popup-input" type="submit" name="confirm" value="Confirmer"></li>
        </form>

      </div>
    </div>

    <div id=imageZoom>
      <!--l'image en grand-->
      <?php
      $sql = "select * from photo where id_photo = $idPhoto";
      $res = mysqli_query($db, $sql);
      $rep = mysqli_fetch_array($res);
      echo '<img src="data:../image/jpeg;base64,' . base64_encode($rep["photo"]) . ' "class=gallery_img"/>';
      ?>

  <div id=section-commentaires>
    <?php
    $sql = "SELECT fk_id_auteur,message FROM commentaire where fk_id_photo = $idPhoto ";
    $result = mysqli_query($db, $sql);
    while ($row =  mysqli_fetch_array($result)) {
      $idAuteur = $row['fk_id_auteur'];
      $commentaire = $row['message'];

      $requete = "SELECT nom,prenom FROM utilisateur WHERE id_utilisateur = $idAuteur";
      $exec_requete = mysqli_query($db, $requete);
      $reponse      = mysqli_fetch_assoc($exec_requete);
      $nom = $reponse['nom'];
      $prenom = $reponse['prenom'];
      echo "
          <div class=commentaires>
          <i>$prenom, $nom</i>
          <br></br>
          <h7>$commentaire</h5>
          <hr></hr>
          </div>";
    }
    ?>
    <div id=text-Area>
      <form method="post" action="../php/envoyerCommentaire.php">
        <textarea name="commentaire" ></textarea>
        <input  type="hidden" name="idPhoto" value="<?php echo $idPhoto;?>"></input>
        <input name='submit' type='submit' value='Envoyer votre commentaire' />
      </form>
      
    </div>

  </div>

  <?php

        if (isset($_POST['confirm'])) {
            $sql = "DELETE FROM photo where id_photo like $idPhoto";
            // Execute query
            if (mysqli_query($db, $sql)) {
              $page = $_SESSION['urlPrecedent'];
                echo "<br/>YAY.";
                echo "<script> document.getElementsByClassName('.bg-popup').style.display = 'none'; </script>";
                echo "<script> window.location.replace('$page'); </script>"; //replace la page courante a la page voulu, dans ce cas, la page precedente
            } else {
                echo "<br/>NOOO.";
            }
        }

        ?>

  <script src="../js/popupscript.js"></script>
</body>
