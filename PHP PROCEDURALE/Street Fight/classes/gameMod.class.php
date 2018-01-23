<?php
class gameMod extends modal {
    
    //Propietes

    //Contruct
    
    public function __construct($nbPeros)
    {
        try
        {
            parent::__construct();
            if(($resource = $this->bdd->prepare('INSERT INTO game(date_created) VALUES(:date_created ) '))!==FALSE)
            {                
                if($resource->execute( array("date_created"=>date('d F Y'))))
                {
                    $lastId = $this->bdd->lastInsertId();
                    
                    $game = new game($lastId);                    
                    $NouvPerso = new persoMod();                    
                    $NouvPerso->inserAllPer($game->getId(), $nbPeros);                 
                    $persos = $NouvPerso->getAllPers($game->getId());
                    
                    foreach( $persos as $perso )
                    {
                        $game->setPerso($perso);
                    }
                    
                    $_SESSION['game'] = serialize($game);
                }               
            }            
        }
        catch(PDOException $msg)
        {
            die($msg -> getMessage());
        }
    }
    
    //Setters   

    //Methodes
    
    //Destoy
    
}