<?php
session_start();
$idAlbum = $_POST['idAlbum'];
$nomAlbum = $_POST['nomAlbum'];

$db_username = 'root';
$db_password = '';
$db_name     = 'overcloud';
$db_host     = 'localhost';
$idGalerie = 1;

//Connecting to the database
$conn = mysqli_connect($db_host, $db_username, $db_password,$db_name);

if(!$conn){
    die("could not connect to database: " . mysqli_connect_error());
} else{
$sql_afficher_photos="select * from photo where fk_id_album in (select id_album from album where fk_id_galerie in (select fk_id_galerie from utilisateur_galerie where fk_id_utilisateur like '{$_SESSION['idUtilisateur']}'))";
$res=mysqli_query($conn,$sql_afficher_photos);

}

?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/styles.css" media="screen" type="text/css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
     
</head>
<body>
<div id = navigationBar></div>
        <script>
        $(function(){
        $("#navigationBar").load("navigationbar.php");
        });
        </script>


<div class ="container">
<div class = "gallery">

<?php

//was able to show the images certain way, gotta see if i can show a certain amount per line
if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        echo '<img id = "image" src="data:image/jpeg;base64,'.base64_encode($row["photo"]).' "class=gallery_img"/>';
    }
}
 else{
     echo "0 results";
 }

 //mysqli_close($conn)

?>
</div>
</div>

<?php 

  
  if (isset($_POST['upload'])) { 
    $conn = mysqli_connect($db_host, $db_username, $db_password,$db_name);
    
    
    $image= addslashes(file_get_contents($_FILES['image']['tmp_name']) );       
        
        $sql = "INSERT INTO photo(photo,date,fk_id_album) VALUES ('$image','2021-03-14', 1)"; 
  
        // Execute query 
        if(mysqli_query($conn, $sql)){
            echo "<br/>YAY.";
        } else{
            echo "<br/>NOOO.";
        }
        
  } 
  
?> 
<div id="content"> 
  
<form id = "photo-form" method="POST" action="photos.php" enctype="multipart/form-data">
 <input type="file" name="image">
 <input type="submit" name="upload" value="Upload">
</form> 
</body>
</html>




