<?php
    include('menu2.php');
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceuil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="viewtask.php" method="post">
        <p>Saisir votre login :</p>
        <input type="text" name="login_util">
        <p>Saisir votre mot de passe :</p>
        <input type="password" name="mdp_util">
        <br>
        <br>
        <input type="submit" value="Connexion">
    </form>
    <a href="createaccount.php">Créer un compte</a>
</body>
</html>

