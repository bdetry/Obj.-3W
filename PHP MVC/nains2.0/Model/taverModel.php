<?php

class taverModel
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
            if(($resource = $this->db->query('SELECT * FROM taverne'))!==FALSE)
            {
                if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                    $tav = [];
                    
                    foreach($data as $taverne)
                    {
                        $tav[$taverne['t_id']]=$taverne;
                    }
                    
                   return $tav;
                }
            }
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        } 
    }
    
    public function countNains($id)
    {
        $nains = FALSE;
        try
        {                        
            if(($resource = $this->db->prepare('SELECT g_id FROM groupe WHERE g_taverne_fk = :gid'))!==FALSE)
            {
                if($resource->bindValue('gid' , $id))
                {
                    if($resource->execute())
                    {
                        // execution seccesful
                        if(($groupesDansTaverne = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                        {
                            foreach($groupesDansTaverne as $gid)
                            {
                                                      
                                    if(($resource = $this->db->query('SELECT n_id FROM nain WHERE n_groupe_fk = '. $gid['g_id']))!==FALSE)
                                    {
                                        if(($data = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                                        {
                                           foreach($data as $item)
                                           {
                                                $nains = $nains + 1;
                                           }
                                        }
                                    }
                            }
                        }
                    }
                }
            }
        }
        catch(PDOException $msg)
        {
            die($msg->getMessage());
        }
        
        if($nains==FALSE)
        {
            $nains = 0;
        }
        
        
        return $nains;
    }
    
    public function getTavVille($id)
    {
        try
        {                        
            if(($resource = $this->db->prepare('SELECT * FROM ville WHERE v_id = :id'))!==FALSE)
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