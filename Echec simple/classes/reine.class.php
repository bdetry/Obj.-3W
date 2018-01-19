<?php

class Reine extends Jetton
{
    // PROPIETES
    
    private $type;
    
    // CONSTRUCT
    
    public function __construct($pos , $equipe)
    {
        parent::setDir(2);
        parent::setDep(0);
        parent::setPos($pos);
        parent::setEquipe($equipe);
        $this->type = "Reine";
    }     
    // SETTER

    //GETTER
    
    public function getType()
    {
        return $this->type;
    }
    
    // METHODES
    
    public function __toString()
    {
        $bg=null;
        switch(parent::getEquipe())
        {
            case 1:
                $bg = "#6898d6";
                break;
            case 2:
                $bg = "#e55b5b";
                break;
        }
        
        return "<div class='reine' style='background-color: ".$bg."'></div>";
    }
    
    
    // DESTROY
}