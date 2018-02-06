<?php

class groupModel
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
            if(($resource = $this->db->query('SELECT * FROM groupe'))!==FALSE)
            {
                if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                   $grp=[];
                   
                   foreach($data as $groupe)
                   {
                     $grp[$groupe['g_id']] = $groupe;
                   }
                   
                   return $grp;
                }
            }
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        } 
    }
    
    
    public function getNains($id)
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM nain WHERE n_groupe_fk = :id'))!==FALSE)
            {              
                if($resource->execute(array("id"=>$id)))
                {
                    if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
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
    
    public function getTun($id)
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
    
    public function getTav($id)
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
    
    public function getAllTuns()
    {
        if(($resource = $this->db->query('SELECT * FROM tunnel'))!==FALSE)
        {
            if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
            {                   
               return $data;
            }
        }
    }
    
    public function getAllTavs()
    {
        if(($resource = $this->db->query('SELECT * FROM taverne'))!==FALSE)
        {
            if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
            {                   
               return $data;
            }
        }
    }
    
    public function ChangeHor($gid , $newDebut , $newFin)
    {
        if(($resource = $this->db->prepare('UPDATE groupe SET g_debuttravail = :newD , g_fintravail = :newF WHERE g_id = :gid'))!==FALSE)
        {
            if($resource->execute(array("newD"=>$newDebut, "newF"=>$newFin , "gid"=>$gid)))
            {
               return true;
            }                
        }
        
        return false;
    }
    
    
    public function ChangeTun($gid , $newTun)
    {
        if(($resource = $this->db->prepare('UPDATE groupe SET g_tunnel_fk = :newT WHERE g_id = :gid'))!==FALSE)
        {
            if($resource->execute(array("newT"=>$newTun, "gid"=>$gid)))
            {
               return true;
            }                
        }
        
        return false;
    }
    
    public function ChangeTav($gid , $newTav)
    {
        if(($resource = $this->db->prepare('UPDATE groupe SET g_taverne_fk = :newT WHERE g_id = :gid'))!==FALSE)
        {
            if($resource->execute(array("newT"=>$newTav, "gid"=>$gid)))
            {
               return true;
            }                
        }
        
        return false;
    }
    
}