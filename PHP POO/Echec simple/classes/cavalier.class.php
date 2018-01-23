<?php

class Cavalier extends Jetton
{
    // PROPIETES
    
    private $type;
    
    // CONSTRUCT
    
    public function __construct($pos , $equipe)
    {
        parent::setDir(2);
        parent::setDep(3);
        parent::setPos($pos);
        parent::setEquipe($equipe);
        $this->type = "Cavalier";
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
        
        return "<div style='border-radius:5px;margin:auto;
        border-style: solid;
        border-width: 0 20px 40px 20px;
        border-color: transparent transparent ".$bg." transparent;
        width: 00px; height:0;'></div>";
    }
    
    // DESTROY
}