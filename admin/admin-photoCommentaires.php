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
  <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>


    <!-- Bare de navigation !-->
    <div id=navigationBar></div>
    <script>
        $(function() {
            $("#navigationBar").load("navigationbar-admin.php");
        });
    </script>


    <div id=imageZoom>
    <?php
    $sql = "select * from photo where id_photo = $idPhoto";
    $res = mysqli_query($db, $sql);
    $rep = mysqli_fetch_array($res);
    echo '<img src="data:../image/jpeg;base64,' . base64_encode($rep["photo"]) . ' "class=gallery_img"/>';
    ?>
  </div>

  <div id=section-commentaires>
    <?php
    $sql = "SELECT fk_id_auteur,message,date,id_commentaire FROM commentaire where fk_id_photo = $idPhoto ";
    $result = mysqli_query($db, $sql);
    while ($row =  mysqli_fetch_array($result)) {
      $idAuteur = $row['fk_id_auteur'];
      $commentaire = $row['message'];
      $dateCommentaire =  date('d-m-Y', strtotime($row['date']));
      $idCommentaire = $row['id_commentaire'];

      $requete = "SELECT nom,prenom FROM utilisateur WHERE id_utilisateur = $idAuteur";
      $exec_requete = mysqli_query($db, $requete);
      $reponse      = mysqli_fetch_assoc($exec_requete);
      $nom = $reponse['nom'];
      $prenom = $reponse['prenom'];
      echo "
          <div class=commentaires>
          <i>$prenom, $nom</i>
          <i> / $dateCommentaire</i>
          <br></br>
          <h7>$commentaire</h5>
          <form action='../php/actionUtilisateur.php' method='post'> 
          <input type='submit' name='supprimerCommentaire' class='button-supprimer' value=Supprimer></input>
          <input  type='hidden' name='idPhoto' value='$idPhoto'/>
          <input  type='hidden' name='idCommentaire' value='$idCommentaire'/>
          </from>
          </div>";
    }
    ?>


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
