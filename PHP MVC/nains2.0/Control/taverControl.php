<?php

class taverControl
{
    private $tavernes;
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
            $this->ShowChooseOne($this->tavernes);
        }
        else
        {
             $this->chooseOne($bdd);             
             
             if(($tavConcerne = $this->getTaverne($whichOne))!=FALSE)
             {
                
                $nom = $tavConcerne['t_nom'];
                $ville = $this->getVille($tavConcerne['t_ville_fk']);
                $bieres = array("blonde" => $tavConcerne['t_blonde'] , "brune" => $tavConcerne['t_brune'] , "rousse" => $tavConcerne['t_rousse']);                
                $nbNains = $this->countNainHere($tavConcerne['t_id']);
                $chambres = $tavConcerne['t_chambres'];
                
               $this->ShowFiche($nom , $ville , $bieres , $nbNains ,$chambres);
               
             }
             else
             {
                return false;   
             }
        }
        
        return true;
    }
    
    public function countNainHere($id)
    {
        if(($nb = $this->modal->countNains($id)) !== false)
        {
            return $nb;
        }
        
        return false;
    }
    
    public function getVille($id)
    {
        if(($ville = $this->modal->getTavVille($id)) !== false)
        {
            return $ville;
        }
        
        return false;
    }
    
    public function ShowFiche($nom, $ville , $bieres , $nbNains ,$chambres)
    {
        require_once('Views/taverneFiche.php');
    }
    
    public function ShowChooseOne($tavernes)
    {
        require_once('Views/taverneChoose.php');
    }
    
    public function chooseOne($bdd)
    {
        $this->modal = new taverModel($bdd);
        $this->setTavernes( $this->modal->getAll() );
    }
    
    public function setTavernes($nains)
    {
        $this->tavernes = $nains;
    }
    
    public function getTavernes()
    {
        return $this->tavernes;
    }
    
    public function getTaverne($id)
    {
        if(array_key_exists($id , $this->tavernes))
        {
            return $this->tavernes[$id];
        }
        
        return false;
    }

}