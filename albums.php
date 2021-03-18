<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="css/styles.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>

  <?php
  session_start();
  require 'ConnectDb.php';
  if($_GET['id'] != null) {
    $_SESSION['idGalerie'] = $_GET['id'];
  }
  ?>

  <!-- bare de navigation-->
  <div id=navigationBar></div>
  <script>
    $(function() {
      $("#navigationBar").load("navigationbar.php");
    });
  </script>

  <div id=listeAlbums>
    <?php
    $id = $_SESSION['idGalerie'];
    $db = ConnectDb::getInstance();
    $sql = "SELECT id_album, nom FROM album where fk_id_galerie = '$id'";
    $result = mysqli_query($db, $sql);

    while ($row =  mysqli_fetch_array($result)) {
      $idAlbum = $row['id_album'];
      $nom = $row['nom'];

      echo "<div class = carteAlbum>
                <a href='photoAlbum?id=$idAlbum'>    
                <br></br> 
                <b>$nom</b>
                </a>
                </div>";
    }
    ?>
    <div id= nouvelle-album>
    <a href='creation-Album.php'>
    <br></br> 
    <b>Créer un nouvelle album</b>
    </a>
    </div>
  </div>
</body>