<?php
    include('menu2.php');
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Ajouter un compte utilisateur</h2>
    <div>
    <form action="createaccount.php" method="post">
        <p>Saisir le nom de l'utilisateur : </p>
        <input type="text" name="name_util">
        <br>
        <p>Saisir le prénom de l'utilisateur : </p>
        <input type="text" name="first_name_util">
        <br>
        <p>Saisir l'identifiant de l'utilisateur: </p>
        <input type="text" name="login_util">
        <br>
        <p>Saisir le mot de passe de l'utilisateur: </p>
        <input type="password" name="mdp_util">
        <br>
        <br>
        <input type="submit" value="ajouter">    
    </form>   
    </div>    
</body>
</html>
<?php
    //1er partie test des champs de formulaire
    //test si le champ name_util n'est pas vide
    if(isset($_POST['name_util']) and !empty($_POST['name_util'])){
        //création de la variable $name_util
        $name_util = $_POST['name_util'];
        //si non vide j'affiche la valeur de name_util
        echo "<p>Vous avez saisi le nom d'utilisateur suivant : $name_util</p>";
    }
    //sinon j'affiche vide
    else{
        echo "<p>le champ nom utilisateur est vide</p>";
    }
    //test si le champ first_name_util n'est pas vide
    if(isset($_POST['first_name_util']) and !empty($_POST['first_name_util'])){
        //création de la variable $name_util
        $first_name_util = $_POST['first_name_util'];
        //si non vide j'affiche la valeur de name_util
        echo "<p>Vous avez saisi le prénom d'utilisateur suivant : $first_name_util</p>";
    }
    //sinon j'affiche vide
    else{
        echo "<p>le champ prénom utilisateur est vide</p>";
    }
    //test si le champ login_util n'est pas vide
    if(isset($_POST['login_util']) and !empty($_POST['login_util'])){
        //création de la variable $login_util
        $login_util = $_POST['login_util'];
        //si non vide j'affiche la valeur de login_util
        echo "<p>Vous avez saisi le prénom d'utilisateur suivant : $login_util</p>";
    }
    //sinon j'affiche vide
    else{
        echo "<p>le champ identifiant utilisateur est vide</p>";
    }
    //test si le champ mdp_util n'est pas vide
    if(isset($_POST['mdp_util']) and !empty($_POST['mdp_util'])){
        //création de la variable $mdp_utill
        $mdp_util = $_POST['mdp_util'];
        //hashage du mot de passe
        //$mdp_util = password_hash($mdp_util, PASSWORD_DEFAULT);
        //version md5
        $mdp_util = md5($mdp_util);
        //si non vide j'affiche la valeur de login_util
        echo "<p>Vous avez saisi le mot de passe d'utilisateur suivant : $mdp_util</p>";
    }
    //sinon j'affiche vide
    else{
        echo "<p>le champ mot de passe utilisateur est vide</p>";
    }

    //2eme partie enregistrement des informations en BDD
    //test des variables pour l'enregistrement en BDD
    if(isset($name_util) and isset($first_name_util) and isset($login_util) and isset($mdp_util)){
        //vérification de la connexion à la base de données
        try
        {   //connexion à la base de données                    
            $bdd = new PDO('mysql:host=localhost;dbname=task', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e)
        {   //affichage d'une exception
            die('Erreur : '.$e->getMessage());
        }
        //requete pour ajouter un utilisateur dans la table (utilisateur) de la BDD (task)
        //préparation de la requête SQL
        $req = $bdd->prepare('INSERT INTO utilisateur(name_util, first_name_util, login_util, mdp_util) 
        VALUES (:name_util, :first_name_util, :login_util, :mdp_util)');
        //éxécution de la requête SQL
        $req->execute(array(
            'name_util' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $name_util),
            'first_name_util' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $first_name_util),
            'login_util' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $login_util),
            'mdp_util' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $mdp_util),                                                       
            ));                        
            echo '<p>le compte : '.$login_util.' à était ajouté ! </p>';
            //fermeture de la connexion à la bdd
            $req->closeCursor();                
    }
?>