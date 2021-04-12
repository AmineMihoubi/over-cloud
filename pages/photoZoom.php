<?php
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
  header('Location: ../index.php');
}
require '../php/ConnectDb.php';
$db = ConnectDb::getInstance();
$idPhoto = $_GET['idPhoto'];
?>

<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="../css/styles.css" media="screen" type="text/css" />
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>


  <!-- bare de navigation-->
  <div id=navigationBar></div>
  <script>
    $(function() {
      $("#navigationBar").load("navigationbar.php");
    });
  </script>

  <div id=imageZoom>
    <?php
    $sql = "select * from photo where id_photo = $idPhoto";
    $res = mysqli_query($db, $sql);
    $rep = mysqli_fetch_array($res);
    echo '<img src="data:../image/jpeg;base64,' . base64_encode($rep["photo"]) . ' "class=gallery_img"/>';
    ?>
  </div>

  <div id=section-commentaires>
    <?php
    $sql = "SELECT fk_id_auteur,message FROM commentaire where fk_id_photo = $idPhoto ";
    $result = mysqli_query($db, $sql);
    while ($row =  mysqli_fetch_array($result)) {
      $idAuteur = $row['fk_id_auteur'];
      $commentaire = $row['message'];

      $requete = "SELECT nom,prenom FROM utilisateur WHERE id_utilisateur = $idAuteur";
      $exec_requete = mysqli_query($db, $requete);
      $reponse      = mysqli_fetch_assoc($exec_requete);
      $nom = $reponse['nom'];
      $prenom = $reponse['prenom'];
      echo "
          <div class=commentaires>
          <i>$prenom, $nom</i>
          <br></br>
          <h7>$commentaire</h5>
          <hr></hr>
          </div>";
    }
    ?>
    <div id=text-Area>
      <form method="post" action="../php/envoyerCommentaire.php">
        <textarea name="commentaire" ></textarea>
        <input  type="hidden" name="idPhoto" value="<?php echo $idPhoto;?>"></input>
        <input name='submit' type='submit' value='Envoyer votre commentaire' />
      </form>
      
    </div>

  </div>
</body>