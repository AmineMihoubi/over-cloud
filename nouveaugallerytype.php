<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="css/radiobtn.css" media="screen" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<!-- first page of the "Adding a new Gallery Serie -->

<body>
    
    <div>
        <h1>Comment allez-vous utiliser Overcloud?</h1>
    </div>


    <div class="card">
        <input type="radio" name="typeGallerie" id="seule" checked>
        <label for="seule">
            <h5>Pour soi-même</h5>
            <h2><img src="image/seul.png" width="250" height="200"></h2>
        </label>
    </div>

    <div class="card">
        <input type="radio" name="typeGallerie" id="groupe">
        <label for="groupe">
            <h5>Avec un groupe</h5>
            <h2><img src="image/group.png" width="250" height="200"></h2>

        </label>
    </div>


    
    <div class="submit">
      <button type="submit">Envoyer</button>
    </div>
<?php

if(isset($_POST['seule'])){
    $_SESSION["typegal"] = 1;
    
} else if(isset($_POST['groupe'])){
    $_SESSION["typegal"] = 2;
    
}


?>

</body>

</html>