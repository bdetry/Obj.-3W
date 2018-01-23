<?php

class modal{
    
    protected $bdd;
    
    public function __construct()
    {
         try
         {
            $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de donnÃ©es
                            
            $this->bdd= new PDO ('mysql:host=localhost;dbname=street_fight','root', '' , $pdo_option);
        }
        catch( PDOException $e )
        {
            die( $e->getMessage() );
        }
    }
    
    public function separeConnect()
    {
        try
         {
            $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de donnÃ©es
                            
            $bdd= new PDO ('mysql:host=localhost;dbname=street_fight','root', '' , $pdo_option);
            
            return $bdd;
        }
        catch( PDOException $e )
        {
            die( $e->getMessage() );
        }
    }
}
