<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="css\newGallery.css" media="screen" type="text/css" />
</head>

<body class="TypeSelectionPage">
  <div id="Titre">
    <h1>Créaction d'une Gallerie</h1>
  </div>

  <div style="text-align: center;margin-bottom: 50px">
    <label>Copier le lien suivant</label>
  </div>
  <div style="text-align: center">
    <a href="" id="linkNewGallery">noLink</a>

    <script>
      //based on the info in the localStorage, creates the link to the album. (that was before i learned of the existence of php)
      var name = localStorage.getItem("galleryName");
      var type = localStorage.getItem("new-gallery-type");
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
      document.getElementById("linkNewGallery").href = link;
      document.getElementById("linkNewGallery").innerHTML = link;
    </script>


    <?php
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'overcloud';
    $db_host     = 'localhost';

    //Connecting to the database
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

    if (!$conn) {
      die("could not connect to database: " . mysqli_connect_error());
    }

    $type = mysqli_real_escape_string($conn, htmlspecialchars($_POST['type']));
    $name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));
    $sql = "insert into gallerie (nom, prive) VALUES ('$name', '$type')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
      $done = 'true';
    } else {
      echo "L'album existe déjà";
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