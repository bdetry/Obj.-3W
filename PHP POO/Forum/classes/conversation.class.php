<?php


class Conversation {
    
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
        $this->c_date = $date;
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
    
    //ordone $c_msgs par date desc
    public function byDate()
    {
        if($this->c_msgs!=NULL)
        {
            $key=0;
            $count = count($this->c_msgs);
            for($i=0;$i<$count;$i++)
            {
                for($i=$count;$i==0;$i--)
                { 
                    if($key>0)
                    {                
                        $date = $this->c_msgs[$key]->getDate();
                        $dateP1 = $this->c_msgs[$key+1]->getDate();
                        $dateM1 = $this->c_msgs[$key-1]->getDate();
                        if($date > $dateP1)
                        {
                            $temp = $this->c_msgs[$key+1];
                            $this->c_msgs[$key+1] = $this->c_msgs[$key];
                            $this->c_msgs[$key]=$temp;
                        }
                        elseif($date > $dateM1)
                        {
                            $temp = $this->c_msgs[$key-1];
                            $this->c_msgs[$key-1] =  $this->c_msgs[$key];
                            $this->c_msgs[$key]=$temp;                  
                        }
                        
                        $key++;
                    }
                        
                        
                }
            }
        }
    }
    
    //ordone $c_msgs par id desc
    public function byId()
    {
        if($this->c_msgs!=NULL)
        {            
            $key=0;
            $count = count($this->c_msgs);
            for($i=0;$i<$count;$i++)
            {
                
                for($i=$count;$i==0;$i--)
                { 
                    if($key>0)
                    {
                        $id =$this->c_msgs[$key]->getId();
                        $idP1 = $this->c_msgs[$key+1]->getId();
                        $idM1 = $this->c_msgs[$key-1]->getId();
                        
                        if($id > $idP1)
                        {
                            $temp = $this->c_msgs[$key];
                            $this->c_msgs[$key]=$this->c_msgs[$key+1];
                            $this->c_msgs[$key+1] = $temp;
                        }
                        elseif($id > $idM1)
                        {
                            $temp = $this->c_msgs[$key];
                            $this->c_msgs[$key]=$this->c_msgs[$key-1];
                            $this->c_msgs[$key-1] = $temp;                
                        }
                        $key++;
                    }
                    
                    
                }
            }
        }
    }
    
    //ordone $c_msgs par auteur desc
    public function byAut()
    {
        
    }
    
    
    // toString depend obligatoirment de Display::__toString;
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
        
        
        $retunr ='';
        $retunr .= '<td class="'.$bckColor.'">'.$this->getCid().'</td>'; 
        $retunr .= '<td class="'.$bckColor.'">'.$this->getCdate().'</td>';
        $retunr .= '<td class="'.$bckColor.'">'.$this->getCheure().'</td>';
        $retunr .= '<td class="'.$bckColor.'">'.$this->getCnbMsg().'</td>';
        $retunr .= '<td class="'.$bckColor.'"><a href="./messages.php?id='.$this->getCid().'"> Voir </a></td>';
        
        return $retunr;
    }
    
}