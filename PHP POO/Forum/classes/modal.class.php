<?php


class Modal {

    //Propietes
    
    protected $bdd;
    
    //Contruct
    
    public function __construct()
    {
        try
        {
            $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de donnÃ©es
                            
            $this->bdd= new PDO ('mysql:host=localhost;dbname=messages','root', '' , $pdo_option);
        }
        catch(PDOException $msg)
        {
            die($msg -> getMessage());
        }
    }
    
    //Setters
    
    //Getters
    
    //Methodes
    
    //Destoy

}