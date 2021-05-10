<?php
require '../php/ConnectDb.php';
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
    header('Location: ../index.php');
}
$db = ConnectDb::getInstance();

$idAlbum = $_GET['id'];
$galerieSQL = "SELECT fk_id_galerie, nom FROM album where id_album = '$idAlbum'";
$resultGalerie = mysqli_query($db, $galerieSQL);
$row0 =  mysqli_fetch_array($resultGalerie);
$idGalerie = $row0['fk_id_galerie'];

$nomAlbum = $row0['nom'];
$typeSql = "SELECT prive, nom FROM galerie where id_galerie = '$idGalerie'";
$resultType = mysqli_query($db, $typeSql);
$row1 =  mysqli_fetch_array($resultType);
$typeAlbum = $row1['prive'];
$nomGalerie = $row1['nom'];

date_default_timezone_set('America/New_york');
$currentDate = date("Y-m-d H:i:s");

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
$_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
?>

<?php
if (isset($_POST['upload'])) {
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $sql = "INSERT INTO photo(photo,date,fk_id_galerie) VALUES ('$image',curdate(), '$idGalerie')";
    $sql2 = "INSERT INTO photo_album(fk_id_photo,fk_id_album) VALUES (LAST_INSERT_ID(),'$idAlbum')";
    //IL FAUT VRAIMENT LES EXCUTES EN ORDRE A CAUSE DU LAST_INSERT_ID()
    $sql3 = "INSERT INTO historique(fk_id_utilisateur, action, date) VALUES ('{$_SESSION['idUtilisateur']}', 'à ajouté une photo dans $nomAlbum($nomGalerie)', curdate())";

    // Execute query
    if (mysqli_query($db, $sql)) {
        if (mysqli_query($db, $sql2)) {
            $page = $_SESSION['urlPrecedent'];
            echo "<br/>YAY.";
            echo "<script> window.location.replace('$page'); </script>";
        }
        else {
            echo "<br/>NOOO2.";
        }
    } else {
        echo "<br/>NOOO.";
    }
    header("Refresh: 0.001; photoAlbum.php?id=$idAlbum");

}

if (isset($_POST['confirm'])) {
    $sql2 = "DELETE FROM photo where id_album like $idAlbum";
    if (mysqli_query($db, $sql2)) {
        $sql = "DELETE FROM album where id_album like $idAlbum";
        // Execute query
        if (mysqli_query($db, $sql)) {
            $page = $_SESSION['urlPrecedent'];
            echo "<br/>YAY.";
            echo "<script> document.getElementsByClassName('.bg-popup2').style.display = 'none'; </script>";
            echo "<script> window.location.replace('$page'); </script>"; //replace la page courante a la page voulu, dans ce cas, la page precedente
        } else {
            echo "<br/>NOOO.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<!--afficher photos dans l'album-->
<?php
$idAlbum = $_GET['id'];
$sql_afficher_photos = "SELECT * FROM photo p join photo_album pa on p.id_photo = pa.fk_id_photo where pa.fk_id_album = $idAlbum";
$res = mysqli_query($db, $sql_afficher_photos);
?>

<body>
    <div id=navigationBar></div>
    <!--navigation-->
    <script>
        $(function() {
            $("#navigationBar").load("navigationbar.php");
        });
    </script>

    <div style="margin-left: 200px;">
        <!--content-->
        <div class="actionsbar-container">
            <ul>
                <li><a id="btn-ajouter" class="button">Ajouter +</a></li>
                <li> <a id="button" onClick="supprimerAlbum()"> Supprimer album</a> </li>
            </ul>

        </div>


        <script>
            function supprimerAlbum() {
                document.querySelector('.bg-popup2').style.display = 'flex';
            }
        </script>

    </div>


    <div class="bg-popup">
        <div class="popup-content">
            <div class="btn-fermer">+</div>
            <form method="POST" action="" enctype="multipart/form-data">
                <br /><br /><br /><br /><br /><br />
                <input class="popup-input" type="file" name="image">
                <input class="popup-input" type="submit" name="upload" value="Upload"></li>
            </form>

        </div>
    </div>

    <div class="bg-popup2">
        <div class="popup-content">
            <div class="btn-fermer">+</div>
            <form method="POST" action="" enctype="multipart/form-data">
                <br /><br /><br /><br /><br /><br />
                <input class="popup-input" type="submit" name="confirm" value="Confirmer"></li>
            </form>

        </div>
    </div>


    <div class="gallery-container">
        <div class="gallery">

            <?php

            //was able to show the images certain way, gotta see if i can show a certain amount per line
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idPhoto = $row['id_photo'];
                    $_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
                    echo '<a href=photo-zoom?idPhoto=' . $idPhoto . '>
                        <img id = "image" src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "class=gallery_img"/>
                        </a>';
                }
            } else {
                echo "0 results";
            }

            ?>
        </div>
    </div>
    </div>

    <script src="../js/popupscript.js"></script>
</body>

</html>