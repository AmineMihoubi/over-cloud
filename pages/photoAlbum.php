<?php
session_start();
require '../php/ConnectDb.php';
if ($_GET['id'] != null) {
    $_SESSION['idAlbum'] = $_GET['id'];
    $_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
}

$i = 1; //compteur pour connaitre l'index des images dans une table
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
                $("#navigationBar").load("../php/navigationbar.php");
            });
        </script>

        <?php
        if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
            header('Location: ../index.php');
        }

        if ($_GET['id'] != null) {
            $_SESSION['idAlbum'] = $_GET['id'];
        }
        ?>
        <!--Barre de navigation-->
        <div id=navigationBar></div>
        <script>
            $(function() {
                $("#navigationBar").load("../php/navigationbar.php");
            });
        </script>

        <!--Barre d'actions-->


        <div class="actionsbar-container">
            <ul>
                <li>
                    <a onclick="document.getElementById('ajouter-photos').style.display='block'">
                        <div class="creation" style="margin-top:0;">
                            <h1>+</h1>
                        </div>
                    </a>
                </li>

                <?php



                if ($_SESSION['id_type_utilisateur'] == 0) {
                    echo "
                <li>
                    <a onclick=document.getElementById('supprimer-album').style.display='block'>

                        <div class=supprimer style=margin-top:0;>

                            <img src=../image/delete-icon.png>

                        </div>

                    </a>
                </li>";
                }
                ?>
            </ul>
        </div>

        <div>
            <?php
            $id = $_SESSION['idAlbum'];
            $db = ConnectDb::getInstance();

            $galerieSQL = "SELECT fk_id_galerie, nom FROM album where id_album = '$id'";
            $resultGalerie = mysqli_query($db, $galerieSQL);
            $row0 = mysqli_fetch_array($resultGalerie);
            $idGalerie = $row0['fk_id_galerie'];

            $nomAlbum = $row0['nom'];
            $typeSql = "SELECT * FROM galerie where id_galerie = '$idGalerie'";
            $resultType = mysqli_query($db, $typeSql);
            $row1 = mysqli_fetch_array($resultType);
            $typeGalerie = $row1['type'];
            $statusGalerie = $row1['status'];
            $nomGalerie = $row1['nom'];

            if ($statusGalerie != 0) { //if the galerie is not public
                if ($typeGalerie == 1) { //if the galerie is individual. check if we're the owner
                    $ownerSQL = "SELECT fk_id_utilisateur FROM utilisateur_galerie where fk_id_galerie = '$idGalerie'";
                    $resultOwner = mysqli_query($db, $ownerSQL);
                    $row2 = mysqli_fetch_array($resultOwner);
                    $ownerID = $row2['fk_id_utilisateur'];
                    if ($_SESSION['idUtilisateur'] != $ownerID) {
                        header('Location: 404.php');
                    }
                } else { //if the galery is group, check if we're one of the users allowed.
                    $sqlInviteId = "SELECT fk_id_utilisateur FROM utilisateur_galerie where fk_id_galerie = '$idGalerie'";
                    $resIdInvite = mysqli_query($db, $sqlInviteId);
                    $hasAccess = false;
                    while ($row = mysqli_fetch_assoc($resIdInvite)) {
                        $idUserInvited = $row['fk_id_utilisateur'];
                        if ($idUserInvited == $_SESSION['idUtilisateur']) {
                            $hasAccess = true;
                        }
                    }
                    if (!$hasAccess) {
                        header('Location: 404.php');
                    }
                }
            }
            ?>


            <!-- affichage des photos -->
            <div class="container">
                <div class="gallery">
                    <?php
                    $idAlbum = $_SESSION['idAlbum'];
                    $sql_afficher_photos = "SELECT * FROM photo p join photo_album pa on p.id_photo = pa.fk_id_photo where pa.fk_id_album = $idAlbum";
                    $res = mysqli_query($db, $sql_afficher_photos);
                    $res2 = mysqli_query($db, $sql_afficher_photos);
                    $idPhoto = false;
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $idPhoto = $row['id_photo'];
                            $_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
                            echo '<div>';
                            echo '<img id = "image" onclick="openModal();currentSlide(' . $i . ')"  src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "class=gallery img"/>';
                            echo '</div>';

                            if ($i == mysqli_num_rows($res)) {

                                $i = 1;
                            } else {

                                $i++;
                            }
                        }
                        if ($idAlbum) {
                            $_SESSION['idPhoto'] = $idPhoto;
                            $_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
                        } else {
                            echo "Ajouter des Photos";
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
                            <input type="file" name="image[]" multiple>
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
                            <input type="submit" name="supprimer-album" value="Confirmer">
                        </div>
                    </div>
                </form>

            </div>

            <div id="myModal" class="modal">
                <div class="actionsbar-container" style="position:absolute; right: 35px;
                    top: 15px;">
                    <ul>

                    <?php
                    if ($_SESSION['id_type_utilisateur'] == 0) {
                    echo"


                        <li>
                            <a onclick=document.getElementById('supprimer-photos').style.display='block'>
                                <img src=../image/delete-icon.png width=26px height=26px style=margin-top:17px; margin-right:30px; cursor:pointer;>
                            </a>
                        </li>";}

                        ?>

                        <li>
                            <a class="fermer" onclick="closeModal()">&times;</a>
                        </li>
                    </ul>
                </div>





                <div class="modal-content">


                    <?php

                    if (mysqli_num_rows($res2) > 0) {
                        while ($row = mysqli_fetch_assoc($res2)) {
                            echo '<div class="mySlides">';
                            $idPhoto = $row['id_photo'];
                            echo '<img id = "image" src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "style=width:100%">';
                            /**Section commentaire */
                            echo '<div class="section-commentaires">
             ';

                            $sql3 = "SELECT fk_id_auteur,message,id_commentaire FROM commentaire where fk_id_photo = $idPhoto ";
                            $result3 = mysqli_query($db, $sql3);
                            while ($row3 =  mysqli_fetch_array($result3)) {
                                $idAuteur = $row3['fk_id_auteur'];
                                $idCommentaire = $row3['id_commentaire'];
                                $commentaire = $row3['message'];
                                $requete = "SELECT nom,prenom FROM utilisateur WHERE id_utilisateur = $idAuteur";
                                $exec_requete = mysqli_query($db, $requete);
                                $reponse      = mysqli_fetch_assoc($exec_requete);
                                $nom = $reponse['nom'];
                                $prenom = $reponse['prenom'];
                                echo "
                    <div class=commentaire>
                    <i class='nom'>$prenom, $nom</i>";
                                if ($idAuteur == $_SESSION['idUtilisateur']) {
                                    echo "
                    <form action='../php/gererCommentaire.php' method='post'> 
                    <input type='submit' name='submit-supprimer' class='button-supprimer' value=Supprimer></input>
                    <input type='hidden' name='idPhoto' value='$idPhoto'/>
                    <input type='hidden' name='idAlbum' value='$idAlbum'/>
                    <input type='hidden' name='idCommentaire' value='$idCommentaire'/>
                    </from>
                      ";
                                }
                                echo "
                     <br/>
                     <h7 class='comm'>$commentaire</h7>
                     </div>
                     ";
                            }

                            echo "
        </div>
        <div class='message'>
        <form method='post' action='../php/gererCommentaire.php'>
        <textarea id='textAreaPost' name='commentaire' placeholder='Écrire un commentaire...' maxlength='60'></textarea>
        <input type='hidden' name='idPhoto' value='$idPhoto'></input>
        <input name='submit-envoyer' type='submit' class='button-envoyer' placeholder='Envoyer votre commentaire'>
        </form>
        </div>
        </div>";
                        }
                    }
                    ?>





                </div>

                <div id="supprimer-photos" class="popup">
                    <span onclick="document.getElementById('supprimer-photos').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <form class="popup-content" method="POST" action="" enctype="multipart/form-data">
                        <div class="popup-container">
                            <h1>SUPPRIMER LA PHOTO?</h1>
                            <div class="popup-buttons">
                                <input type="submit" name="supprimer-photos" value="Confirmer">
                            </div>
                        </div>
                    </form>

                </div>
                <!-- Next/previous controls -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>


            <script>
                function openModal() {
                    document.getElementById("myModal").style.display = "block";
                }

                function closeModal() {
                    document.getElementById("myModal").style.display = "none";
                }

                var slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }

                    slides[slideIndex - 1].style.display = "block";

                }
            </script>



            <?php
            if (isset($_POST['upload'])) {

                for ($count = 0; $count < count($_FILES['image']['tmp_name']); $count++) {


                    $image = addslashes(file_get_contents($_FILES['image']['tmp_name'][$count]));

                    $sql = "INSERT INTO photo(photo,date,fk_id_galerie) VALUES ('$image',curdate(), '{$_SESSION['idGalerie']}')";

                    $sql2 = "INSERT INTO photo_album(fk_id_photo,fk_id_album) VALUES (LAST_INSERT_ID(),'$idAlbum')";

                    $sql3 = "INSERT INTO historique(fk_id_utilisateur, action, date) VALUES ('{$_SESSION['idUtilisateur']}', 'à ajouté une photo dans $nomAlbum($nomGalerie)', curdate())";

                    // Execute query
                    if (mysqli_query($db, $sql)) {
                        if (mysqli_query($db, $sql2)) {
                            $page = $_SESSION['urlPrecedent'];
                            echo "<br/>YAY.";
                            echo "<script> window.location.replace('albums.php?id=$idGalerie'); </script>";
                        } else {
                            echo "<br/>NOOO2.";
                        }
                    } else {
                        echo "<br/>NOOO.";
                    }
                    header("Refresh: 0.001; photoAlbum.php?id=$idAlbum");
                }
            }

            if (isset($_POST['supprimer-album'])) {
                $sql = "DELETE FROM photo_album where fk_id_album like $idAlbum";
                if (mysqli_query($db, $sql)) {
                    $sql2 = "DELETE FROM album where id_album like $idAlbum";
                    // Execute query
                    if (mysqli_query($db, $sql2)) {
                        echo "<br/>YAY.";

                        echo "<script> window.location.replace('albums.php?id=$idGalerie'); </script>";
                    } else {
                        echo "<br/>NOOO.";
                    }
                }
            }

            if (isset($_POST['supprimer-photos'])) {
                $sql = "DELETE FROM photo_album where fk_id_photo like $idPhoto";
                if (mysqli_query($db, $sql)) {
                    $sql2 = "DELETE FROM photo where id_photo like $idPhoto";
                    // Execute query
                    if (mysqli_query($db, $sql2)) {

                        $sql3 = "DELETE FROM commentaire where fk_id_photo like $idPhoto";

                        if (mysqli_query($db, $sql3)) {

                            $page = $_SESSION['urlPrecedent'];
                            echo "<br/>YAY.";

                            echo "<script> window.location.replace('$page'); </script>";
                        } else {
                            echo "<br/>NOOO.";
                        }
                    }
                }
            }
            ?>

        </div>
        <script src="../js/popupscript.js"></script>
    </div>
</body>

</html>