<?php
require '../php/ConnectDb.php';
session_start();
$db = ConnectDb::getInstance();
$idAlbum = $_GET['album'];

$sql_afficher_photos = "select * from photo where fk_id_album = $idAlbum";

/*in (select id_album from album where fk_id_galerie in (select fk_id_galerie from utilisateur_galerie where fk_id_utilisateur like '{$_SESSION['idUtilisateur']}'))";*/
$res = mysqli_query($db, $sql_afficher_photos);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>
    <!-- Bare de navigation !-->
    <div id=navigationBar></div>
    <script>
        $(function() {
            $("#navigationBar").load("navigationbar-admin.php");
        });
    </script>


    <div class="actionsbar-container">

        <ul class="actionsbar-ul">
            <li> </li>
            <li><a href="listeAlbums.php" id="button" class="button">Retour</a></li>
        </ul>

    </div>


    <div class="gallerycontainer">
        <div class="gallery">

            <?php

            //was able to show the images certain way, gotta see if i can show a certain amount per line
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idPhoto = $row['id_photo'];
                    echo '
                        <div class = "photo">
                        <img id = "image" src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "class=gallery_img"/>';

                    echo "
                        <form action='../php/actionUtilisateur.php?idPhoto=$idPhoto&idAlbum=$idAlbum'  method='post'>
                        <input type='submit' name='voirCommentaires' value='Voir les commentaires'/>
                        <input type='submit' name='supprimerPhoto' value='Supprimer' />
                        </form>
                        </div>";
                }
            } else {
                echo "0 results";
            }

            ?>
        </div>
    </div>
</body>

</html>