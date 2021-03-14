
function ajouterAlbums($idAlbum, $nom){

var d = document.getElementById('listeAlbums');
var br = document.createElement('br');
var newDiv = document.createElement('div');
newDiv.id = "carteAlbum";
var img = document.createElement("img");
var h8 = document.createElement("b");
h8.innerHTML = $nom;


img.src = "/Over-Cloud/image/nophoto.jfif";
newDiv.appendChild(img);
newDiv.appendChild(br);
newDiv.appendChild(h8);
d.appendChild(newDiv);
}