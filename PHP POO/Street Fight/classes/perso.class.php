<?php
class perso {
    
    //Propietes
    
    private $id;
    private $name;
    private $gameId;
    private $status;
    private $hp;
    
    //Contruct
    
    public function __construct($id, $name, $status, $gameID)
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->gameId = $gameID;
        $this->hp = 0;
    }
    
    //Setters
    
    //Getters
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    //Methodes    
    
    //la function ajoute a $hp 
    public function addLife()
    {
        $this->statusChanger($this->id);
        
        if($this->esquivProb()!=true)
        {
            if($this->status!=1)
            {
                $punch = rand(0, 25);
                $this->hp = $this->hp + $punch;
                
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            echo "<span class='mesg'>Attaque esquive !</span>";
        }
    }
    
    //la function retourne true si la probabilite 15/100 est atteinte
    public function esquivProb()
    {
        $intervalle = range(0,100);
        
        $rand = rand(0,100);
        
        $value =  $intervalle[$rand];
        
        if($value <= 15)
        {
            return true;
        }
        
        return false;
        
    }
    
    //la function change le status dans l'instace et declanche le changement en db
    public function statusChanger($bd_id)
    {
        if($this->hp >= 100)
        {
            $this->status = 1;
            
            if(persoMod::changeStatus($bd_id))
            {
                return true;
            }
            else
            {
                echo "<span class='alert'>Erreur mise a jour en db !</span>";
            }
        }
    }
    
    public function __toString()
    {
         $selectedStr="";
         $selected =false;
        if(isset($_GET['me']))
        {            
            if($_GET['me']==$this->id)
            {
                $selected=true;
            }           
            if($selected==true)
            {
                $selectedStr="selected";
            }            
        }

        
        if(isset($_GET['me']))
        {
            $str = "<a href='?me=".$_GET['me']."&to=".$this->id."'><div class='perso ".$selectedStr."'>".$this->name."<br>HP : ".$this->hp."</div></a>";
        }
        elseif(isset($_GET['me']) AND isset($_GET['to']))
        {
            $str = "<a href='?me=".$this->id."'><div class='perso ".$selectedStr."'>".$this->name."<br>HP : ".$this->hp."</div></a>";
        }
        else
        {
            $str = "<a href='?me=".$this->id."'><div class='perso ".$selectedStr."'>".$this->name."<br>HP : ".$this->hp."</div></a>";
        }
        
        return $str;
    }
    
    //Destoy
    
}