<html>
  <head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link
      rel="stylesheet"
      href="css\newGallery.css"
      media="screen"
      type="text/css"
    />
  </head>

  <body class="TypeSelectionPage">
    <div id="Titre">
      <h1>Créaction d'une Gallerie</h1>
    </div>

    <form
      class="Selection"
      action="affichageLienNouvelleGallerie.html"
      method="POST"
      onsubmit="return checkForm();"
    >
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
      function checkForm() {
        if (document.getElementById("nomGallerie").value != "") {
          galleryName = document.getElementById("nomGallerie").value;
          //alert(document.getElementById("nomGallerie").value);
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