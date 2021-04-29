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
            <i>La liste des galeries de l'utilisateur vous permez de supprimer un album parmis tous les albums de l'application.</i>
        </div>

        <div class='listeUtilisateurs'>
        <table>
                <thead>
                    <tr>
                        <th>Galerie</th>
                        <th>Album</th>
                        <th>Fondateur</th>
                        <th>Intéragir</th>
                    </tr>
                </thead>
                <tbody>


                <?php
                $sql = "SELECT nom,id_album,fk_id_galerie FROM album";
                $result = mysqli_query($db, $sql);
                while ($row =  mysqli_fetch_array($result)) {
                    $nomAlbum = $row['nom'];
                    $id_album = $row['id_album'];
                    $id_galerie = $row['fk_id_galerie'];
                    $sql2 = "SELECT nom,id_fondateur FROM galerie WHERE id_galerie = $id_galerie";
                    $exec_requete = mysqli_query($db,$sql2);
                    $reponse      = mysqli_fetch_assoc($exec_requete);
                    $nomGalerie = $reponse['nom'];
                    $idFondateur = $reponse['id_fondateur'];
                    $sql3 = "SELECT prenom,nom FROM utilisateur WHERE id_utilisateur = $idFondateur";
                    $exec_requete = mysqli_query($db,$sql3);
                    $reponse      = mysqli_fetch_assoc($exec_requete);
                    $prenom = $reponse['prenom'];
                    $nom = $reponse['nom'];
                    echo "
                    <form action='../php/actionUtilisateur.php?idAlbum=$id_album' method='post'> 
                    <tr>
                    <td>$nomGalerie</td>
                    <td>$nomAlbum</td>
                    <td>$nom, $prenom</td>
                    <td><input type='submit' name='voirPhotos' value='Voir les photos' />
                    <input type='submit' name='supprimer' value='Supprimer' /></td>
                    </tr>
                    </form>
                        ";
                }
                ?>
            <script>
                $('li').on('click', function() {
                    $('.bluebg').removeClass('bluebg');
                    $(this).addClass('bluebg');
                });
            </script>

        </div>
    </div>

</body>