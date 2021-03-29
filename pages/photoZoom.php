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
    <i>Nahwa Al-Ansary</i>
    <br></br>
    <h7>Très belle photo de ton mariage!</h5>
    <hr></hr>
  </div>
  <div class = commentaires>
    <i>Assim Amenas</i>
    <br></br>
    <h7>Magnifique!!!</h5>
    <hr></hr>
  </div>

  <div id = text-Area>
  <form>
    <textarea></textarea>
</form>
<input type='button' value='Envoyer votre commentaire' />
  </div> 

  </div>
</body>