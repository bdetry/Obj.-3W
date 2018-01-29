<?php

class userModal extends Modal {
    
    //Propietes
    
    //Contruct
    
    public function __construct()
    {
        parent::__construct();
    }
    
    //Setters
    
    public function postMesg($convID, $userID, $con)
    {
        
        try
        {
            $pdo_option = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Permet de traquer les erreurs et exceptions
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci' ]; // Envoie une commande d'initialisation au serveur de base de donnÃ©es
                            
            $bdd= new PDO ('mysql:host=localhost;dbname=messages','root', '' , $pdo_option);
        }
        catch(PDOException $msg)
        {
            die($msg -> getMessage());
        }
        
        
        if(($resource = $bdd->prepare('INSERT INTO message(m_contenu, m_date, m_auteur_fk, m_conversation_fk) VALUES(:m_contenu, now(), :m_auteur_fk, :m_conversation_fk)'))!==FALSE)
        {
            if($resource->execute(
                                  [
                                "m_contenu"=>$con,
                                "m_auteur_fk"=>$userID,
                                "m_conversation_fk"=>$convID
                                  ]
                                  
                                  
                                  ))
            {
                return true;
            }
        }
            
            return false;
    }
    
    //Getters
    
    //Methodes
    
    //Destoy
    
    
        
    //vierifie si un mail est deja existant dans la base de donnees retourne
        //false le mail existe pas!
        //retourne l'id de l'utilisateur

    public function mailExist($mail)
    {
        try
        {
            if(( $reponse = $this->bdd->prepare ('SELECT * FROM user WHERE u_login = :mail')) !== false)
            {
                if($reponse->execute(["mail"=>$mail]))
                {
                    if(($data = $reponse->fetch())!= false)
                    {
                        if($data==null)
                        {
                            return false;
                        }
                        else
                        {
                            return $data;
                        }
                    }
                }
            }

        } catch( PDOException $e ) {
            die( $e->getMessage() );
        }
    }



    public function makeSession($mail)
    {
        if($this->mailExist($mail))
        {
            $array = $this->mailExist($mail);
            
            $user = new User();
            $user->setId($array['u_id']);
            $user->setEmail($array['u_login']);
            $user->setNom($array['u_nom']);
            $user->setPrenom($array['u_prenom']);
            
            
            $_SESSION['me'] = serialize($user);
            return true;
        }
        
        return false;
    }
    
}