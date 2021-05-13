<?php
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/radiobtn.css" media="screen" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>



<body>

    <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">

        <div>
            <h1>Voulez-vous rendre votre gallerie Publique ou Privée?</h1>
            <br></br>
        </div>


        <form method="POST" action="nouvelle-galerie-status.php">

            <div>
                <div class="card">
                    <input type="radio" name="StatusGalerie" value="1" checked>
                    <label for="seule">
                        <h5>Privée</h5>
                        <h2><img src="../image/Private-Icon.png" width="250" height="200"></h2>
                    </label>
                </div>

                <div class="card">
                    <input type="radio" name="StatusGalerie" value="0">
                    <label for="groupe">
                        <h5>Publique</h5>
                        <h2><img src="../image/Public-Icon.png" width="250" height="200"></h2>
                    </label>
                </div>
            </div>

            <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
                <button class="button" type="submit" name="Submit">Créer la Gallerie!</button>
            </div>

        </form>

    </div>


    <?php
    if (isset($_POST['Submit'])) {

        $statusChoisi = $_POST['StatusGalerie'];

        $_SESSION['GallerieCreated'] = FALSE;

        if ($statusChoisi == '1') {
            $_SESSION["StatusGalerie"] = 1;
        } else if ($statusChoisi == '0') {
            $_SESSION["StatusGalerie"] = 0;
        }

        header("location:nouvelle-galerie-lien.php");
    }

    ?>
</body>

</html>