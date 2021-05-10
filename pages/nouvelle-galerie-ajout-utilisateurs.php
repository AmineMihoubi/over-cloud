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
        <form action="nouvelle-galerie-ajout-utilisateurs.php" method="POST" id="profile" name="profile">
            <p>
                <input type="button" class="button" value="Add" onclick="addRowToTable();" />
                <input type="button" class="button" value="Remove" onclick="removeRowFromTable();" />
                <button type="submit" class="button" name="Submit" onclick="validateRow(this.form)">Submit</button>
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
        //echo '<script type="text/javascript">alert("On arrive au Submit");</script>';
        $listEmails = array();
        if (isset($_POST['txtRow1']) && !empty($_POST['txtRow1'])) {
            $emailValue = $_POST['txtRow1'];
            //echo '<script type="text/javascript">alert("' . $emailValue . '");</script>';
            array_push($listEmails, $emailValue);
        } else {
            //echo '<script type="text/javascript">alert("txtRow1 field is empty!");</script>';
        }
        if (isset($_POST['txtRow2']) && !empty($_POST['txtRow2'])) {
            $emailValue = $_POST['txtRow2'];
            //echo '<script type="text/javascript">alert("' . $emailValue . '");</script>';
            array_push($listEmails, $emailValue);
        } else {
            //echo '<script type="text/javascript">alert("There is no txtRow2 field!");</script>';
        }
        if (isset($_POST['txtRow3']) && !empty($_POST['txtRow3'])) {
            $emailValue = $_POST['txtRow3'];
            //echo '<script type="text/javascript">alert("' . $emailValue . '");</script>';
            array_push($listEmails, $emailValue);
        } else {
            //echo '<script type="text/javascript">alert("There is no txtRow3 field!");</script>';
        }
        if (!empty($listEmails)) {
            print_r($listEmails);
            $textArray = print_r($listEmails);
            //echo '<script>console.log(' . json_encode($listEmails) . ');</script>';
        }

        if (!empty($listEmails)) {
            $_SESSION['listEmails'] = $listEmails;
            header("location:nouvelle-galerie-lien.php");
        }
    }

    ?>

</body>
<script src="../js/ajoutUtilisateurs.js"></script>

</html>