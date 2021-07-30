<?php
    include('menu2.php');
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>
<body>
    <form action="./connexion.php" method="post">
        <p>saisir le login : </p>
        <input type="text" name="login">
        <p>saisir le mot de passe : </p>
        <input type="password" name="mdp">
        <input type="submit" value="connexion">
    </form>
    <a href="connexion.php">Créer un compte</a>
</body>
</html>