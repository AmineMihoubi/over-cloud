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
  <div  style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
    <h1>Création d'une Galerie</h1>
  </div>

  <div  style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
    <label>Copier le lien suivant</label>
  </div>
  <div  style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
    <a href="" id="lienNouveauGalerie">noLink</a>

    <?php
    if ($_SESSION['GallerieCreated'] === FALSE) {
      $id = $_SESSION['idUtilisateur'];
      $sql = "INSERT INTO galerie (nom, prive) VALUES ('{$_SESSION['nouveauNomGalerie']}', '{$_SESSION['TypeGalerie']}');";
      $sql2 = "INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie, fk_id_type_utilisateur) VALUES ('{$_SESSION['idUtilisateur']}', (SELECT id_galerie from galerie order by id_galerie desc limit 1),1);";
      $sql3 = "INSERT INTO album (nom, fk_id_galerie) VALUES('Default',(SELECT id_galerie from galerie order by id_galerie desc limit 1));";
      $res = mysqli_query($db, $sql);
      if ($res === TRUE) {
        $_SESSION['last_Id'] = $db->insert_id;
      }
      $res2 = mysqli_query($db, $sql2);
      $res3 = mysqli_query($db, $sql3);

      if ($res && $res2 && $res3) {
        $done = 'true';
        $_SESSION['GallerieCreated'] = TRUE;
      } else {
        echo "NOPE";
        echo "one " . $res;
        echo "two " . $res2;
        echo "three " . $res3;
        echo "HELLLOOOO" . $user;
      }
    } else {
      $done = 'false';
    }

    ?>

    <script>
      var true_link = "albums?id=" + <?php echo $_SESSION['last_Id'] ?>;
      var show_link = "https://over-cloud.com/pages/albums?id=" + <?php echo $_SESSION['last_Id'] ?>;
      console.log(<?php echo $_SESSION['last_Id'] ?>);
      document.getElementById("lienNouveauGalerie").href = true_link;
      document.getElementById("lienNouveauGalerie").innerHTML = show_link;
    </script>


    <input type="hidden" id="done" value="<?php echo $done ?>" />

  </div>
  <div  style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
    <button type="submit" class="button" name="Submit">Terminer</button>
  </div>

  <?php
  if (isset($_POST['Submit'])) {
      header("location:listeGalerie.php");
    }
  }

  ?>

</body>

</html>
