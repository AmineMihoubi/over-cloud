function ajouterAlbums($idAlbum, $nom) {
  var div = document.getElementById("listeAlbums");
  var br = document.createElement("br");
  var newDiv = document.createElement("div");
  newDiv.id = "carteAlbum";
  var img = document.createElement("img");
  var b = document.createElement("b");
  b.innerHTML = nom;

  h8.addEventListener("click", function () {
    $.ajax({
      url: "photoAlbum.php",
      type: "POST",
      datatype: {
        idAlbum: idAlbum,
        nomAlbum: nom,
      },
      success: function () {
        alert("Ca fonctionne");
      },
    });
    alert("DS");
  });

  img.src = "image/nophoto.jfif";
  newDiv.appendChild(img);
  newDiv.appendChild(br);
  newDiv.appendChild(h8);
  div.appendChild(newDiv);
}
