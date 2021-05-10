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
            <i>La liste des utilisateurs vous permez de supprimer un compte parmis tous les utilisateurs de l'application.</i>
        </div>

        <div class='listeUtilisateurs'>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Adresse mail</th>
                        <th>Supprimer l'utilisateur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT nom,prenom,courriel FROM utilisateur";
                    $result = mysqli_query($db, $sql);
                    while ($row =  mysqli_fetch_array($result)) {
                        $nom = $row['nom'];
                        $prenom = $row['prenom'];
                        $courriel = $row['courriel'];
                        echo "
                        <tr>
                        <td>$prenom $nom</td>
                        <td>$courriel</td>
                        <td><form action='../php/actionUtilisateur.php?courriel=$courriel' method='post'> 
                        <input type='submit' name='supprimer' value='Supprimer'/>
                        </form>'</td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>