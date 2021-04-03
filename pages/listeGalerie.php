<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <h1>Galeries</h1>
    <link rel="stylesheet" href="../css/listeGalerie.css">

    <div class="card">
        <?php
        session_start();
        require '../php/ConnectDb.php';
        $db = ConnectDb::getInstance();

        $sql = "SELECT id_galerie,nom FROM galerie where id_galerie in (SELECT fk_id_galerie FROM `utilisateur_galerie` WHERE fk_id_utilisateur LIKE '{$_SESSION['idUtilisateur']}');";
        $result = mysqli_query($db, $sql);
        while ($row =  mysqli_fetch_array($result)) {
            $idGalerie = $row['id_galerie'];
            $nom = $row['nom'];

            echo "   
                             <a href='albums?id=$idGalerie'>
                              <img src='../image/galerieIcon.png' alt='Galerie' width ='120' height='100'>
                              <div class='container'> 
                              <h4><b>$nom</b></h4> 
                              <p></p>
                              </a>
                              </div>";
        }

        ?>
    </div>

    <a href="newGalleryType.php">
        <a href="nouveau-galerie-type.php">
            <div class="card">
                <img src="../image/plus.png" alt="nouvelle" width="120px" height="100px">
                <div class="container">
                    <h4><b>Nouvelle galerie</b></h4>
                    <p></p>
                </div>
        </a>
        </div>

        <form action="../php/deconnexion.php" method="get">
            <input id=deco type="submit" value="Déconnexion">
        </form>
</body>

</html>