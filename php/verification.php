<?php
session_start();
if(isset($_POST['email']) && isset($_POST['password']))
{
   require 'ConnectDb.php';
   $db = ConnectDb::getInstance(); 
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $email = mysqli_real_escape_string($db,htmlspecialchars($_POST['email'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($email !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateur where 
              courriel = '".$email."' and mdp = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['courrielUtilisateur'] = $email;

           $requete = "SELECT id_utilisateur, nom, prenom FROM utilisateur WHERE courriel = '".$email."'";
           $exec_requete = mysqli_query($db,$requete);
           $reponse      = mysqli_fetch_assoc($exec_requete);
           $_SESSION['idUtilisateur'] = $reponse['id_utilisateur'];
           $_SESSION['nomUtilisateur'] = $reponse['nom'];
           $_SESSION['prenomUtilisateur'] = $reponse['prenom'];


           header('Location: ../pages/liste-galeries.php');
        }
        else
        {
           header('Location: ../index.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: ../index.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: ../index.php');
}
mysqli_close($db); // fermer la connexion
