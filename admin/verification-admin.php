<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
   require '../php/ConnectDb.php';
   $db = ConnectDb::getInstance();

   // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
   // pour éliminer toute attaque de type injection SQL et XSS
   $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
   $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));

   if ($username !== "" && $password !== "") {
      $requete = "SELECT * FROM administrateur where 
              utilisateur = '" . $username . "' and mdp = '" . $password . "' ";
      $exec_requete = mysqli_query($db, $requete);
      if ($reponse      = mysqli_fetch_array($exec_requete)) {
         $_SESSION['idAdmin'] = $reponse['id_admin'];
         $_SESSION['admin_name'] = $reponse['utilisateur'];
         header('Location: panel-admin.php');
      } else {
         header('Location: index.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }
   } else {
      header('Location: index.php?erreur=2'); // utilisateur ou mot de passe vide
   }
} else {
   header('Location: index.php');
}
mysqli_close($db); // fermer la connexion
