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

function validateRow(frm) {
  var chkb = document.getElementById("chkValidate");
  if (chkb.checked) {
    var tbl = document.getElementById("tblSample");
    var lastRow = tbl.rows.length - 1;
    var i;
    for (i = 1; i <= lastRow; i++) {
      var aRow = document.getElementById("txtRow" + i);
      if (aRow.value.length <= 0) {
        alert("Row " + i + " is empty");
        return;
      }
    }
  }
  //formDataToObject(frm);
}

function printToPage() {
  var pos;
  var searchStr = window.location.search;
  var searchArray = searchStr.substring(1, searchStr.length).split("&");
  var htmlOutput = "";
  for (var i = 0; i < searchArray.length; i++) {
    htmlOutput += searchArray[i] + "<br />";
  }
  return htmlOutput;
}

function formDataToObject(elForm) {
  if (!elForm instanceof Element) return;
  var fields = elForm.querySelectorAll("input, select, textarea"),
    o = {};

  for (var i = 0, imax = fields.length; i < imax; ++i) {
    var field = fields[i],
      sKey = field.name || field.id;
    o[sKey] = field.value;
  }
  alert("Form data:\n\n" + JSON.stringify(o, null, 2));
  return o;
}
