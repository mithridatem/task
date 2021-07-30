   
<?php
    // test de l'identifiant
    if (isset($_POST['login_util']) AND !empty($_POST['login_util']) 
    AND isset($_POST['mdp_util']) AND !empty($_POST['mdp_util']))
    {   
        include("menu.php");
        testConnexion();
    }
    else
    {
        include("menu.php"); 
    }
    //méthode de test de connexion
    function testConnexion()
    {
        $login =  $_POST['login_util'];
        $mdp =  $_POST['mdp_util'];
        //version md5
        $mdp= md5($mdp);
        try
        {
            //connexion à la base de données
            $bdd = new PDO('mysql:host=localhost;dbname=task', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            //requete pour stocker le contenu de toute la table
            $reponse = $bdd->query('SELECT * FROM utilisateur WHERE login_util = "'.$login.'" AND mdp_util="'.$mdp.'"');
            //boucle pour parcourir et afficher le contenu de chaque ligne de la table
                while ($donnees = $reponse->fetch())
                {   
                //test si le login et le mot de passe sont valide si ok affichage du login et du password
                    if($login = $donnees['login_util'] AND $mdp = $donnees['mdp_util'])
                    {   
                        $logreq = $donnees['login_util'];
                        $mdpreq = $donnees['mdp_util'];
                        //stockage de l'id utilisateur
                        $idutilsat = $donnees['id_util'];
                        //$_SESSION['id']= $idutilsat;
                        echo "login = $logreq mdp = $mdpreq ";
                    }
                }
                    //si le mot de passe ou le login sont incorrect
                    if($login != isset($logreq) OR $mdp != isset($mdpreq))
                    {   
                        echo '<p>le login ou le mot de passe sont incorrect !!!</p>';
                        echo '<SCRIPT LANGUAGE="JavaScript">
                        document.location.href="index.php</SCRIPT>';
                    }                
        }
        catch(Exception $e)
        {   //affichage d'une exception
            die('Erreur : '.$e->getMessage());
        }        
    }

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceuil Prof</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


</body>
</html>