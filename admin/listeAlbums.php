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
            <i>La liste des galeries de l'utilisateur vous permez de supprimer un galerie parmis tous les galeries de l'application.</i>
        </div>

        <div class='listeUtilisateurs'>
            <ul>
                <?php
                $sql = "SELECT nom,id_album,fk_id_galerie FROM album";
                $result = mysqli_query($db, $sql);
                while ($row =  mysqli_fetch_array($result)) {
                    $nom = $row['nom'];
                    $id_album = $row['id_album'];
                    $id_galerie = $row['fk_id_galerie'];
                    echo "
                    <form action='../php/actionUtilisateur.php?idAlbum=$id_album' method='post'> 
                    <li>Nom : $nom | Fondateur : Amine aChanger
                    <input type='submit' name='supprimer' value='Supprimer' />
                    <input type='submit' name='voirPhotos' value='Voir les photos' />
                    <input type='submit' name='voirGalerie' value='Voir les utilisateurs' />
                    </li> 
                    </form>
                        ";
                }
                ?>
            </ul>
            <script>
                $('li').on('click', function() {
                    $('.bluebg').removeClass('bluebg');
                    $(this).addClass('bluebg');
                });
            </script>

        </div>
    </div>

</body>