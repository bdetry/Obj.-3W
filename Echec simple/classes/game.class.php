<?php

class Game
{
    // PROPIETES
    
    private $xDim;
    private $yDim;
    private $tourCount = 0;
    private $jettons;
    
    // CONSTRUCT
    
    public function __construct()
    {
         $this->xDim = 8;
         $this->yDim = 8;
         $this->newLog();
    }
    
    // SETTER
    
    public function setAllJettons($param)
    {
        $this->jettons = $param;
    }
    
    public function setOneJetton($pos, $valeur)
    {
        $this->jettons[$pos] = $valeur;
    }
    
    public function setTour()
    {
        $this->tourCount++;
    }
    
    //GETTER
    
    public function getxDim()
    {
        return $this->xDim;
    }
    
    public function getyDim()
    {
        return $this->yDim;
    }
    
    public function getTourCount()
    {
        return $this->tourCount;
    }
    
    public function getAllJettons()
    {
        return $this->jettons;
    }
    
    public function getOneJetton($pos)
    {
        return $this->jettons[$pos];
    }
    
    // METHODES
    
    //la function inscriot "Nouvelle partie" dans le fichier log chaque fois quelle est appelle
    
    public function newLog()
    {
        $resource = fopen('log/log.txt', 'a+');
                                
        fwrite($resource, PHP_EOL . "Nouvelle partie" . PHP_EOL . PHP_EOL);
        
        fclose($resource);
    }
    
    //La function attend les Gets useMe et bringMe pour agir
    //Elle verifie les posibilites de deplacement de jettons et
    // les re-indexes
    
    public function moveMe($useMe , $bringMe)
    {
        if($this->getDistance($useMe,$bringMe)!=FALSE)
        {
            if($this->getDir($useMe,$bringMe)!=FALSE)
            {
                $useMeMax = $this->getOneJetton($useMe)->getDepla();
                $DirOrder = $this->getOneJetton($useMe)->getDir();
                
                if($this->freeWay($useMe, $bringMe)==TRUE) // verifie si persone sur la route
                {
                    if($DirOrder == $this->getDir($useMe,$bringMe) OR $DirOrder==2) // verifie dir
                    {
                         if($useMeMax == $this->getDistance($useMe,$bringMe) OR $useMeMax == 0) //verifie nb de depla
                         {
                            if($this->isKing($bringMe)==false)
                           {
                                $this->jettons[$bringMe] = $this->jettons[$useMe]; // CHANGEMENT DE POSITION GENERAL
                                $this->jettons[$useMe] = NULL; // VIDAGE DE CELL
                                
                                $this->setTour();
                                
                                $log = "Tour : " . $this->getTourCount() . " ---- " . $useMe . " --> " .  $bringMe . PHP_EOL;
                                
                                $resource = fopen('log/log.txt', 'a+');
                                
                                fwrite($resource, $log);
                                
                                fclose($resource);
                           }
                         }
                     }   
                }
                
            }            
        }        
    }
    
    //La function calcule la distance en line doite (uniquement) entre deux points
    //retourne false au cas ou il ne s'agit pas d'une ligne
    //retourne un int 
    public function getDistance($a,$b)
    {
        $aVert = substr($a , 0,1);
        $aHorz = substr($a , 1,1);
        $bVert = substr($b , 0,1);
        $bHorz = substr($b , 1,1);
       
        if($aHorz == $bHorz)
        {
           return abs(ord($bVert) - ord($aVert));
        }
        else
        {
            return false;
        }
    }
    
    //La fctn verifie le dir vers le quelle l'utilisateur veut deplacre sont pion
    //retourne 1 si c'est vers l'avant 2 c'est vers l'arrire
    //returne false en cas d'erreur
    
    public function getDir($a,$b)
    {
        $aVert = substr($a , 0,1);
        $bVert = substr($b , 0,1);
        
        switch($this->getOneJetton($a)->getEquipe())
        {
            case 1 :
                $sensOrder = ord($bVert)-ord($aVert) ;
                
                if($sensOrder>=0)
                {
                    return 1;
                }
                elseif($sensOrder<=0)
                {
                    return 2;
                }
                
                break;
            case 2 :
                $sensOrder = ord($aVert) - ord($bVert);
                
                if($sensOrder<=0)
                {
                    return 2;
                }
                elseif($sensOrder>=0)
                {
                    return 1;
                }               
                
                break;
        }
        
        
    }
    
    // la funtion verifie si le chemin est libre pour deplacer un pion
    // retourne true ou false - retourne true pour la reine toujour
    
