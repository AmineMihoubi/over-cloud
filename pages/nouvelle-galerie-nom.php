<?php
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
  header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../css/radiobtn.css" media="screen" type="text/css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>

<body>

  <div class="container">
    <form action="nouvelle-galerie-nom.php" method="POST">

      <div>
        <h1>Création d'une Gallerie</h1>
        <br /><br />
      </div>

      <div class="container">
        <label>Nom de la gallerie</label>
        <br /><br /><br /><br />
        <br /><br /><br /><br />
        <input type="text" name="NomGalerie" />
        <br /><br />
      </div>

      <div class="container">
        <button type="submit" class="button" name="Submit">Suivant</button>
      </div>

    </form>
  </div>

  <?php
  if (isset($_POST['Submit'])) {
    $nouveauNomGalerie = $_POST['NomGalerie'];
    if (!isset($nouveauNomGalerie) || trim($nouveauNomGalerie) == '') {
      echo '<script type="text/javascript">';
      echo ' alert("Le nom de la gallerie ne peut pas être vide! Veuillez entrer un nom")';  //not showing an alert box.
      echo '</script>';
    } else {
      $_SESSION['nouveauNomGalerie'] = $nouveauNomGalerie;
      $typeChoisi = $_SESSION["TypeGalerie"];
      if ($typeChoisi == '0') {
        header("location:nouvelle-galerie-ajout-utilisateurs.php");
      } else {
        header("location:nouvelle-galerie-status.php");
        //header("location:nouvelle-galerie-lien.php");
      }
    }
  }
  ?>
</body>

</html>