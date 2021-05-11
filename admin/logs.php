<?php
session_start();
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
$sql = "SELECT u.courriel, h.action, h.date FROM historique h join utilisateur u on u.id_utilisateur = h.fk_id_utilisateur ORDER BY h.date";
$result = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="../js/admin.js"></script>
</head>

<body>
    <div>
        <!-- Bare de navigation !-->
        <div id=navigationBar></div>
        <script>
            $(function() {
                $("#navigationBar").load("navigationbar-admin.php");
            });
        </script>

        <div class='carte'>
            <div id=infoText>
                <i>La liste des logs contient tout les changements faites par les admins</i>
            </div>

            <div class='listeUtilisateurs'>
                <table>
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $sql = "SELECT id_administrateur,description,date FROM administrateur_changement";
                          $result = mysqli_query($db, $sql);
                          while ($row =  mysqli_fetch_array($result)) {
                          $idAdmin = $row['id_administrateur'];    
                          $description = $row['description'];
                          $date = $row['date'];  
                          $requete = "SELECT utilisateur FROM administrateur WHERE id_admin = $idAdmin";
                          $exec_requete = mysqli_query($db,$requete);
                          $reponse      = mysqli_fetch_array($exec_requete);
                          $utilisateur = $reponse['utilisateur'];
                          echo 
                          "
                          <tr>
                          <td>$utilisateur</td>
                          <td>$description</td>
                          <td>$date</td>
                          </tr>
                          ";     
                          }  
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</body>

</html>