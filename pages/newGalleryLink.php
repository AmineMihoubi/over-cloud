<?php
require '../php/ConnectDb.php';
session_start();
$db = ConnectDb::getInstance(); 
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../css/radiobtn.css" media="screen" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>

<body>
  <div>
    <h1>Création d'une Galerie</h1>
  </div>

  <div>
    <label>Copier le lien suivant</label>
  </div>
  <div>
    <a href="" id="lienNouveauGalerie">noLink</a>

    <script>
      //based on the info in the localStorage, creates the link to the album. (that was before i learned of the existence of php)
      var name = localStorage.getItem("NomGalerie");
      var type = localStorage.getItem("TypeGalerie");
      var prive;
      var link = "http://over-cloud.com/album?=";
      if ((type == "Group")) {
        prive = 0;
        link = link + "g";
      } else {
        prive = 1;
        link = link + "p";
      }
      link = link + name;
      document.getElementById("lienNouveauGalerie").href = link;
      document.getElementById("lienNouveauGalerie").innerHTML = link;
    </script>


    <?php

    $id = $_SESSION['idUtilisateur'];
    $sql = "INSERT INTO galerie (nom, prive) VALUES ('{$_SESSION['nouveauNomGalerie']}', '{$_SESSION['TypeGalerie']}');";
    $sql2 = "INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie, fk_id_type_utilisateur) VALUES ('{$_SESSION['idUtilisateur']}', (SELECT id_galerie from galerie order by id_galerie desc limit 1),1);";
    $sql3 = "INSERT INTO album (nom, fk_id_galerie) VALUES('Default',(SELECT id_galerie from galerie order by id_galerie desc limit 1));";
    $res = mysqli_query($db, $sql);
    $res2 = mysqli_query($db, $sql2);
    $res3 = mysqli_query($db, $sql3);

    if ($res && $res2 && $res3) {
      $done = 'true';
    } else {
      echo "NOPE";
      echo "one " . $res;
      echo "two " . $res2;
      echo "three " . $res3;
      echo "HELLLOOOO" . $user;
    }
    ?>

    <input type="hidden" id="done" value="<?php echo $done ?>" />

  </div>
  <div class="SubmitHolder">
    <a href="listeGalerie.php" class="button">Terminer</a>
  </div>
  </div>

</body>

</html>