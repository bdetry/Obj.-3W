<?php
    session_start();
    
    if(isset($_GET['decon']))
    {
        unset($_SESSION['user']);
    }
    
    if(!isset($_SESSION['user']))
    {
        header('Location: index.php');
        exit;
    }
    
    try
    {
        $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de données
                        
        $bdd= new PDO ('mysql:host=localhost;dbname=espacemembre','root', '' , $pdo_option);
    }
    catch(PDOException $msg)
    {
        die($msg -> getMessage());
    }
?>

<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>ESPACE DE GESTION</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="css/admin.css" />
   <link rel="icon" href="" type="image/x-icon">
</head>
    
<body>
    <header>
        <a href="home.php" style="margin-top: 20px;">Accueil</a>
        <p>Gestion utilisateur</p>
        <a href="?add">Ajouter</a>
        <a href="?sup">Suprimer</a>
        <a href="?modif">Modifier</a>
        <p>Compte</p>
        <a href="?decon">Fermer session</a>
    </header>
    <main>
        <?php        
        if(isset($_GET['add']))//---------------------------------------------------------------------------------------------------------------------------ADD
        {
            include 'ajout.php' ;
        }
        elseif(isset($_GET['sup']))//---------------------------------------------------------------------------------------------------------------------------SUP
        {
            include 'sup.php' ;            
        }
        elseif(isset($_GET['modif']))//---------------------------------------------------------------------------------------------------------------------------MOD
        {
            include 'modif.php';
        }
        else//---------------------------------------------------------------------------------------------------------------------------------------------------ELSE
        {
            ?>
            <p>Bienvenue BG! A toi de jouer!</p>
            <?php
        }        
        ?>
        
    </main>
    

</body>
</html>
