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
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="../js/admin.js"></script>

</head>


<body>
    <!-- Bare de navigation !-->
    <div id=navigationBar></div>
    <script>
        $(function() {
            $("#navigationBar").load("navigationbar-admin.php");
        });
    </script>

    <div class='carte'>
        <div id=infoText>
            <i>La liste des galeries de l'utilisateur vous permez de supprimer une des galeries parmis toutes les galeries de l'application.</i>
        </div>

        <div class='listeUtilisateurs'>
            <table>
                <thead>
                    <tr>
                        <th>Galerie</th>
                        <th>Créateur</th>
                        <th>Intéragir</th>
                    </tr>
                </thead>
                <tbody>


                    <?php
                    $sql = "SELECT nom,id_galerie FROM galerie";
                    $result = mysqli_query($db, $sql);
                    while ($row =  mysqli_fetch_array($result)) {
                        $nomGalerie = $row['nom'];
                        $id_galerie = $row['id_galerie'];

                        $sql1 = "SELECT fk_id_utilisateur FROM utilisateur_galerie where fk_id_galerie = '$id_galerie' AND fk_id_type_utilisateur = 1";
                        $resultOwner = mysqli_query($db, $sql1);
                        $row1 =  mysqli_fetch_array($resultOwner);
                        $ownerID = $row1['fk_id_utilisateur'];

                        $sql2 = "SELECT prenom,nom FROM utilisateur WHERE id_utilisateur = $ownerID";
                        $exec_requete = mysqli_query($db, $sql2);
                        $reponse      = mysqli_fetch_assoc($exec_requete);
                        $prenom = $reponse['prenom'];
                        $nom = $reponse['nom'];
                        echo "
                    <form action='../php/actionUtilisateur.php?idGalerie=$id_galerie' method='post'> 
                    <tr>
                    <td>$nomGalerie</td>
                    <td>$nom, $prenom</td>
                    <td><input type='submit' name='voirPhotos' value='Voir les photos' />
                    <input type='submit' name='supprimerGalerie' value='Supprimer' /></td>
                    </tr>
                    </form>
                        ";
                    }
                    ?>

        </div>
    </div>

</body>