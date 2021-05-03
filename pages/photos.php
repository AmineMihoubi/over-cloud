<?php
require '../php/ConnectDb.php';
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
    header('Location: ../index.php');
}
$db = ConnectDb::getInstance();

$sql_afficher_photos = "select * from photo where fk_id_album in (select id_album from album where fk_id_galerie in (select fk_id_galerie from utilisateur_galerie where fk_id_utilisateur like '{$_SESSION['idUtilisateur']}'))";
$res = mysqli_query($db, $sql_afficher_photos);
$_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

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
            <form method="POST" action="photos.php" enctype="multipart/form-data">
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
                    echo '<img id = "image" src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "class=gallery_img"/>';
                }
            } else {
                echo "0 results";
            }

            ?>
        </div>
    </div>

    <?php


    if (isset($_POST['upload'])) {
        $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);


        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

        $sql = "INSERT INTO photo(photo,date,fk_id_album) VALUES ('$image','2021-03-14', 1)";
        
        // Execute query
        if (mysqli_query($conn, $sql)) {
            $page = $_SESSION['urlPrecedent'];
            echo "<br/>YAY.";
            echo "<script> window.location.replace('$page'); </script>";
        } else {
            echo "<br/>NOOO.";
        }
    }

    ?>
    <script src="../js/popupscript.js"></script>
</body>

</html>