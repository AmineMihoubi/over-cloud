<?php
    session_start();
    require '../php/ConnectDb.php';
    if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
        header('Location: ../index.php');
    }
    $db = ConnectDb::getInstance();
    $id = $_SESSION['idGalerie'];
    $sql = "SELECT * from photo LEFT JOIN album ON photo.fk_id_album = album.id_album WHERE album.fk_id_galerie = '$id' ORDER BY photo.date";
    $result = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>
    <div>
        <!-- bare de navigation-->
        <div id=navigationBar></div>

        <script>
            $(function() {
                $("#navigationBar").load("navigationbar.php");
            });
        </script>
        <div style="margin-left: 200px;">
            <div>
                <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $nomAlbum = $row['nom']; 
                            $date = $row['date'];
                            echo "+Ajouté dans $nomAlbum le $date <br>";
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>