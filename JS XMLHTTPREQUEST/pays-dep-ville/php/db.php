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

    try
    {                        
        if(($resource = $bdd->query('SELECT * FROM pays'))!==FALSE)
        {
            if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
            {
               echo json_encode($data);
            }
        }
    }
    catch(PDOException $msg)
    {
        die($msg->getMessage());
    } 