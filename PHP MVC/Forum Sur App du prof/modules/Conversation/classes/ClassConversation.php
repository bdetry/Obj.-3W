<?php


class ClassConversation {
    
    private $c_id;
    private $c_date;
    private $c_termin;
    private $c_heure;
    private $c_nb_msg;
    private $c_msgs;
    
    public function setCid($id)
    {
        $this->c_id = $id;
    }
    
    public function setCdate($date)
    {
        $this->c_date = substr($date , 0 , 10);
    }
    
    public function setCter($termin)
    {
         $this->c_termin = $termin;
    }
    
    public function setCheure($heure)
    {
         $this->c_heure = $heure;
    }
    
    public function setC_nb_msg($nb)
    {
         $this->c_nb_msg = $nb;
    }
    
    public function setCmsg($msg)
    {
        $this->c_msgs = $msg;
    }
    
    public function getCid()
    {
        return $this->c_id;
    }
    
    public function getCtermin()
    {
        return $this->c_termin;
    }
    
    public function getCheure()
    {
        return $this->c_heure;
    }
    
    public function getCdate()
    {
        return $this->c_date;
    }
    
    public function getCnbMsg()
    {
        return $this->c_nb_msg;
    }
    
    public function getCmsg()
    {
        return $this->c_msgs;
    }
    
    public function limitMsgByPage($page = 0)
    {
        $init = $page * 20;
        
        if($page==0)
        {
            $init = 0;
        }     
       
       $end = $init + 20;
       
       $newIndexes = range($init , $end , 1);
       
       foreach($newIndexes as $index)
       {
            $paginated[]= $this->getCmsg()[$index];
       }
       
       $this->setCmsg(NULL);
       $this->setCmsg($paginated);
       
       
       
    }
    
    //ordone $c_msgs par date desc
    public function byDate()
    {
        $msgs = $this->getCmsg();
        //var_dump($msgs);
        
        foreach($msgs as $key => $msg)
        {
           $sort[$key] = strtotime($msg->getDate());
        }
        
        array_multisort($sort, SORT_ASC , $this->c_msgs);
    }
    
    //ordone $c_msgs par id desc
    public function byId()
    {
        $msgs = $this->getCmsg();
        //var_dump($msgs);
        
        foreach($msgs as $key => $msg)
        {
           $sort[$key] = strtotime($msg->getId());
        }
        
        array_multisort($sort, SORT_DESC , $this->c_msgs);
    }
    
    //ordone $c_msgs par auteur desc
    public function byAut()
    {
        $msgs = $this->getCmsg();
        //var_dump($msgs);
        
        foreach($msgs as $key => $msg)
        {
           $sort[$key] = $msg->getNomPren();
        }
        
        array_multisort($sort, SORT_ASC , $this->c_msgs); 
    }
    
    
    
    public function __toString()
    {
         $bckColor = null;
        
        switch($this->getCtermin())
        {
            case 0 :
                $bckColor = "open";
                break;
            case 1 :
                $bckColor = "closed";
                break;
        }
        
        $retunr ='<tr>';
        $retunr .= '<td class="'.$bckColor.'">'.$this->getCid().'</td>'; 
        $retunr .= '<td class="'.$bckColor.'">'.$this->getCdate().'</td>';
        $retunr .= '<td class="'.$bckColor.'">'.$this->getCheure().'</td>';
        $retunr .= '<td class="'.$bckColor.'">'.$this->getCnbMsg().'</td>';
        $retunr .= '<td class="'.$bckColor.'"><a href="'.(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" .'?id='.$this->getCid().'"> Voir </a></td></tr>';
        
        return $retunr;
    }
    
}