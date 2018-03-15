<?php
function city_are_here($bdd , $dep_id )
{
    if(is_numeric($dep_id))
    {
        if(($resource = $bdd->prepare('SELECT * FROM ville WHERE ville_departement = :id'))!==FALSE)
        {      
            if($resource->execute(["id"=>$dep_id]))
            {
                if(($array = $resource->fetchALL(PDO::FETCH_ASSOC))!==FALSE)
                {
                    if(empty($array))
                    {
                        return false;
                    }
                    elseif(!empty($array))
                    {
                        return true; 
                    }
                }
            }
        }
    }
    return 0;
}


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

if(city_are_here($bdd , $_GET['dep'] )===true)
{
    if(isset($_GET['dep']))
    {
        if(($resource = $bdd->prepare('SELECT * FROM ville WHERE ville_departement = :id'))!==FALSE)
        {            
            if($resource->execute(["id"=>$_GET['dep']]))
            {
                if(($array = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                    echo json_encode($array);
                }
            }
        }
    }
}
else
{
    echo json_encode(null);
}

