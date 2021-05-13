function addRowToTable() {
  var tbl = document.getElementById("tblSample");
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  if (lastRow >= 4) {
    return;
  }
  var iteration = lastRow;
  var row = tbl.insertRow(lastRow);

  // left cell
  var cellLeft = row.insertCell(0);
  var textNode = document.createTextNode(iteration);
  cellLeft.appendChild(textNode);

  // right cell
  var cellRight = row.insertCell(1);
  var el = document.createElement("input");
  el.name = "txtRow" + iteration;
  el.id = "txtRow" + iteration;
  el.size = 40;

  cellRight.appendChild(el);
}

function removeRowFromTable() {
  var tbl = document.getElementById("tblSample");
  var lastRow = tbl.rows.length;
  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
}

function validateRow() {
  var chkb = document.getElementById("chkValidate");
  if (chkb.checked) {
    var tbl = document.getElementById("tblSample");
    var lastRow = tbl.rows.length - 1;
    var i;
    for (i = 1; i <= lastRow; i++) {
      var aRow = document.getElementById("txtRow" + i);
      if (aRow.value.length <= 0) {
        if (i == 1) {
          alert("La ligne #1 doit contenir un courriel pour continuer!");
        } else {
          alert("La ligne #" + i + " doit contenir un courriel ou, être supprimé avant de continuer!");
        }
        return false;
      }
    }
  }
  return true;
}
