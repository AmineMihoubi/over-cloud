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

    <div style="text-align: center;margin-bottom: 50px">
      <label>Copier le lien suivant</label>
    </div>
    <div style="text-align: center" >
        <label id="linkNewGallery">noLinkGenerated</label>
        <script>
          var name=localStorage.getItem("galleryName");
          //alert(name);
          //var name = "testPotato";
          var type=localStorage.getItem("new-gallery-type");
          //alert(type);
          //var type = "Group";
          var link = "http://over-cloud.com/album?=";
          if ((type = "Group")) {
            link = link + "g";
          } else {
            link = link + "p";
          }
          link = link + name;
          //alert(link);
          document.getElementById("linkNewGallery").innerHTML = link;
        </script>
    </div>
      <div class="SubmitHolder">
        <a href="parametresGalerie.html" class="button">Terminer</a>
      </div>
    </div>
  </body>
</html>
