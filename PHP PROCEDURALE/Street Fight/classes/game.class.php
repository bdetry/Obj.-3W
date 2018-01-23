<?php
class game  {
    
    //Propietes
    
    private $id;
    private $persos;
    
    //Contruct
    
    public function __construct($gameId)
    {
        $this->id = $gameId;
    }
    
    //Setters
    
    public function setPerso($rsc)
    {
        $this->persos[] = $rsc;
    }
    
    
    //Getters
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getAllPersInGame()
    {
        return $this->persos;
    }
    
    public function getOnePerso($array_index)
    {
        return $this->persos[$array_index];
    }
    
    //Methodes
    
    //la function unset l'instance du fighter qui a un status 2
    public function unsetPerso()
    {
        foreach($this->getAllPersInGame() as $key => $perso)
        {
            if($perso->getStatus()==1)
            {
                unset($this->persos[$key]);
            }
        }
    }
    
    //la function unset un element du tab persos
    public function unsetOnePerso($array_index)
    {
        unset($this->persos[$array_index]);
    }
    
    
    //returne l'index de l'instance du pion concerne dans $persos    
    public function getIndex($fighter_id)
    {
        foreach($this->persos as $key => $perso)
        {
            if( $perso->getId() == $fighter_id)
            {
                return $key;
            }
        }
        
        return false;
    }
    
    //Destoy
    
}