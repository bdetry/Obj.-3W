<?php

class homeControl
{
    public function showHeader()
    {
        require_once('Views/incl/menu.php');
    }
    
    public function showMain ( $bdd , $whichOne)
    {
        require_once('Views/homeBody.php');
        
        return true;
    }
}