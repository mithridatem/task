<?php
    include('menu.php');
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de tâches</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Ajouter une tache</h2>
    <div>
        <form action="createtask.php" method="post">
            <p>Saisir le nom de la tache : </p>
            <input type="text" name="name_task">
            <br>
            <p>Saisir le détail de la tache : </p>
            <textarea  name="content_task" rows="5" cols="33"></textarea>
            <br>
            <p>Saisir la date de la tache: </p>
            <input type="date" name="date_task">
            <br>
            <p>Type de tâche : </p>
            <select type="text" name="id_type" >
                <option value="5">Aucun</option>
                <option value="1">Courses</option>
                <option value="2">Travail</option>
                <option value="3">Personnel</option>
                <option value="4">Public</option>
            </select>
            <br>
            <br>
            <input type="submit" value="ajouter">    
        </form>   
    </div>    
</body>
</html>
<?php
    //1er partie test des champs de formulaire
    //test si le champ name_task n'est pas vide
    if(isset($_POST['name_task']) and !empty($_POST['name_task'])){
        //création de la variable $name_task
        $name_task = $_POST['name_task'];
        //si non vide j'affiche la valeur de name_task
        echo "<p>Vous avez saisi le nom de tache suivant : $name_task</p>";
    }
    //sinon j'affiche vide
    else{
        echo "<p>le champ nom de tache est vide</p>";
    }
    //test si le champ content_task n'est pas vide
    if(isset($_POST['content_task']) and !empty($_POST['content_task'])){
        //création de la variable $content_task
        $content_task = $_POST['content_task'];
        //si non vide j'affiche la valeur de name_util
        echo "<p>Vous avez saisi dans le champ détail : $content_task</p>";
    }
    //sinon j'affiche vide
    else{
        echo "<p>le champ détail est vide</p>";
    }
    //test si le champ date_task n'est pas vide
    if(isset($_POST['date_task']) and !empty($_POST['date_task'])){
        //création de la variable $date_task
        $date_task = $_POST['date_task'];
        //si non vide j'affiche la valeur de date_task
        echo "<p>Vous avez saisi la date suivante : $date_task</p>";
    }
    //sinon j'affiche vide
    else{
        echo "<p>le champ type de tâche est vide</p>";
    }
    //test si le champ id_type n'est pas vide
    if(isset($_POST['id_type']) and !empty($_POST['id_type'])){
        //création de la variable $id_type
        $id_type = $_POST['id_type'];
        //requéte pour afficher la liste des tâches
        try
        {
            //connexion à la base de données
            $bdd = new PDO('mysql:host=localhost;dbname=task', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                //requete pour récupérer le contenu de toute la table
                $reponse = $bdd->query('SELECT name_type FROM type WHERE id_type='.$id_type.'');
                //boucle pour parcourir et afficher le contenu de chaque ligne de la requete
                
                while ($donnees = $reponse->fetch())
                {       $nom_type= $donnees['name_type'] ;  
                    //si non vide j'affiche la valeur de id_type
                    echo "<p>Vous avez saisi le type de tâche suivant : $nom_type</p>";               
                }
        }
        catch(Exception $e)
        {   //affichage d'une exception
            die('Erreur : '.$e->getMessage());
        }
        
    }
    //sinon j'affiche vide
    else{
        echo "<p>le champ type de tâche est Aucun</p>";
    }   

    //2eme partie enregistrement des informations en BDD
    //test des variables pour l'enregistrement en BDD
    if(isset($name_task) and isset($content_task) and isset($date_task) and isset($id_type)){
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
        $req = $bdd->prepare('INSERT INTO task(name_task, content_task, date_task, id_type) 
        VALUES (:name_task, :content_task, :date_task, :id_type)');
        //éxécution de la requête SQL
        $req->execute(array(
            'name_task' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $name_task),
            'content_task' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $content_task),
            'date_task' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $date_task),
            'id_type' => iconv("UTF-8", "ISO-8859-1//TRANSLIT", $id_type), 
            ));                        
            echo '<p>la tache : '.$name_task.' à était ajouté ! </p>';
            //fermeture de la connexion à la bdd
            $req->closeCursor();                
    }
?>