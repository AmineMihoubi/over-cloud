<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="../css/radiobtn.css" media="screen" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>



<body>

<div class="container">
    <div class="content">
        <div>
            <h1>Comment allez-vous utiliser Overcloud?</h1>
        </div>
    

        <form method="POST" action="nouveau-galerie-type.php">
            <div class="card">
                <input type="radio" name="TypeGalerie" value="1" checked>
                <label for="seule">
                    <h5>Pour soi-même</h5>
                    <h2><img src="../image/seul.png" width="250" height="200"></h2>
                </label>
            </div>

            <div class="card">
                <input type="radio" name="TypeGalerie" value="0">
                <label for="groupe">
                    <h5>Avec un groupe</h5>
                    <h2><img src="../image/group.png" width="250" height="200"></h2>

                </label>
            </div>
        </form>

        <button class="button" type="submit" name="Submit">Suivant</button>
            

        <?php
        if (isset($_POST['Submit'])) {

            $typeChoisi = $_POST['TypeGalerie'];



            if ($typeChoisi == '1') {
                $_SESSION["TypeGalerie"] = 1;
            } else if ($typeChoisi == '0') {
                $_SESSION["TypeGalerie"] = 0;
            }

            header("location:newGalleryName.php");
        }

        ?>
    </div>
</div>

</body>

</html>