<?php
require '../php/ConnectDb.php';
session_start();
$db = ConnectDb::getInstance();
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

    <?php
    $idAlbum = $_GET['id'];
    $sql_afficher_photos = "select * from photo where fk_id_album = '$idAlbum' AND  fk_id_album in (select id_album from album where fk_id_galerie in (select fk_id_galerie from utilisateur_galerie where fk_id_utilisateur like '{$_SESSION['idUtilisateur']}'))";
    $res = mysqli_query($db, $sql_afficher_photos);
    ?>

    <body>
        <div id=navigationBar></div>
        <script>
            $(function() {
                $("#navigationBar").load("navigationbar.php");
            });
        </script>


        <div class="actionsbar-container">

            <ul class="actionsbar-ul">
                <li> </li>
                <li class="actionsbar-nav-li"><a id="button" class="button">Ajouter +</a></li>
            </ul>

        </div>

        <div class="bg-popup">
            <div class="popup-content">
                <div class="btn-fermer">+</div>
                <form method="POST" action="" enctype="multipart/form-data">
                    <br /><br /><br /><br /><br /><br />
                    <input class="popup-input" type="file" name="image">
                    <input class="popup-input" type="submit" name="upload" value="Upload"></li>
                    </ul>
                </form>

            </div>
        </div>


        <div class="gallerycontainer">
            <div class="gallery">

                <?php

                //was able to show the images certain way, gotta see if i can show a certain amount per line
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $idPhoto = $row['id_photo'];
                        echo '<a href=photoZoom?idPhoto='.$idPhoto.'>   
                        <img id = "image" src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "class=gallery_img"/>
                        </a>';
                    }
                } else {
                    echo "0 results";
                }

                ?>
            </div>
        </div>

        <?php


        if (isset($_POST['upload'])) {
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $sql = "INSERT INTO photo(photo,date,fk_id_album) VALUES ('$image','2021-03-14', '$idAlbum')";

            // Execute query 
            if ($db->query($sql) === TRUE) {
                $last_id = $db->insert_id;
                echo "<br/>YAY." . $last_id;
            } else {
                echo "<br/>NOOO.";
            }
            //update l'image de couverture de l'album
            $sql2 = "UPDATE album SET fk_id_photo='$last_id' WHERE id_album='$idAlbum'";
            mysqli_query($db, $sql2);
        }

        ?>
        <script src="../js/popupscript.js"></script>
    </body>

</html>