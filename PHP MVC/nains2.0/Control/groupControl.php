<?php

class groupControl
{    
    private $groupes;
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
            $this->ShowChooseOne($this->groupes);
        }
        else
        {
            $this->chooseOne($bdd);
            if(($grpConcerne = $this->getGrupe($whichOne))!=FALSE)
            {
                $taverne = $this->getTav($grpConcerne['g_taverne_fk']);
                $groupe = [
                        "id"=>$grpConcerne['g_id'],
                        "debutH"=>$grpConcerne['g_debuttravail'],
                        "finH"=>$grpConcerne['g_fintravail'],                    
                            ];
                $tunnel = $this->getTun($grpConcerne['g_tunnel_fk']);
                $membres = $this->getNains($grpConcerne['g_id']);
                
                $this->showFiche($taverne , $groupe, $tunnel , $membres); // fiche du groupe
                
                
                $this->ShowChangeHoraires($whichOne);
                $this->ShowChangeTunnel($whichOne, $this->getAllTuns());
                $this->ShowChangeTav($whichOne, $this->getAllTavs());
                
            }
            else
            {
               return false;
            }
            

        }
        
        return true;
    }
    
    public function ShowChangeTav($gid , $tavernes)
    {
        require_once('Views/groupeActTav.php');
    }
    
    public function ShowChangeTunnel($gid  , $tunnels)
    {
        require_once('Views/groupeActTunnel.php');
    }
    
    public function ShowChangeHoraires($gid)
    {
        require_once('Views/groupeActHoraires.php');
    }
    
    public function getAllTuns()
    {
        if(($tuns = $this->modal->getAllTuns())!=false)
        {
            return $tuns;
        }
        
        return false;
    }
    
    public function getAllTavs()
    {
        if(($tavs = $this->modal->getAllTavs())!=false)
        {
            return $tavs;
        }
        
        return false;
    }
    
    public function getNains($id)
    {
        if(($tun = $this->modal->getNains($id))!=false)
        {
            return $tun;
        }
        
        return false;
    }
    
    public function getTun($id)
    {
        if(($tun = $this->modal->getTun($id))!=false)
        {
            return $tun;
        }
        
        return false;
    }
    
    public function getTav($id)
    {
        if(($tav = $this->modal->getTav($id))!=false)
        {
            return $tav;
        }
        
        return false;
    }
    
    public function showFiche($taverne , $groupe , $tunnel , $membres)
    {
        require_once('Views/groupeFiche.php');
    }
    
    public function ShowChooseOne($groupes)
    {
        require_once('Views/groupeChoose.php');
    }
    
    public function chooseOne($bdd)
    {
        $this->modal = new groupModel($bdd);
        $this->setGroupes( $this->modal->getAll() );
        
    }
    
    public function setGroupes($groupes)
    {
        $this->groupes = $groupes;
    }
    
    public function getGroupes()
    {
        return $this->groupes;
    }
    
    public function getGrupe($whichOne)
    {
        if(array_key_exists($whichOne , $this->groupes))
        {
            return $this->groupes[$whichOne];
        }
        
        return false;
    }
    
    public function ChangeHorAct($gid , $newDebut , $newFin)
    {
        if($this->modal->ChangeHor($gid , $newDebut , $newFin))
        {
            return true;
        }
        
        return false;
    }
    
    public function ChangeTunAct($gid , $newTun)
    {
        if($this->modal->ChangeTun($gid , $newTun))
        {
            return true;
        }
        
        return false;
    }
    
    public function  ChangeTavAct($gid , $newTav)
    {
        if($this->modal->ChangeTav($gid , $newTav))
        {
            return true;
        }
        
        return false;
    }
    
}