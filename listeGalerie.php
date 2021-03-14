<?php
session_start();
$db_username = 'root';
$db_password = '';
$db_name     = 'overcloud';
$db_host     = 'localhost';

//Connecting to the database
$conn = mysqli_connect($db_host, $db_username, $db_password,$db_name);

if(!$conn){
    die("could not connect to database: " . mysqli_connect_error());
} else{
$sql_afficher_galeries="SELECT * FROM galerie 
    where id_galerie = (SELECT fk_id_galerie FROM `utilisateur_galerie` WHERE fk_id_utilisateur LIKE '{$_SESSION['idUtilisateur']}');";
$res=mysqli_query($conn,$sql_afficher_galeries);

}
?>

<!doctype html>
        <html>
            <body>
                <h1 align="center">Galeries</h1>
                <link rel="stylesheet" href="./css/listeGalerie.css">
                <div class="cards">
        <?php
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
        ?>
                <div class="card">
                    <img src="./image/galerieIcon.png" alt="Galerie" width ="120" height="100">
                    <div class="container">
                        <h4><b><?php echo $row['nom']; ?></b></h4>
                        <p></p>
                    </div>
                </div>
                <?php
                    }
                    }
                    else
                        { echo "No data found"; } ?>
                <a href="newGalleryType.php">
                    <div class="card">
                        <img src="./image/plus.png" alt="nouvelle" width ="120px" height="100px">
                        <div class="container">
                            <h4><b>Nouvelle galerie</b></h4>
                            <p></p>
                        </div>
                </a>
                </div>
            </body>
        </html> 