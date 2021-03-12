<?php

$db_username = 'root';
$db_password = '';
$db_name     = 'overcloud';
$db_host     = 'localhost';
$idGalerie = 1;

//Connecting to the database
$conn = mysqli_connect($db_host, $db_username, $db_password,$db_name);


if(!$conn){
    die("could not connect to database: " . mysqli_connect_error());
}
$sql="select * from photo";
$res=mysqli_query($conn,$sql);

?>

<?php 
error_reporting(0); 
?> 


<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/styles.css" media="screen" type="text/css">
    <script src="/Over-Cloud/js/parametres.js"></script>
     
</head>
<body>

<div class ="container">
<div class = "gallery">

<?php

//was able to show the images certain way, gotta see if i can show a certain amount per line
if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        //echo $row["photo"]. "<br/>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row["photo"]).' "class=gallery_img"/>';
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

  
  // If upload button is clicked ... 
  if (isset($_POST['upload'])) { 
    $conn = mysqli_connect($db_host, $db_username, $db_password,$db_name);
    
    
    $image= base64_encode(file_get_contents($_FILES['image']['tmp_name']) );       
    echo $image;
        // MARCHE PAS????????????????
        $sql = "INSERT INTO photo(photo,date,fk_id_album) VALUES ('$image','2021-03-14', 1)"; 
  
        // Execute query 
        if(mysqli_query($conn, $sql)){
            echo "<br/>Image uploaded successfully.";
        } else{
            echo "<br/>NOOO.";
        }
        
  } 
  
?> 
<div id="content"> 
  
<form method="POST" action="photos.php" enctype="multipart/form-data">
 <input type="file" name="image">
 <input type="submit" name="upload" value="Upload">
</form> 
</body>
</html>




