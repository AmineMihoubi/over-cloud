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

  <div class="row">
    <?php
    $id = $_SESSION['idGalerie'];
    $db = ConnectDb::getInstance();
    $sql = "SELECT id_album, nom FROM album where fk_id_galerie = '$id'";
    $result = mysqli_query($db, $sql);

    while ($row =  mysqli_fetch_array($result)) {
      $idAlbum = $row['id_album'];
      $nom = $row['nom'];

      echo "
      <div class=column>
      <div class = card>
                <a href='photoAlbum?id=$idAlbum'>
                <br></br>

                <b class= card_title>$nom</b>

                </a>
                </div>
        </div>"
        ;
    }
    ?>
    <div class="column">
    <div id= nouvelle-album>
    <a href='creation-Album.php'>
    <br></br>
    <b>Créer un nouvel album</b>
    </a>
    </div>
    </div>
  </div>


</body>
