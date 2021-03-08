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

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/styles.css" media="screen" type="text/css">
    <script src="/Over-Cloud/js/parametres.js"></script>
     
</head>
<body>

<?php


if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        //echo $row["photo"]. "<br/>";
        echo '<img src="data:image/jpeg;base64,'.base64_encode($row["photo"]).' "height="100"/>';
    }
}
 else{
     echo "0 results";
 }

 mysqli_close($conn)

?>
</body>
</html>




