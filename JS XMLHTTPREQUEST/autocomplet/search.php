<?php
try
{
    $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de donnÃ©es
                    
    $bdd= new PDO ('mysql:host=localhost;dbname=js_pays_select','root', '' , $pdo_option);
}
catch(PDOException $msg)
{
    die($msg -> getMessage());
}

if(isset($_GET['s']))
{
    try
    {
        
        if(($resource = $bdd->prepare('SELECT * FROM ville WHERE ville_nom_reel LIKE ?'))!==FALSE)
        {
            if($resource->execute([$_GET['s']."%"]))
            {
                if(($array = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                    if(empty($array))
                    {
                        echo json_encode(null);   
                    }
                    else
                    {
                        echo json_encode($array);     
                    }
                      
                }
            }    
        }
    
    }
    catch(PDOException $msg)
    {
        die($msg -> getMessage());
    }    
}
else
{
    echo json_encode(null);
}

