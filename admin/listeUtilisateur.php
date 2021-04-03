<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/admin.css" media="screen" type="text/css" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>


<body>
          <!-- Bare de navigation !-->
          <div id=navigationBar></div>
    <script>
        $(function() {
            $("#navigationBar").load("navigationbar-admin.php");
        });
    </script>

    <div class = 'carte'>
    <div id=infoText>
                <i>La liste des utilisateurs vous permez de supprimer un compte parmis tous les utilisateurs de l'application.
                </i>
            </div>
    </div>

</body>