    public function freeWay($origine,$arrive)
    {
        if($this->sameTeam($origine, $arrive)==false)
        {
            return true;
        }
        else
        {
            if($this->getOneJetton($origine)->getType() == "Reine")
            {
                return true;
            }
            else
            {
                $col = substr($origine , 1,1);
                $OriVert = substr($origine , 0,1);
                $ArriVert = substr($arrive , 0,1);
                
                $interv = range($OriVert , $ArriVert);
                
                foreach($interv as $item)
                {
                    $realInterv[] = $item . $col;
                }
                
                $realInterv = array_slice($realInterv , 1);            
                
                foreach($realInterv as $Value)
                {
                    if($this->jettons[$Value]!=NULL)
                    {
                        return false;
                    }
                }
                
                return true;
            }            
        }

    }
    
    //la function dit quelle equipe est qutorise a jouer en function du tour
    // retourne 1 ou 2
    
    public function whoPlay($tour)
    {
        if($tour%2 == 1)
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }
    
    // la function verifie si deux jettons sont la meme equipe
    //retourne true si oui false si non
    
    public function sameTeam($a,$b)
    {        
        if($this->getOneJetton($b)!=NULL)
        {
            $equipe1 = $this->getOneJetton($a)->getEquipe();
            $equipe2 = $this->getOneJetton($b)->getEquipe();
            
            if($equipe1 == $equipe2)
            {
                return true;
            }
        }
        elseif($this->getOneJetton($b)==NULL)
        {
            return false;
        }
        
        return false;
    }
    
    //La function verifie si le jetton attaque est le roi
    //retourne trou ou false
    
    public function isKing($arrive)
    {
        
        if($this->getOneJetton($arrive) == NULL)
        {
            return false;
        }        
        elseif($this->getOneJetton($arrive)->getType() == "Roi")
        {
            return true;
        }
        
        return false;
    }
    
    // La function cree et donne les position initiales des jettons
    public function fillBoard()
    {      
          $initial = [
                      
                   "A2"=>new Tour("A2" , 1),
                   "A3"=>new Cavalier("A3" , 1),
                   "A4"=>new Roi("A4" , 1),
                   "A5"=>new Reine("A5" , 1),
                   "A6"=>new Cavalier("A6" , 1),
                   "A7"=>new Tour("A7" , 1),
                   "B2"=>new Pion("B2" , 1),
                   "B3"=>new Pion("B3" , 1),
                   "B4"=>new Pion("B4" , 1),
                   "B5"=>new Pion("B5" , 1),
                   "B6"=>new Pion("B6" , 1),
                   "B7"=>new Pion("B7" , 1),
                   
                   "H2"=>new Tour("H2" , 2),
                   "H3"=>new Cavalier("H3" , 2),
                   "H4"=>new Roi("H4" , 2),
                   "H5"=>new Reine("H5" , 2),
                   "H6"=>new Cavalier("H6" , 2),
                   "H7"=>new Tour("H7" , 2),
                   "G2"=>new Pion("G2" , 2),
                   "G3"=>new Pion("G3" , 2),
                   "G4"=>new Pion("G4" , 2),
                   "G5"=>new Pion("G5" , 2),
                   "G6"=>new Pion("G6" , 2),
                   "G7"=>new Pion("G7" , 2)
                                    
                      ];
          
          foreach($initial as $key => $jetton)
          {
             $this->setOneJetton($key, $jetton);
          }            
    }
    
        //La function genere un tab HTML
    public function makeBoard($param)
    {
        $i = 0;
        $o = 0;
        echo '<tr>';
        foreach($param as $key => $item)
        {
            if($o==0)
            {
                $back = "#eee";
            }
            elseif($o==1)
            {
                $back = "#ddd";
            }
            
            if($i%8==0) {
                echo '</tr><tr>';
            }
            
            
            
            if($item!=NULL AND !isset($_GET['useMe']) AND $item->getEquipe() == $this->whoPlay($this->getTourCount()))
            {
                $item = "<a class='moveLink' href='?start&useMe=".$key."'>" .$item. "</a>";
            }
            elseif(isset($_GET['useMe']))
            {
                $item = "<a class='moveLink' href='?start&useMe=".$_GET['useMe']."&bringMe=".$key."'>" .$item. "</a>";
            }
            
            
            
            echo "<td bgcolor='".$back."'>".$item."</td>";
            $i++;
            
            if($o==0)
            {
                $o = 1;
            }
            elseif($o==1)
            {
                $o = 0;
            }
        }
        echo '</tr>';
    }
    
    // DESTROY
}