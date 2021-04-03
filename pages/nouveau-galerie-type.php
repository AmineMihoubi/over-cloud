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

  <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">

        <div>
            <h1>Comment allez-vous utiliser Overcloud?</h1>
            <br></br>
        </div>


            <form method="POST" action="nouveau-galerie-type.php">

                <div>
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
              </div>

              <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
                <button class="button" type="submit" name="Submit">Suivant</button>
              </div>

            </form>

</div>




                <?php
                if (isset($_POST['Submit'])) {

                    $typeChoisi = $_POST['TypeGalerie'];

                    $_SESSION['GallerieCreated'] = FALSE;

                    if ($typeChoisi == '1') {
                        $_SESSION["TypeGalerie"] = 1;
                    } else if ($typeChoisi == '0') {
                        $_SESSION["TypeGalerie"] = 0;
                    }

                    header("location:newGalleryName.php");
                }

                ?>
</body>

</html>
