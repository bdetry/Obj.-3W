<?php

class nainModel
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
            if(($resource = $this->db->query('SELECT * FROM nain'))!==FALSE)
            {
                if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                    $nain=[];
                   foreach($data as $nainComplet)
                   {
                     $nain[$nainComplet["n_id"]] = $nainComplet;
                   }
                   
                   return $nain;
                }
            }
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        } 
    }

    public function getNainVille($id)
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM ville WHERE v_id =:id'))!==FALSE)
            {              
                if($resource->execute(array("id"=>$id)))
                {
                    if(($data = $resource->fetch())!==FALSE)
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
    
    public function getNainGroupe($id)
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM groupe WHERE g_id =:id'))!==FALSE)
            {              
                if($resource->execute(array("id"=>$id)))
                {
                    if(($data = $resource->fetch())!==FALSE)
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
    
    public function getNainTav($id)
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM taverne WHERE t_id =:id'))!==FALSE)
            {              
                if($resource->execute(array("id"=>$id)))
                {
                    if(($data = $resource->fetch())!==FALSE)
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
    
    public function getNainTunnel($id)
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM tunnel WHERE t_id =:id'))!==FALSE)
            {              
                if($resource->execute(array("id"=>$id)))
                {
                    if(($data = $resource->fetch())!==FALSE)
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
    
    public function ChangeNainGroup($nain_id, $nouv_g_id)
    {
        if($nouv_g_id=="vacc")
        {
            if(($resource = $this->db->prepare('UPDATE nain SET n_groupe_fk = NULL WHERE n_id = :nid'))!==FALSE)
            {
                if($resource->execute(array("nid"=>$nain_id)))
                {
                   return true;
                }                
            }
        }
        else
        {
            if(($resource = $this->db->prepare('UPDATE nain SET n_groupe_fk = :newGroup WHERE n_id = :nid'))!==FALSE)
            {
                if($resource->execute(array("newGroup"=>$nouv_g_id , "nid"=>$nain_id)))
                {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function getGroupes()
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM groupe'))!==FALSE)
            {              
                if($resource->execute())
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