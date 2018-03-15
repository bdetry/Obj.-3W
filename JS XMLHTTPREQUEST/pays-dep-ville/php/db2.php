<?php
function deps_are_here($bdd , $country_id )
{
    if(is_numeric($country_id))
    {
        if(($resource = $bdd->prepare('SELECT * FROM departement WHERE departement_pays = :id'))!==FALSE)
        {      
            if($resource->execute(["id"=>$country_id]))
            {
                if(($array = $resource->fetch(PDO::FETCH_ASSOC))!==FALSE)
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

if(deps_are_here($bdd , $_GET['ville'] )===true)
{
    if(isset($_GET['ville']))
    {
        if(($resource = $bdd->prepare('SELECT * FROM departement WHERE departement_pays = :id'))!==FALSE)
        {            
            if($resource->execute(["id"=>$_GET['ville']]))
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

