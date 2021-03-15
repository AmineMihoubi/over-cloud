<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="css\styles.css" media="screen" type="text/css">
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>

    <body>
        <!-- bare de navigation-->
        <?php
         session_start();
        ?>
        <div id = navigationBar></div>
        <script>
        $(function(){
        $("#navigationBar").load("navigationbar.php");
        });
        </script>

        <div id = carteParametresGalerie>
            <div id = carteText>
                <h5>Paramètres de la galerie</h5>
                    <div id = infoText>
                        <i>Les galeries servent à contenir les albums photos afin de les partager avec tout le monde, ou seulement à ceux qui ont la permission.
                            Partagez des photos, ou participez aux discussions sur celle-çi avec les personnes de votre choix !
                        </i>
                    </div>
                <form id = "paraGalerie-form" action="modificationGalerie.php" method="POST">
                <h9>Changez le nom de la galerie :  </h9>
                <input type="text" class = "champSaisieGalerie" placeholder="<?php echo $_SESSION['nomGalerie'] ?>" name="nomGalerie">
                <br></br>
                <h9>Selectionnez le paramètre de confidentialité :  </h9>  
                <input type="radio" id="publique" name="confidentialite" value="publique">
                <label for="publique">Galerie publique</label><br>
                <input type="radio" id="prive" name="confidentialite" value="prive">
                <label for="prive">Galerie privée</label><br> 
                <input type="submit" class = "buttonConfirmer" name="submit" value="Confirmer!">  

                </form>               
            </div>

           <br></br>      
           <br></br>      
             
        </div>

    


        </div>
    </body>