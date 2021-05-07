<?php
require '../php/ConnectDb.php';
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
    header('Location: ../index.php');
}
$db = ConnectDb::getInstance();

$sql_afficher_photos = "select * from photo where fk_id_album in (select id_album from album where fk_id_galerie in (select fk_id_galerie from utilisateur_galerie where fk_id_utilisateur like '{$_SESSION['idUtilisateur']}'))";
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
            $("#navigationBar").load("navigationbar.php");
        });
    </script>


    <div class="actionsbar-container">

        <ul>
            <li> </li>
            <li ><a id="btn-ajouter" class="button">Ajouter +</a></li>
            <li ><a id="btn-supprimer" style="display:none" class="button">Suprimer +</a></li>
        </ul>

    </div>

    <script>
        function supprimerPhotos() {
  // Get the checkbox
  var checkBox = document.getElementById("check1");
  // Get the output text
  var text = document.getElementById("btn-supprimer");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}
    </script>

    <div class="bg-popup">
        <div class="popup-content">
            <div class="btn-fermer">+</div>
            <form method="POST" action="photos.php" enctype="multipart/form-data">
                <br /><br /><br /><br /><br /><br />
                <input class="popup-input" type="file" name="image[]" multiple>
                <input class="popup-input" type="submit" name="upload" value="Upload"></li>
                </ul>
            </form>

        </div>
    </div>


    <div class="gallery-container">
        <div class="gallery">

            <?php

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<div>';
                    echo '<img id = "image" onclick="openModal();currentSlide('.$i.')"  src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "class=gallery img"/>';
                    echo '<input type="checkbox" class="photocheckbox" onclick="supprimerPhotos()" id="check'.$i.'" />';
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



    <div id="myModal" class="modal">
        <span class="close cursor" onclick="closeModal()">&times;</span>
        <div class="modal-content">
       

            <?php

            if (mysqli_num_rows($res2) > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    echo '<div class="mySlides">';
                    echo'<img id = "image" src="data:../image/jpeg;base64,' . base64_encode($row["photo"]) . ' "style=width:100%"/>';
                    echo '</div>';
                }
            } 
            ?>

            
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
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }

  slides[slideIndex-1].style.display = "block";

}
</script>


        <?php


        if (isset($_POST['upload'])) {

            for ($count = 0; $count < count($_FILES['image']['tmp_name']); $count++) {


                $image = addslashes(file_get_contents($_FILES['image']['tmp_name'][$count]));

                $sql = "INSERT INTO photo(photo,date,fk_id_album) VALUES ('$image','2021-03-14', 1)";

                // Execute query
                if (mysqli_query($db, $sql)) {

                    echo "<br/>YAY.";
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