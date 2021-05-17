<?php
require '../php/ConnectDb.php';
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
    header('Location: ../index.php');
}
$db = ConnectDb::getInstance();



$sql_afficher_photos = "select * from photo where fk_id_galerie in (select id_galerie from galerie where fk_id_galerie in (select fk_id_galerie from utilisateur_galerie where fk_id_utilisateur like '{$_SESSION['idUtilisateur']}'))";
$res = mysqli_query($db, $sql_afficher_photos);
$res2 = mysqli_query($db, $sql_afficher_photos);
$_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];

$i = 1; //compteur pour connaitre l'index des images dans une table

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
            $("#navigationBar").load("../php/navigationbar.php");
        });
    </script>


    <div class="actionsbar-container">

        <a onclick="document.getElementById('ajouter-photos').style.display='block'">
            <div class=creation style="margin-top:0;">
                <h1>+</h1>
            </div>
        </a>


    </div>


    <div class="container" style="margin-top: 50px;">
        <div class="gallery">
            <?php
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<div>';
                    echo '<img id = "image" onclick="openModal();currentSlide(' . $i . ')"  src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "class=gallery img"/>';
                    echo '</div>';

                    if ($i == mysqli_num_rows($res)) {

                        $i = 1;
                    } else {

                        $i++;
                    }
                }
            } else {
                echo "0 results";
            }

            ?>
        </div>
    </div>


    <div id="ajouter-photos" class="popup">
        <span onclick="document.getElementById('ajouter-photos').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="popup-content" method="POST" action="" enctype="multipart/form-data">
            <div class="popup-container">
                <h1>AJOUTER PHOTOS</h1>
                <div class="popup-buttons">
                    <input class="popup-input" type="file" name="image[]" multiple>
                    <input class="popup-input" type="submit" name="upload" value="Upload"></li>
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
                                <img src=../image/delete-icon.png width='26px' height='26px' style='margin-top:17px; margin-right:30px; cursor:pointer';>
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
                                <input  type='hidden' name='idPhoto' value='$idPhoto'/>
                                <input  type='hidden' name='idCommentaire' value='$idCommentaire'/>
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

            <?php

            if (isset($_POST['confirm'])) {
                $sql = "DELETE FROM photo where id_photo like $idPhoto";
                // Execute query
                if (mysqli_query($db, $sql)) {
                    $page = $_SESSION['urlPrecedent'];


                    //pour l'historique
                    $idalbum = $rep['fk_id_album'];
                    $sqlAlbum = "SELECT nom, fk_id_galerie FROM album WHERE id_album = $idalbum";
                    $resAlbum = mysqli_query($db, $sqlAlbum);
                    $repAlbum = mysqli_fetch_array($resAlbum);
                    $nomAlbum = $repAlbum['nom'];
                    $idGalerie = $repAlbum['fk_id_galerie'];
                    $sqlGalerie = "SELECT nom FROM galerie WHERE id_galerie = $idGalerie";
                    $resGalerie = mysqli_query($db, $sqlGalerie);
                    $repGalerie = mysqli_fetch_array($resGalerie);
                    $nomGalerie = $repGalerie['nom'];

                    $sqlHistorique = "INSERT INTO historique(fk_id_utilisateur, action, date) VALUES ('{$_SESSION['idUtilisateur']}', 'à supprimé une photo dans $nomAlbum($nomGalerie)', curdate())";
                    mysqli_query($db, $sqlHistorique);
                    echo "<br/>YAY.";
                    echo "<script> document.getElementsByClassName('.bg-popup').style.display = 'none'; </script>";
                    echo "<script> window.location.replace('$page'); </script>"; //replace la page courante a la page voulu, dans ce cas, la page precedente
                } else {
                    echo "<br/>NOOO.";
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


            if (mysqli_query($db, $sql)) {

                echo "<br/>YAYAY.";
            } else {
                echo "<br/>Images invalides.";
            }
        }
        $page = $_SESSION['urlPrecedent'];
        echo "<script> window.location.replace('$page'); </script>";
    }



    ?>
    <script src="../js/popupscript.js"></script>
</body>

</html>