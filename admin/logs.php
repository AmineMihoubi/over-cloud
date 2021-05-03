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
        <div style="margin-left: 200px;">
            <div>
                <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $utilisateur = $row['courriel']; 
                            $action = $row['action'];
                            $date = $row['date'];
                            echo "$utilisateur   $action  -  $date <br>";
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>