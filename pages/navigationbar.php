          <?php
          require '../php/ConnectDb.php';
          session_start();
          $db = ConnectDb::getInstance();

          if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
            header('Location: ../index.php');
          }
          if (isset($_SESSION['idGalerie']) && !empty($_SESSION['idGalerie'])) {
            $idGalerie = $_SESSION['idGalerie'];
          } else {
            $idGalerie = 1; //give a random value so that we don't ruin the whole code 
          }
          
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

          <nav class="main-menu">
            <ul>
              <?php
              echo "<li><a href='liste-des-galeries.php'>  <i class='fa fa-bars fa-2x'></i> <span class='nav-text'> $nomGalerie </span></a></li>";
              ?>
              <?php echo "<li><a href='albums.php?id=$idGalerie'> <i class='fa fa-folder fa-2x'></i> <span class='nav-text'>Albums</span></a></li>";
              ?>

              <li>
                <a href="photos.php">
                  <i class="fa fa-picture-o fa-2x"></i>
                  <span class="nav-text">Photos</span>
                </a>
              </li>

              <li>
                <a href="parametres-de-la-galerie.php">
                  <i class="fa fa-gear fa-2x"></i>

                  <span class="nav-text">Paramètres</span></a>
              </li>
              <!--<li><a href="">Participants</a></li>-->
              <li id="paraUtilisateur">
              
               <a href="parametres-de-lutilisateur.php">
               <i class="fa fa-user fa-2x"></i>
               <span class="nav-text">

                  <?php
                  $_SESSION['blaseUtilisateur'] = $_SESSION['prenomUtilisateur'] . " " . $_SESSION['nomUtilisateur'];
                  echo  $_SESSION['blaseUtilisateur'];
                  ?></span></a>
              </li>

            </ul>

            <ul>
              <li id="deconnexion"><a href="../php/deconnexion.php">
                  <i class="fa fa-power-off fa-2x"></i>
                  <span class="nav-text">Déconnecter</span></a></li>
            </ul>
          </nav>