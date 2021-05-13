<?php
session_start();
if (!isset($_SESSION['idUtilisateur']) || empty($_SESSION['idUtilisateur'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../css/radiobtn.css" media="screen" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>

<body>

    <div style="display: flex;flex-direction: column;align-items: center;justify-content: center;">
        <form action="nouvelle-galerie-ajout-utilisateurs.php" method="POST" id="profile" name="profile" onsubmit="return validateRow();">
            <p>
                <input type="button" class="button" value="Add" onclick="addRowToTable();" />
                <input type="button" class="button" value="Remove" onclick="removeRowFromTable();" />
                <button type="submit" class="button" name="Submit">Submit</button>
                <input hidden type="checkbox" id="chkValidate" checked=true />
            </p>
            <p>
            </p>
            <table border="1" id="tblSample">
                <tr>
                    <th colspan="3">Sample table</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><input type="text" name="txtRow1" id="txtRow1" size="40" /></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    if (isset($_POST['Submit'])) {
        $listEmails = array();
        if (isset($_POST['txtRow1']) && !empty($_POST['txtRow1'])) {
            $emailValue = $_POST['txtRow1'];
            array_push($listEmails, $emailValue);
        }
        if (isset($_POST['txtRow2']) && !empty($_POST['txtRow2'])) {
            $emailValue = $_POST['txtRow2'];
            array_push($listEmails, $emailValue);
        }
        if (isset($_POST['txtRow3']) && !empty($_POST['txtRow3'])) {
            $emailValue = $_POST['txtRow3'];
            array_push($listEmails, $emailValue);
        }
        if (!empty($listEmails)) {
            $_SESSION['listEmails'] = $listEmails;
            header("location:nouvelle-galerie-status.php");
        }
    }
    ?>

</body>
<script src="../js/ajoutUtilisateurs.js"></script>

</html>