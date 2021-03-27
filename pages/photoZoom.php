<?php
    session_start();
    require '../php/ConnectDb.php';
    $db = ConnectDb::getInstance();
    $idPhoto = $_GET['idPhoto'];
    ?>

<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>


  <!-- bare de navigation-->
  <div id=navigationBar></div>
  <script>
    $(function() {
      $("#navigationBar").load("navigationbar.php");
    });
  </script>

  <div id=imageZoom>
    <?php
    $sql = "select * from photo where id_photo = $idPhoto";
    $res = mysqli_query($db, $sql);
    $rep = mysqli_fetch_array($res);
    echo '<img src="data:../image/jpeg;base64,' . base64_encode($rep["photo"]) . ' "class=gallery_img"/>';
    ?>
  </div>

  <div id = section-commentaires>
  <div class = commentaires>
    
  </div>
  </div>
</body>