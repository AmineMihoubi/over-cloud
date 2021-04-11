          <!-- Selectionne la galerie avec l'id 1-->
          <?php
          require '../php/ConnectDb.php';
          session_start();
          if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
            header('Location: ../index.php');
          }
          if (isset($_SESSION['idGalerie']) && !empty($_SESSION['idGalerie'])) {
            $idGalerie = $_SESSION['idGalerie'];
          } else {
            $idGalerie = 1; //give a random value so that we don't ruin the whole code 
          }
          $db = ConnectDb::getInstance();
          $sql = "SELECT id_galerie,nom,prive FROM galerie where id_galerie = '$idGalerie'";
          $query = mysqli_query($db, $sql);
          $result = mysqli_fetch_assoc($query);
          $nomGalerie = $result['nom'];
          $typeGalerie = $result['prive'];
          $_SESSION['nomGalerie'] = $nomGalerie;
          $_SESSION['idGalerie'] = $idGalerie;
          $_SESSION['typeGalerie'] = $typeGalerie;
          ?>

          <!-- Bare de navigation !-->

          <ul>
            <h2><?php
                echo "<a href='listeGalerie.php'>$nomGalerie</a>";
                ?></h2>
            <?php echo "<li><a href='albums.php?id=$idGalerie'>Albums</a></li>";
            ?>

            <li><a href="photos.php">Photos</a></li>
            <li><a href="parametresGalerie.php">Paramètres</a></li>
            <!--<li><a href="">Participants</a></li>-->
            <li id="paraUtilisateur"><a href="parametresUtilisateurs.php">
                <?php
                $_SESSION['blaseUtilisateur'] = $_SESSION['prenomUtilisateur'] . " " . $_SESSION['nomUtilisateur'];
                echo  $_SESSION['blaseUtilisateur'];
                ?></a></li>
            <li id="deconnexion"><a href="../php/deconnexion.php">Se déconnecter</a></li>
          </ul>