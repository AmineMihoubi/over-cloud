<?php
require '../php/ConnectDb.php';
    session_start();
    $db = ConnectDb::getInstance(); 
    $imageID = $_SESSION['imageID']
    $sql = "select * from photo where id_photo = $idPhoto";
    $res = mysqli_query($db, $sql);
    list($id, $content, $type, $size,$content) = mysqli_fetch_array($res);
    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$file");
    ob_clean();
    flush();
    echo $content;
    mysqli_close($connection);
    exit;
?>