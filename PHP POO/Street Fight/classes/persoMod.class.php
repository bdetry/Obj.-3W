<?php
class persoMod extends modal {
    
    //Propietes
    
    //Contruct
    
    //Setters
    
    //Getters
    
    //Methodes
    
    //returne tout les persos inseres dans cette game
    public function getAllPers($game_id)
    {
        if(($resource = $this->bdd->prepare('SELECT * FROM perso WHERE ID_GAME = :id'))!==FALSE)
            {
                if($resource->bindValue('id' , $game_id))
                {
                    if($resource->execute())
                    {
                        if(($array = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                        {
                            $return = array();
                           foreach($array as $perso)
                           {
                              $return[] = new perso($perso['ID'] ,$perso['name'] , $perso['status'], $perso['ID_GAME']);
                           }
                           
                           return $return;
                        }
                    }
                }
            }
    }
    
    //Inserer tout les persos demandes
    public function inserAllPer($lastGameId, $nbPersos)
    {
        for($i=0;$i<$nbPersos;$i++)
        {
            $this->InsertOnePers($lastGameId);
        }
    }
    
    
    //insere un perso
    public function InsertOnePers($lastGameId)
    {
        try
        {
                        
            if(($resource = $this->bdd->prepare('INSERT INTO perso(name, status, ID_GAME) VALUES(:name, :status, :ID_GAME) '))!==FALSE)
            {                
                if($resource->execute(
                                      array("name"=>$this->aleatoryName(),"status"=>0,"ID_GAME"=>$lastGameId)
                                      ))
                {
                   //ok
                }               
            }            
        }
        catch(PDOException $msg)
        {
            die($msg -> getMessage());
        }
    }
    
    //genere un nom aleatoire
    private function aleatoryName()
    {
       $nameParts = ["sa","de","foe","vis","que","te","rowe","axe","ef","se","dop","rix","egs", "cos", "bac", "oif"];
       shuffle($nameParts);
       $name="";
       
       for($i=0;$i<3;$i++)
       {
         $name = $name . $nameParts[$i];
       }
       
       return $name;
    }
    
    

    
    //la function change le status dans la db
    public function changeStatus($bd_id)
    {
        if(($resource = parent::separeConnect()->prepare('UPDATE perso SET status = 1 WHERE ID =:id'))!==FALSE)
            {
                if($resource->execute(array("id"=>$bd_id)))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
    }
    
    //Destoy
    
}