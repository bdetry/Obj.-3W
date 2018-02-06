<?php

class villeModel
{
    private $db;
    
    public function __construct( $db_insta)
    {
        $this->db = $db_insta;
    }
    
    public function getAll()
    {
        try
        {                        
            if(($resource = $this->db->query('SELECT * FROM ville'))!==FALSE)
            {
                if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                   $villes=[];
                   
                   foreach($data as $ville)
                   {
                        $villes[$ville["v_id"]]=$ville;
                   }
                   
                   return $villes;
                }
            }
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        } 
    }
    
    public function getVilleNains($id)
    {
       try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM nain WHERE n_ville_fk = :id'))!==FALSE)
            {              
                if($resource->execute(["id"=>$id]))
                {
                    if(($data = $resource->fetchAll( PDO::FETCH_ASSOC ))!==FALSE)
                    {
                      return($data);
                    }
                }
            }
            
            return false;
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        } 
    }
    
    public function getVilleTavs($id)
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM taverne WHERE t_ville_fk = :id'))!==FALSE)
            {              
                if($resource->execute(["id"=>$id]))
                {
                    if(($data = $resource->fetchAll( PDO::FETCH_ASSOC ))!==FALSE)
                    {
                      return($data);
                    }
                }
            }
            
            return false;
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        }
    }
    
    public function getVilleTuns($id)
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM tunnel INNER JOIN ville ON tunnel.t_villearrivee_fk  = ville.v_id WHERE t_villedepart_fk = :id'))!==FALSE)
            {              
                if($resource->execute(["id"=>$id]))
                {
                    if(($data = $resource->fetchAll( PDO::FETCH_ASSOC ))!==FALSE)
                    {
                      return($data);
                    }
                }
            }
            
            return false;
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        }
    }
}