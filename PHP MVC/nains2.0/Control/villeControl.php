<?php

class villeControl
{
    
    private $villes;
    private $modal;
    
    public function showHeader()
    {
        require_once('Views/incl/menu.php');
    }
    
    public function showMain($bdd, $whichOne )
    {
        if(is_null($whichOne))
        {
            $this->chooseOne($bdd);
            $this->ShowChooseOne($this->villes);
        }
        else
        {
            $this->chooseOne($bdd);
            if(($villeConcerne = $this->getVille($whichOne))!=false)
            {
                $nom = $villeConcerne['v_nom'];                
                $nains = $this->getNains($villeConcerne['v_id']);
                $tavernes = $this->getTavs($villeConcerne['v_id']);
                $tunnels = $this->getTuns($villeConcerne['v_id']);
                
                
                $this->ShowFiche($nom , $nains, $tavernes , $tunnels);
            }
            else
            {
                return false;
            }

        }
        
        return true;
    }
    
    public function getTuns($id)
    {
        if(($tun = $this->modal->getVilleTuns($id)) !== false)
        {
            return $tun;
        }
        
        return false;
    }
    
    public function getNains($id)
    {
        if(($nains = $this->modal->getVilleNains($id)) !== false)
        {
            return $nains;
        }
        
        return false;
    }
    
    public function getTavs($id)
    {
        if(($tavs = $this->modal->getVilleTavs($id)) !== false)
        {
            return $tavs;
        }
        
        return false;
    }
    
    public function ShowFiche($nom ,$nains, $tavernes , $tunnels)
    {
        require_once('Views/villeFiche.php');
    }
    
    public function ShowChooseOne($nains)
    {
        require_once('Views/villeChoose.php');
    }
    
    public function chooseOne($bdd)
    {
        $this->modal = new villeModel($bdd);
        $this->setVilles( $this->modal->getAll() );
    }
    
    public function setVilles($nains)
    {
        $this->villes = $nains;
    }
    
    public function getVilles()
    {
        return $this->villes;
    }
    
    public function getVille($id)
    {
        if(array_key_exists($id , $this->villes))
        {
            return $this->villes[$id];
        }
        
        return false;
    }
}