<html>
  <head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link
      rel="stylesheet" href="css\styles.css" media="screen" type="text/css"/>
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  </head>

  <body>
        <!-- bare de navigation-->
        <?php
         session_start();
        ?>
        <div id = navigationBar></div>
        <script>
        $(function(){
        $("#navigationBar").load("navigationbar.php");
        });
        </script>

    <div id = listeAlbums>
      <div class = carteAlbum>
      <img src="image/nophoto.jfif" alt="Pas d'image">
      <h4><b>Album blabla</b></h4>
      </div>     
      
      <div class = carteAlbum>
      <img src="image/nophoto.jfif" alt="Pas d'image">
      <h4><b>Album de voiture</b></h4>
      </div> 

    </div> 
  </body>