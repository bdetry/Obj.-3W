<?php


class DisplayModal extends Modal {
    
    private $diplay;
    
    public function __construct()
    {
        parent::__construct();
        $this->display = new Display();
        $this->display->setConvs($this->AllConvs());
    }
    
    public function getDisplay()
    {
        return $this->display;
    }
    
    public function AllConvs()
    {
        if(($resource = $this->bdd->prepare('SELECT * FROM conversation'))!==FALSE)
        {
            if($resource->execute())
            {
                if(($array = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                {
                    return $array;
                }
            }                
        }
        
        return false;
    }
}