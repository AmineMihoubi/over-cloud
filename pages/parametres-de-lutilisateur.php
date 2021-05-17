<?php
session_start();
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
?>


<html>

<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css">
    <script src="../js/parametres.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>


<body>
    <!-- bare de navigation-->
    <?php
    if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
        header('Location: ../index.php');
    }
    ?>
    <div id=navigationBar></div>
    <script>
        $(function() {
            $("#navigationBar").load("../php/navigationbar.php");
        });
    </script>

    <!-- Parametres utilisateur-->
    <div id=photoProfil>
        <img id="imageProfil" src="../image/profil.PNG" alt="Photo de profil">
    </div>

    <div id=carteParametresUtilisateur>

        <div id=carteText>
            <h5>Modifier les informations de votre compte</h5>

            <?php
                       $idUtilisateur =  $_SESSION['idUtilisateur'];
                       $requete = "SELECT courriel, nom, prenom FROM utilisateur WHERE id_utilisateur = $idUtilisateur";
                       $exec_requete = mysqli_query($db,$requete);
                       $reponse      = mysqli_fetch_assoc($exec_requete);
                       $_SESSION['courrielUtilisateur']= $reponse['courriel'];
                       $_SESSION['nomUtilisateur'] = $reponse['nom'];
                       $_SESSION['prenomUtilisateur'] = $reponse['prenom'];

            ?>

            <form action="../php/modificationUtilisateur.php" method="POST">
                <h9>Prenom : </h9>
                <input type="text" class="champSaisieUtilisateur" placeholder="<?php echo $_SESSION['prenomUtilisateur'] ?>" name="prenom">
                <h9>Nom : </h9>
                <input type="text" class="champSaisieUtilisateur" placeholder="<?php echo $_SESSION['nomUtilisateur'] ?>" name="nom">
                <h9>Adresse couriel : </h9>
                <input type="text" class="champSaisieUtilisateur" placeholder="<?php echo $_SESSION['courrielUtilisateur']; ?>" name="email">

                <h5>Modifier le mot de passe de votre compte</h5>
                <h9>Mot de passe actuel : </h9>
                <input type="password" class="champSaisieUtilisateur" placeholder="Mot de passe actuel" name="mdp">
                <h9>Nouveau mot de passe : </h9>
                <input type="password" class="champSaisieUtilisateur" placeholder="Nouveau mot de passe" name="new-mdp">

                <input type="submit" class="buttonConfirmer" name="submit" value="Confirmer!">
                <?php
                if (isset($_GET['erreur'])) {
                    $err = $_GET['erreur'];
                    if ($err == 1)
                        echo "<h6 style='color:red'>* Le mot de passe actuel est erroné</h6>";
                }
                ?>
            </form>


        </div>

    </div>

</body>

</html>