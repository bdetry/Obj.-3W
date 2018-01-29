<?php


class MesgModal extends Modal {
    
    private $msg;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function newMsg($id)
    {
        $msg = new Mesg();
        $this->getSetMesg($id);
        $msg->setId($this->getID($id));
        $msg->setNom($this->getNom($id));
        $msg->setDate($this->getDate($id));
        $msg->setMsg($this->getMsg($id));
        $msg->setHeure($this->getHeure($id));
        
        return $msg;
    }
    
    public function getID($id)
    {
        return $id;
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////
    public function getSetMesg($id)
    {
        if(($resource = $this->bdd->prepare('SELECT * , DATE_FORMAT(m_date, "%d-%c-%Y") AS formatedDate FROM message INNER JOIN user ON message.m_auteur_fk = user.u_id  WHERE message.m_id = :id'))!==FALSE)
        {
            if($resource->execute(array("id"=>$id)))
            {
               if(($array = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                    $this->msg = $array;
                    return $array;
                }
            }
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////
    
    public function getNom()
    {
                           
        $prenom = $this->msg[0]['u_prenom'] . " " . $this->msg[0]['u_nom'];
        
        return $prenom;

    }
    
    public function getDate()
    {
        
                    return $this->msg[0]["formatedDate"]; 

    }
    
    public function getHeure()
    {
        
                    $array = substr($this->msg[0]["m_date"], 11 , 8);
                    
                    return $array; 
   
    }
    
    public function getMsg()
    {
                         
                    
                //var_dump( $this->msg);
                return $this->msg[0]["m_contenu"];
 
    }
    
}