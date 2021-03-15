<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="css\newGallery.css" media="screen" type="text/css" />
</head>

<body class="TypeSelectionPage">
  <div id="Titre">
    <h1>Créaction d'une Gallerie</h1>
  </div>

  <form class="Selection" action="newGalleryLink.php" method="POST" onsubmit="return checkForm();">
    <div style="text-align: center">
      <label>Nom de la gallerie</label>
    </div>
    <div style="text-align: center">
      <input type="text" id="nomGallerie" />
    </div>
    <div class="SubmitHolder">
      <button type="submit" id="submit-gallery-name">Suivant</button>
    </div>
  </form>

  <script>
    //Stores the name written inside localStorage (thought you can't read the data inside localStorage when it comes to php. Php can only read cookies or GET/POST requests)
    function checkForm() {
      if (document.getElementById("nomGallerie").value != "") {
        galleryName = document.getElementById("nomGallerie").value;
        //alert(galleryName);
        localStorage.setItem("galleryName", galleryName);
        return true;
      } else {
        alert("Veuillez entrez un nom pour la nouvelle gallerie");
        return false;
      }
    }
  </script>
</body>

</html>