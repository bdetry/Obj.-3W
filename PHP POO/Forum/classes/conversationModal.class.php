<?php


class ConversationModal extends Modal {
    
    //Propietes
    
    private $conv;
    private $msgModal;
    private $fullConv;
    
    //Construct
    
    public function __construct($id)
    {
        parent::__construct();
        $this->getFullConv($id);
        $this->conv = new Conversation();
        $this->conv -> setCid($this->getId($id));
        $this->conv -> setCdate($this->getDate($id));
        $this->conv -> setCheure($this->getHeure($id));
        $this->conv -> setCter($this->getTerm($id));
        $this->conv -> setC_nb_msg($this->getNbMsg($id));
        
        //insertion des msgs
        $this->msgModal = new MesgModal();
        $this->conv -> setCmsg($this->setAllMsg($this->getAllMsg($id)));
    }
    
    
    public function getAllMsg($conv_id)
    {
        $orderby="";
        if(isset($_GET['byid']))
        {
            $orderby = 'ORDER BY m_id ASC';
        }
        elseif(isset($_GET['bydate']))
        {
            $orderby = 'ORDER BY m_date ASC';
        }
        elseif(isset($_GET['byaut']))
        {
            $orderby = 'GROUP BY user.u_prenom , user.u_nom';
        }
        
        
        if(($resource = $this->bdd->prepare('SELECT *  FROM message INNER JOIN user ON message.m_auteur_fk = user.u_id WHERE m_conversation_fk = :id '.$orderby.';'))!==FALSE)
        {
            if($resource->execute(array("id"=>$conv_id)))
            {
                if(($array = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                    return $array;
                }
            }
        }
    }
    
    public function setAllMsg($array)
    {
        foreach($array as $msg)
        {
           $this->msgs[] = $this->msgModal->newMsg($msg['m_id']);
        }
        
        if(!empty($this->msgs))
        {
            return $this->msgs; 
        }
        
    }
    
    public function getConv()
    {
        return $this->conv;
    }
    
    private function getId($id)
    {
        return $id;
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function getFullConv($id)
    {
        if(($resource = $this->bdd->prepare('SELECT DISTINCT * , COUNT(DISTINCT message.m_id) , DATE_FORMAT(c_date, "%d-%c-%Y") AS formatedDate FROM conversation LEFT JOIN message ON conversation.c_id = message.m_conversation_fk  WHERE conversation.c_id = :id GROUP BY conversation.c_id'))!==FALSE)
        {
            if($resource->execute(array("id"=>$id)))
            {
               if(($array = $resource->fetch())!==FALSE)
                {
                    $this->fullConv = $array;
                    return $array;
                }
            }
        }
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function getDate()
    {
      return $this->fullConv['formatedDate'];
    }
    
    private function getHeure()
    {
        return  substr($this->fullConv["c_date"], 11 , 8);   
    }
    
    private function getTerm()
    {
        return $this->fullConv["c_termine"]; 
    }
    
    private function getNbMsg()
    {
        return ($this->fullConv["COUNT(DISTINCT message.m_id)"]);
    
    }
    
    
    
}