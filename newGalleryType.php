<html>

<head>
  <meta charset="utf-8" />
  <!-- importer le fichier de style -->
  <link rel="stylesheet" href="css\newGallery.css" media="screen" type="text/css" />
</head>

<body class="TypeSelectionPage">
  <div id="Titre">
    <h1>Comment allez-vous utiliser Overcloud?</h1>
  </div>

  <form class="Selection" action="newGalleryName.php" method="POST" onsubmit="return checkForm();">
    <div class="flex-container">
      <div class="flex-child Personnel">
        <img src="image\person.jpg" class="Personnel" alt="Soi-même" />
        <input type="radio" name="type" value="Single" id="rbtnPersonnel" />
        <label for="rbtnPersonnel">Pour soi-même</label>
      </div>

      <div class="flex-child Groupe">
        <img src="image\group.jpg" class="Groupe" alt="group" />
        <input type="radio" name="type" value="Groupe" id="rbtnGroupe" />
        <label for="rbtnGroupe">Pour un Groupe</label>
      </div>
    </div>

    <div class="SubmitHolder">
      <button type="submit" id="submit-gallery-type" formnovalidate="true">
        Suivant
      </button>
    </div>
  </form>

  <script>
    function checkForm() {
      if (document.getElementById("rbtnPersonnel").checked) {
        selected_type = document.getElementById("rbtnPersonnel").value;
        //alert(selected_type);
        localStorage.setItem("new-gallery-type", selected_type);
        return true;
      } else if (document.getElementById("rbtnGroupe").checked) {
        selected_type = document.getElementById("rbtnGroupe").value;
        //alert(selected_type);
        localStorage.setItem("new-gallery-type", selected_type);
        return true;
      } else {
        alert("Veuillez sélectionner un type de gallerie pour continuer");
        return false;
      }
    }
  </script>
</body>

</html>