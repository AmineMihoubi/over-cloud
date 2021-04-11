<?php
session_start();
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
  <form action="nouveau-galerie-nom.php" method="POST">

    <div>
      <h1>Création d'une Gallerie</h1>
      <br/><br/>
    </div>

    <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
      <label>Nom de la gallerie</label>
      <br/><br/><br/><br/>
      <br/><br/><br/><br/>
      <input type="text" name="NomGalerie" />
      <br/><br/>
    </div>

    <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
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
      header("location:nouveau-galerie-lien.php");
    }
  }

  ?>



</body>

</html>
