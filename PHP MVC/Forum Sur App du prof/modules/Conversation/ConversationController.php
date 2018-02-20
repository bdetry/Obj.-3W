<?php


class ConversationController extends KernelController {
    
    const PAGE_ID = 'conversation';
    const PAGE_TITLE = 'Conversation';
    
    /**
     * @var obj Contient les instances de toutes les conves et  leurs msgs
     */
    private $class;
    
    /**
     * @var int voir utilite sur setClass(array $convs)
     */
    private $conv_id = null;

    
    public function defaultAction(PDO $db = null)
    {
        $this->init(  __FILE__, __FUNCTION__, $db );
        $this->setProperty( 'ariane', $this->ariane( _( self::PAGE_TITLE ) ) );
        
            if(!is_null(SRequest::getInstance()->get('404')))
            {
                header("Location: 404"); // temporal
                exit;
            }
            
            if(!is_null(SRequest::getInstance()->get('id')))
                $this->setID(SRequest::getInstance()->get('id'));
                       
           
                
            //if(!is_null(SRequest::getInstance()->get('p')))            
            
                
        $this->setClass($this->getModel()->get($this->conv_id));
        
        
        if(null===SRequest::getInstance()->get('p')) // Paginantion marker        
            $p = 0;        
        else        
            $p =SRequest::getInstance()->get('p');
        
         
         if(!is_null(SRequest::getInstance()->get('id')))       
            $this->getClass()[""]->limitMsgByPage($p); // Paginantion
        
            
        switch(SRequest::getInstance()->get('By'))
        {
            case "id":
                $this->getClass()[""]->byId();
                break;
            case "date":
                $this->getClass()[""]->byDate();
                break;
            case "auth":
                $this->getClass()[""]->byAut();
                break;
        }   
        
         if(!is_null($this->getConvId()))
                $this->setView('conv');
                
        $this->render( true );
    }
    
   
    
    public function listAction(PDO $db = null)
    {
        $this->init(  __FILE__, __FUNCTION__, $db );
        $this->setProperty( 'ariane', $this->ariane( _( self::PAGE_TITLE ) ) );
        $this->render( true );
    }
    
    public function setID($id)
    {
        $this->conv_id = $id;
    }
    
    /**
     * Instancie toutes les convs et msg ou une conv si il y a ID
     * 
     * @param array   $convs
     * 
     * @return none
     */
    public function setClass(array $convs)
    {
                
        if($this->conv_id==null)
        {
            foreach($convs as $key=>$conv)
            {
                
                    $this->class[$key] = new ClassConversation();
                    $this->class[$key]->setCid($conv['c_id']);
                    $this->class[$key]->setCdate($conv['c_date']);
                    $this->class[$key]->setCter($conv['c_termine']);
                    $this->class[$key]->setCheure(substr($conv["c_date"], 11 , 8));
                    $this->class[$key]->setC_nb_msg(count($this->makeInstaMsg($conv['c_id'])));
                    $this->class[$key]->setCmsg($this->makeInstaMsg($conv['c_id']));
                
            }
        }
        else
        {
            $conv = $convs;
            $this->class[$key] = new ClassConversation();
            $this->class[$key]->setCid($conv['c_id']);
            $this->class[$key]->setCdate($conv['c_date']);
            $this->class[$key]->setCter($conv['c_termine']);
            $this->class[$key]->setCheure(substr($conv["c_date"], 11 , 8));
            $this->class[$key]->setC_nb_msg(count($this->makeInstaMsg($conv['c_id'])));
            $this->class[$key]->setCmsg($this->makeInstaMsg($conv['c_id']));
        }

    }
    
    public function makeInstaMsg($conv_id)
    {
        $msgs = $this->getModel()->MsgOfConv($conv_id);
        
        if(false!==($msgs))
        {
            $ConvMsgInstans = [];
           foreach($msgs as $key => $msg)
           {
              $ConvMsgInstans[$key] = new ClassMessage($msg['m_id'] , $msg['m_date'], $msg['m_date'], $this->getAuthName($msg['m_auteur_fk']), $msg['m_contenu']);
           }
           
           return $ConvMsgInstans;
        }
    }
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function getAuthName($user_id)
    {
        return $this->getModel()->AuthOfMsg($user_id);
    }
    public function getConvId()
    {
        return $this->conv_id;
    }
    
}
