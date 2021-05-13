<?php
require '../php/ConnectDb.php';
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
  header('Location: ../index.php');
}
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
  <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">

    <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
      <h1>Création d'une Galerie</h1>
    </div>

    <br /><br /><br /><br />

    <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
      <label>Copier le lien suivant</label>
    </div>

    <br /><br /><br /><br />
    <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
      <a href="" id="lienNouveauGalerie">noLink</a>

      <?php
      if ($_SESSION['GallerieCreated'] === FALSE) {
        $id = $_SESSION['idUtilisateur'];
        $sql = "INSERT INTO galerie (nom, type,status) VALUES ('{$_SESSION['nouveauNomGalerie']}', '{$_SESSION['TypeGalerie']}','{$_SESSION['StatusGalerie']}' );";
        $sql2 = "INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie, fk_id_type_utilisateur) VALUES ('{$_SESSION['idUtilisateur']}', (SELECT id_galerie from galerie order by id_galerie desc limit 1),1);";
        $sql3 = "INSERT INTO album (nom, fk_id_galerie,date) VALUES('Default',(SELECT id_galerie from galerie order by id_galerie desc limit 1),CURDATE());";
        $res = mysqli_query($db, $sql);
        if ($res === TRUE) {
          $_SESSION['last_Id'] = $db->insert_id;
        }
        $res2 = mysqli_query($db, $sql2);
        $res3 = mysqli_query($db, $sql3);

        //echo '<script type="text/javascript">alert("we finished inserting all the things for the author");</script>';
        $typeChoisi = $_SESSION["TypeGalerie"];
        if ($typeChoisi == '0') {
          $listEmails = $_SESSION['listEmails'];
          // echo '<script>console.log(' . json_encode($listEmails) . ');</script>';
          foreach ($listEmails as $item) {
            $email = $item;
            //echo '<script>console.log(' . json_encode($email) . ');</script>';
            $sqlInviteId = "SELECT id_utilisateur from utilisateur WHERE courriel='{$email}'";
            $resIdInvite = mysqli_query($db, $sqlInviteId);
            if (mysqli_num_rows($resIdInvite) == 1) {
              // output data of each row
              while ($row = mysqli_fetch_assoc($resIdInvite)) {
                //echo '<script type="text/javascript">alert("We reached the row");</script>';
                //echo '<script>console.log(' . json_encode($row) . ');</script>';
                $idUserInvited = $row['id_utilisateur'];
                //echo '<script>console.log("User Id is: ' . $idUserInvited . '");</script>';
                if ($idUserInvited != $_SESSION['idUtilisateur']) {
                  $sql4 = "INSERT INTO utilisateur_galerie(fk_id_utilisateur, fk_id_galerie, fk_id_type_utilisateur) VALUES ('{$idUserInvited}', (SELECT id_galerie from galerie order by id_galerie desc limit 1),2);";
                  mysqli_query($db, $sql4);
                }
              }
            }
          }
          unset($item); // Détruit la référence sur le dernier élément
          unset($i);
        }

        if ($res && $res2 && $res3) {
          $done = 'true';
          $_SESSION['GallerieCreated'] = TRUE;
        } else {
          echo "NOPE";
          echo "one " . $res;
          echo "two " . $res2;
          echo "three " . $res3;
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

    <br /><br /><br /><br />

    <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
      <a href="liste-des-galeries.php" class="button">Terminer</a>
    </div>

  </div>

</body>

</html>