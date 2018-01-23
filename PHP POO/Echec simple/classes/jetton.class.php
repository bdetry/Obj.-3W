<?php

abstract class Jetton
{
    // PROPIETES
    
    private $direction;
    private $deplacement;
    private $position;
    private $equipe;
    
    // CONSTRUCT
    
    // SETTER
    
    public function setDir($param)
    {
        $this->direction = $param;
    }
    
    public function setDep($param)
    {
        $this->deplacement = $param;
    }
    
    public function setPos($param)
    {
        $this->position = $param;
    }
    
    public function setEquipe($param)
    {
        $this->equipe = $param;
    }
    
    //GETTER
    
    public function getDir()
    {
        return $this->direction;
    }
    
    public function getDepla()
    {
        return $this->deplacement;
    }
    
    public function getPos()
    {
        return $this->position;
    }
    
    public function getEquipe()
    {
        return $this->equipe;
    }
    
    // METHODES
    
    
    // DESTROY
}