<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/radiobtn.css" media="screen" type="text/css">
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

    //$user = $_SESSION['idUtilisateur'];
    
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'overcloud';
    $db_host     = 'localhost';

    //Connecting to the database
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if (!$conn) {
      die("could not connect to database: " . mysqli_connect_error());
    }


    $sql = "INSERT INTO galerie (nom, prive) VALUES ('{$_SESSION['nouveauNomGalerie']}', '{$_SESSION['TypeGalerie']}');";
    $sql2 = "INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie, fk_id_type_utilisateur) VALUES ((SELECT id_utilisateur from utilisateur order by id_utilisateur desc limit 1), (SELECT id_galerie from galerie order by id_galerie desc limit 1),1);";
    $sql3 = "INSERT INTO album (nom, fk_id_galerie) VALUES('Default',(SELECT id_galerie from galerie order by id_galerie desc limit 1));";
    $res = mysqli_query($conn, $sql);
    $res2 = mysqli_query($conn, $sql2);
    $res3 = mysqli_query($conn, $sql3);

    if ($res&&$res2&&$res3) {
      $done = 'true';
    } else {
      echo "NOPE";
      echo "one ".$res;
      echo "two ".$res2;
      echo "three ".$res3;
    }
    ?>

    <input type="hidden" id="done" value="<?php echo $done ?>" />

  </div>
  <div class="SubmitHolder">
    <a href="albums.php" class="button">Terminer</a>
  </div>
  </div>

</body>

</html>