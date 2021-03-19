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


  <form action="newGalleryName.php" method="POST">
    <div>
      <h1>Création d'une Gallerie</h1>
      <br /><br />
      <label>Nom de la gallerie</label>
      <br /><br /><br /><br />
      <input type="text" name="NomGalerie" />
      <br /><br />
      <button type="submit" class="button" name="Submit">Suivant</button>
    </div>
  </form>


  <?php
  if (isset($_POST['Submit'])) {

    $nouveauNomGalerie = $_POST['NomGalerie'];

    $_SESSION['nouveauNomGalerie'] = $nouveauNomGalerie;





    header("location:newGalleryLink.php");
  }

  ?>



</body>

</html>