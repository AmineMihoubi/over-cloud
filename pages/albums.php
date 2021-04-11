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

  if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
    header('Location: ../index.php');
  }

  require '../php/ConnectDb.php';
  if ($_GET['id'] != null) {
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

    $typeSql = "SELECT prive FROM galerie where id_galerie = '$id'";
    $resultType = mysqli_query($db, $typeSql);
    $row1 =  mysqli_fetch_array($resultType);
    $typeAlbum = $row1['prive'];
    //echo "<script>alert('Prive : $typeAlbum ');</script>";
    if ($typeAlbum == 1) {
      $ownerSQL = "SELECT fk_id_utilisateur FROM utilisateur_galerie where fk_id_galerie = '$id'";
      $resultOwner = mysqli_query($db, $ownerSQL);
      $row2 =  mysqli_fetch_array($resultOwner);
      $ownerID = $row2['fk_id_utilisateur'];
      //echo "<script>alert('Owner id: $ownerID ');</script>";
      //$loginID = $_SESSION['idUtilisateur'];
      //echo "<script>alert('Logged in ID: $loginID');</script>";
      if ($_SESSION['idUtilisateur'] != $ownerID) {
        header('Location: 404.php');
      }
    }



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
        </div>";
    }
    ?>
    <div class="column">
      <div id=nouvelle-album>
        <a href='creation-Album.php'>
          <br></br>
          <b>Créer un nouvel album</b>
        </a>
      </div>
    </div>
  </div>


</body>