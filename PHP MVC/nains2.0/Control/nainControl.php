<?php

class nainControl
{
    private $nains; // l'id du nain est son index dans larray
    private $modal;
            
    
    public function showHeader()
    {
        require_once('Views/incl/menu.php');
    }
    
    public function showMain($bdd, $whichOne)
    {
        if(is_null($whichOne))
        {
            $this->chooseOne($bdd); // chooseOne devrait s'appeller set all nains from modal
            $this->ShowChooseOne($this->nains);
        }
        else
        {
            $this->chooseOne($bdd);
            
            if(($nainConcerne = $this->getNain($whichOne))!=FALSE)
            {
                $nom = $nainConcerne['n_nom'];
                $barbe = $nainConcerne['n_barbe'];                
                $origine = $this->getVille($nainConcerne['n_ville_fk']);
                $groupe = $this->getGroupe($nainConcerne['n_groupe_fk']);        
                $hydratation = $this->getTaverne($groupe['g_taverne_fk']);
                
                $tunnel = $this->getTunnel($groupe['g_tunnel_fk']);
                
                $villeArrv = array(0=>  $this->getVille($tunnel['t_villedepart_fk'])['v_id'], 1=>$this->getVille($tunnel['t_villearrivee_fk'])['v_nom']);
                $villeDep = array(0=> $this->getVille($tunnel['t_villedepart_fk'])['v_id'], 1=>$this->getVille($tunnel['t_villedepart_fk'])['v_nom']);
               
               
                $this->ShowFiche($nom , $barbe , $origine , $hydratation , $groupe , $villeDep , $villeArrv); // affiche la fiche du nain
                
                $this->ShowSelectGroup($this->getGroupes());
            }
            else
            {
                return false;
            }
        }
        
        return true;
    }
    
    public function ChangeGroupAct($nain_id, $nouv_g_id)
    {
        if($this->modal->ChangeNainGroup($nain_id, $nouv_g_id))
        {
            return true;
        }
        
        return false;
    }
    
    public function getNain($whichOne)
    {
        
        if(array_key_exists($whichOne , $this->nains))
        {
            return $this->nains[$whichOne];
        }
        
        
        return false;
    }
    
    public function ShowSelectGroup($groupes)
    {
        require_once('Views/nainActions.php');
    }
    
    public function ShowChooseOne($nains)
    {
        require_once('Views/nainChoose.php');
    }
    
    public function ShowFiche($nom , $barbe , $origine , $hydratation , $groupe , $villeDep , $villeArrv)
    {
        require_once('Views/nainFiche.php');
    }
    
    public function getVille($id)
    {
        if(($ville = $this->modal->getNainVille($id)) !== false)
        {
            return $ville;
        }
        
        return false;
    }
    
    public function getTunnel($id)
    {
        if(($tun = $this->modal->getNainTunnel($id)) !== false)
        {
            return $tun;
        }
        
        return false;
    }
    
    public function getGroupe($id)
    {
        if(($grp = $this->modal->getNainGroupe($id)) !== false)
        {
            return $grp;
        }
        
        return false;
    }
    
    public function getGroupes()
    {
        if(($grp = $this->modal->getGroupes()) !== false)
        {
            return $grp;
        }
        
        return false;
    }
    
    public function getTaverne($id)
    {
        if(($tav = $this->modal->getNainTav($id)) !== false)
        {
            return $tav;
        }
        
        return false;
    }
    
    public function chooseOne($bdd)
    {
        $this->modal = new nainModel($bdd);
        $this->setNains( $this->modal->getAll() );
    }
    
    public function setNains($nains)
    {
        $this->nains = $nains;
    }
    
    public function getNains()
    {
        return $this->nains;
    }
}