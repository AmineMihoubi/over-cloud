<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>

  <?php
  session_start();
  require '../php/ConnectDb.php';
  ?>

  <!-- bare de navigation-->
  <div id=navigationBar></div>
  <script>
    $(function() {
      $("#navigationBar").load("navigationbar.php");
    });
  </script>

<div id=creation-album>
<form action="../php/validerCreationAlbum.php" method="POST">
<h1>Donnez un nom à votre album</h1>
<input type="text" class="champSaisieUtilisateur" placeholder="Le nom de l'album" name="nom">
<input type="submit" class="buttonConfirmer" name="submit" value="Valider la création">
</from>
</div>
</body>