<html>

<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <!-- bare de navigation-->
    <?php
    session_start();
    if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
        header('Location: ../index.php');
    }
    require '../php/ConnectDb.php';
    $db = ConnectDb::getInstance();
    $idGalerie = $_SESSION['idGalerie'];
    ?>
    <div id=navigationBar></div>
    <script>
        $(function() {
            $("#navigationBar").load("navigationbar.php");
        });
    </script>

    <div id=carteParametresGalerie>
        <div id=carteText>
            <h5>Paramètres de la galerie</h5>
            <div id=infoText>
                <i>Les galeries servent à contenir les albums photos afin de les partager avec tout le monde, ou seulement à ceux qui ont la permission.
                    Partagez des photos, ou participez aux discussions sur celle-çi avec les personnes de votre choix !
                </i>
            </div>
            <form id="paraGalerie-form" action="../php/modificationGalerie.php" method="POST">
                <h9>Changez le nom de la galerie : </h9>
                <input type="text" class="champSaisieGalerie" placeholder="<?php echo $_SESSION['nomGalerie'] ?>" name="nomGalerie">
                <br></br>
                <h9>Selectionnez le paramètre de confidentialité : </h9>
                <input type="radio" id="publique" name="confidentialite" value="publique">
                <label for="publique">Galerie publique</label><br>
                <input type="radio" id="prive" name="confidentialite" value="prive">
                <label for="prive">Galerie privée</label><br>
                <input type="submit" class="buttonConfirmer" name="submit" value="Confirmer!">
                <br>


            </form>
            <form method="POST" action="">
                <input type="submit" class="buttonSupprimer" name="delete" value="Supprimer galerie">
            </form>

        </div>

        <br></br>
        <br></br>

    </div>




    </div>

    <?php

    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM utilisateur_galerie where fk_id_galerie like $idGalerie"; //supprime liaison galerie-utilisateur
        if (mysqli_query($db, $sql)) {
            $sql2  = "DELETE FROM galerie where id_galerie like $idGalerie"; //supprime galerie
            if (mysqli_query($db, $sql2)) { //supprime liaison photo et album
                $sql3 = "SELECT fk_id_photo FROM photo_album WHERE fk_id_photo IN(SELECT id_photo FROM photo WHERE fk_id_galerie like $idGalerie)";

                if (mysqli_query($db, $sql3)) {
                    $sql4 = "DELETE FROM photo WHERE fk_id_galerie like $idGalerie"; //supprime photos de la galerie

                    if (mysqli_query($db, $sql4)) {

                        $sql5 = "DELETE FROM album where fk_id_galerie like $idGalerie"; //supprime albums de la galerie

                        if (mysqli_query($db, $sql5)) {
                            $page = $_SESSION['urlPrecedent'];
                            echo "<br/>YAY.";
                            echo "<script> window.location.replace('liste-galeries.php'); </script>"; //remplace la page courante a la page voulu, dans ce cas, la page precedente

                        }
                    }
                }
            }
        }
    } else {
        echo "<br/>NOOO.";
    }

    ?>
</body>