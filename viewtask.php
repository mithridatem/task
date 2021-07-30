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
            //test si le login et le mot de passe sont valide si ok redirection
                if($login = $donnees['login_util'] AND $mdp = $donnees['mdp_util'])
                {   
                    $logreq = $donnees['login_util'];
                    $mdpreq = $donnees['mdp_util'];
                    //stockage de l'id utilisateur
                    $idutilsat = $donnees['id_util'];
                    $list =1;
                    
                    //si le login et le mdp sont identique redirection vers viewtask.php avec l'id user 
                    echo '<SCRIPT LANGUAGE="JavaScript">
                    document.location.href="viewtask.php?id_util='.$idutilsat.'"</SCRIPT>';                 

                }                
            }
            //si le login ou le mdp false redirection vers index.php
            if(!isset($idutilsat)){
                echo '<SCRIPT LANGUAGE="JavaScript">
                document.location.href="index.php"</SCRIPT>';
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des tâches</title>
    <link rel="stylesheet" href="style.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="modal.js"></script>
</head>
<body>
    <?php
        echo '<p class="pblist">Liste des tâches</p>';
        $id = isset($_GET['id_util']);
        echo $id;
        //affichage de la liste des tâches :
        
            echo '<form action="viewtask.php?id_util='.$id.'" method="post">';
            echo '<table>';
            //requéte pour afficher la liste des tâches
            try
            {
                //connexion à la base de données
                $bdd = new PDO('mysql:host=localhost;dbname=task', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    //requete pour récupérer le contenu de toute la table
                    $reponse = $bdd->query('SELECT id_task, name_task, date_task FROM task WHERE valid_task=0');
                    //boucle pour parcourir et afficher le contenu de chaque ligne de la requete
                    while ($donnees = $reponse->fetch())
                    {   //affichage du contenu de la requete
                        //quand on clique sur un élément du tableau on lance la fonction js openModal2 qui va lancer le popup
                        //et éxécuter la requéte ajax quand on enregistre
                        echo '<tr><td><input type="checkbox" name="id_task[]" value="'.$donnees['id_task'].'"/>
                        <a href="#" onclick="openModal('.$donnees['id_task'].')" class="plus1" 
                        id="'.$donnees['id_task'].'">Nom: '.$donnees['name_task'].' , 
                        date : '.$donnees['date_task'].'</a></td></tr>';                    
                        }
            }
            catch(Exception $e)
            {   //affichage d'une exception
                die('Erreur : '.$e->getMessage());
            }
            //bouton envoyer
        
            echo '</form>';
            echo '</table>';
            echo '<br><p><input type="submit" class="bt_appel" value="terminer" /></p>';
            echo '</div>';
            
                
            // fonction appel (update table participer field presence_seance)
            if (isset($_POST['id_task']))
            {   
                // récupération des id cochés
                foreach($_POST['id_task'] as $value)
                {    
                    try
                    {
                        //connexion à la base de données
                        $bdd1 = new PDO('mysql:host=localhost;dbname=task', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                        //requete pour update le statut de la tache =0
                        $req = $bdd1->query('UPDATE task SET valid_task =1 Where id_task ='.$value.'');
                        echo '<SCRIPT LANGUAGE="JavaScript">
                        document.location.href="viewtask.php?id_util='.$idutilsat.'"</SCRIPT>';
                    }
                    catch(Exception $e)
                    {   //affichage d'une exception
                        die('Erreur : '.$e->getMessage());
                    }
                }            
            }
            echo '</div>';          

        
        

    ?>
   <!-- popup modal-->
   <div id="dialog"></div>
</body>
</html>