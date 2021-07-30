<?php
    testConnexion();
    function testConnexion(){
        //test si les champs existent et contiennent une valeur
        if(isset($_POST['login']) AND !empty($_POST['login']) AND 
        isset($_POST['mdp']) AND !empty($_POST['mdp']))
        {   //suppression des caractéres spéciaux
            $login = htmlspecialchars($_POST['login']);
            $mdp = htmlspecialchars($_POST['mdp']);
            //hashage du mot de passe
            $mdp = md5($mdp);
            echo 'le mot de passe est : '.$mdp.'';
            echo '<br>';
            echo 'le login est : '.$login.'';
            

            try
            {
                include('bddconnexion.php');
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
                            session_start();
                            $_SESSION['login'] = $login;
                            $_SESSION['mdp'] = $mdp;
                            $_SESSION['connected'] = true;
                            echo '<br>';
                            echo 'login connecté : '.$_SESSION['login'];
                            echo '<br>';
                            echo 'mot de passe connecté : '.$_SESSION['mdp'];
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

    }
?>