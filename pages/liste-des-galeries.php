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

    <div id=listeGalerie-titre>
        <h1>Galeries</h1>
    </div>


    <div id=listeGalerie-container>
        <?php
        $sql = "SELECT id_galerie,nom FROM galerie where id_galerie in (SELECT fk_id_galerie FROM `utilisateur_galerie` WHERE fk_id_utilisateur LIKE '{$_SESSION['idUtilisateur']}' AND fk_id_type_utilisateur = 1);";
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


    <div id=listeGalerie-nouvelle>
        <a href="nouveau-galerie-type.php">
            <div class="listeGalerie-card'">
                <img src="../image/plus.png" alt="nouvelle" width="120px" height="100px">
                <h4><b>Nouvelle galerie</b></h4>
        </a>
    </div>
    </div>


    <div id=listeGaleriePartagee-titre>
        <h1>Galeries Partagées Avec Moi</h1>
    </div>

    <?php
    //need to modify the code to make it so that we can see the galleries that were shared with me.
    ?>

    <div id=listeGalerie-container>
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

    <form action="../php/deconnexion.php" method="get">
        <input id=deco type="submit" value="Déconnexion">
    </form>
</body>

</html>