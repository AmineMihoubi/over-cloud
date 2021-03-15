<html>
  <head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link
      rel="stylesheet" href="css\styles.css" media="screen" type="text/css"/>
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
      
  </head>

  <body>
        
<?php
    session_start();
    require 'ConnectDb.php';
    $idAlbum = $_GET['id'];
?>
        
      <!-- bare de navigation-->
    <div id = navigationBar></div>
        <script>
            $(function(){
            $("#navigationBar").load("navigationbar.php");
            });
        </script>
    </body>
