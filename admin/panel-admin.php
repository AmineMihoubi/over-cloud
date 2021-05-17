<!doctype html>
<?php
session_start();
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
$courriel = false;
$idGalerie = false;
$idPhoto = false;
$idAdmin = false;
if (isset($_GET['courriel'])) {
    $courriel = $_GET['courriel'];
}
if (isset($_GET['idGalerie'])) {
    $idGalerie = $_GET['idGalerie'];
}
if (isset($_GET['idPhoto'])) {
    $idPhoto = $_GET['idPhoto'];
}
$idAdmin = $_SESSION['idAdmin'];

echo '<script>alert("Admin: "' . $idAdmin . '"")</script>';
date_default_timezone_set('America/New_york');
$date = date("Y-m-d H:i:s");
?>
<html>

<head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>


<body>

    <!-- Bare de navigation !-->
    <div id=navigationBar></div>
    <script>
        $(function() {
            $("#navigationBar").load("navigationbar-admin.php");
        });
    </script>
    <?php
    ?>
    <div>
    </div>

</body>