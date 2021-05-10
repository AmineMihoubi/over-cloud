<?php
session_start();
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>

    <div class="container" style="align-content:center; margin-top:100px;">

        <!--drop down menu-->
        <div class="mini-menu">
            <button onclick="afficherPages()" class="btn-profile">
           
        
        </button>
            <div id="miniMenu" class="minimenu-pages">
                <a  style="background-color: red;">
                    <form action="../php/deconnexion.php" method="get">
                        <input style="background: none;" type="submit" value="Déconnexion">
                    </form>
                </a>
            </div>
        </div>


        <script>
            function afficherPages() {
                document.getElementById("miniMenu").classList.toggle("show");
            }

            // Close the dropdown menu if the user clicks outside of it
            window.onclick = function(event) {
                if (!event.target.matches('.btn-profile')) {
                    var dropdowns = document.getElementsByClassName("minimenu-pages");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>

        <div style="text-align:center;">

            <?php
            $sqlNom = "SELECT prenom FROM utilisateur where id_utilisateur like '{$_SESSION['idUtilisateur']}'";
            $query = mysqli_query($db, $sqlNom);
            $result = mysqli_fetch_assoc($query);
            $nomUtilisateur = $result['prenom'];

            echo "<h1>Bienvenue  $nomUtilisateur ! </h1>";
            ?>


        </div>



        <br></br><br></br>
        <div>
            <h2>Mes galeries</h2>
        </div>

        <div style="margin:50px; justify-content:center;">
            <div class="display">

                <?php
                $sql = "SELECT id_galerie,nom FROM galerie where id_galerie in (SELECT fk_id_galerie FROM `utilisateur_galerie` WHERE fk_id_utilisateur LIKE '{$_SESSION['idUtilisateur']}' AND fk_id_type_utilisateur = 1);";
                $result = mysqli_query($db, $sql);
                while ($row =  mysqli_fetch_array($result)) {
                    $idGalerie = $row['id_galerie'];
                    $nom = $row['nom'];

                    echo " <a href='albums?id=$idGalerie'>
             <div class='card'>   
             
             <img src='../image/photo-frame.png' alt='Galerie' width ='120' height='100'>
             <h3>$nom</h3> 
            
             </div> </a>";
                }

                $_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
                ?>

                <a href="nouvelle-galerie-type.php">
                    <div class=creation>

                        <h1>+</h1>
                    </div>
                </a>
            </div>
        </div>



        <br></br>

        <div>
            <h2>Galeries partagées avec moi</h2>
        </div>

        <div style="margin:50px; justify-content:center;">
            <div class="display">
                <?php
                $sql = "SELECT id_galerie,nom FROM galerie where id_galerie in (SELECT fk_id_galerie FROM `utilisateur_galerie` WHERE fk_id_utilisateur LIKE '{$_SESSION['idUtilisateur']}' AND fk_id_type_utilisateur = 2);";
                $result = mysqli_query($db, $sql);
                while ($row =  mysqli_fetch_array($result)) {
                    $idGalerie = $row['id_galerie'];
                    $nom = $row['nom'];

                    echo " 
             <div class='listeGalerie-card'>   
             <a href='albums?id=$idGalerie'>
             <img src='../image/galerieIcon.png' alt='Galerie' width ='120' height='100'>
             <h4><b>$nom</b></h4> 
             </a>
             </div>";
                }

                $_SESSION['urlPrecedent'] = $_SERVER['REQUEST_URI'];
                ?>
            </div>
        </div>

    </div>
</body>

</html>