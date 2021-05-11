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



if ($typeAlbum == 1) {
    $ownerSQL = "SELECT fk_id_utilisateur FROM utilisateur_galerie where fk_id_galerie = '$id'";
    $resultOwner = mysqli_query($db, $ownerSQL);
    $row2 =  mysqli_fetch_array($resultOwner);
    $ownerID = $row2['fk_id_utilisateur'];
    if ($_SESSION['idUtilisateur'] != $ownerID) {
        header('Location: 404.php');
    }
}
$_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
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
$sql_afficher_photos = "SELECT * FROM photo p join photo_album pa on p.id_photo = pa.fk_id_photo where pa.fk_id_album = $idAlbum";
$res = mysqli_query($db, $sql_afficher_photos);
?>

<body>

    <!--Barre de navigation-->
    <div id=navigationBar></div>
    <script>
        $(function() {
            $("#navigationBar").load("navigationbar.php");
        });
    </script>

    <!--Barre d'actions-->
    <div style="margin-left: 200px;">
        <div class="actionsbar-container">
            <ul>
                <li><a id="btn-ajouter" class="button" onclick="document.getElementById('ajouter-photos').style.display='block'">Ajouter +</a></li>
                <li> <a id="btn-supprimer" class="button" onclick="document.getElementById('supprimer-album').style.display='block'"> Supprimer album</a> </li>
            </ul>
        </div>
    </div>

<!-- affichage des photos -->
    <div class="gallery-container">
        <div class="gallery">
            <?php
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

<!--petit fenetre pour ajouter des photos-->
    <div id="ajouter-photos" class="popup">
        <span onclick="document.getElementById('ajouter-photos').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="popup-content" method="POST" action="" enctype="multipart/form-data">
            <div class="popup-container">
                <h1>AJOUTER PHOTOS</h1>
                <div class="popup-buttons">
                    <input type="file" name="image">
                    <input type="submit" name="upload" value="Upload">
                </div>
            </div>
        </form>
    </div>


<!--petit fenetre pour l'album-->
<div id="supprimer-album" class="popup">
        <span onclick="document.getElementById('supprimer-album').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="popup-content" method="POST" action="" enctype="multipart/form-data">
            <div class="popup-container">
                <h1>SUPPRIMER ALBUM?</h1>
                <div class="popup-buttons">
                <input type="submit" name="confirm" value="Confirmer">
                </div>
            </div>
        </form>

    </div>



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
            } else {
                echo "<br/>NOOO2.";
            }
        } else {
            echo "<br/>NOOO.";
        }
        header("Refresh: 0.001; photoAlbum.php?id=$idAlbum");
    }

    if (isset($_POST['confirm'])) {
        $sql = "DELETE FROM photo_album where fk_id_album like $idAlbum";
        if (mysqli_query($db, $sql)) {
            $sql2 = "DELETE FROM album where id_album like $idAlbum";
            // Execute query
            if (mysqli_query($db, $sql2)) {
                $page = $_SESSION['urlPrecedent'];
                echo "<br/>YAY.";
                
            header("Refresh: 0.001; albums.php?id=$idGalerie");

                        } else {
                echo "<br/>NOOO.";
            }
        }
    }
    ?>


    <script src="../js/popupscript.js"></script>
    


</body>

</html>