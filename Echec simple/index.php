<?php
session_start();
function loadClass( $className )
{
    $_str_file = 'classes/'.$className.'.class.php';
    if( file_exists( $_str_file ) )
        require_once( $_str_file );
}
spl_autoload_register( 'loadClass' ); // On lance la procédure d'auto-chargement des classes avec la fonction "includeClass" en callback

    if(!defined('PHP_EOL')) // verifie si la constante existe (normalement oui)
    {
        if(strtoupper(substr(PHP_OS, 0, 3))=="WIN")
        {
            define('PHP_EOL', "\r\n"); //saut de ligne windows
        }
        else
        {
            define('PHP_EOL', "\n");//saut de ligne syst unix
        }
    }
    
    
?>


<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>L'echec de l'echec</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="style/style.css" />
   <link rel="icon" href="" type="image/x-icon">
</head>
    
<body>   
    
    <?php
     
    if(isset($_GET['start']))
    {

      if(isset($_SESSION['game']))
      {         
         $game = unserialize($_SESSION['game']);
      } else {
         $game = new Game;
      }

      
      if(isset($_GET['bringMe']) AND isset($_GET['useMe']))
      {
         $game->moveMe($_GET['useMe'] , $_GET['bringMe']);
         ?><script>window.location.replace('?start')</script><?php
      }
      
         $countNum = 1;
         $countLett = "A" ;
         //creation array board
         for($i=0;$i<($game->getxDim()*$game->getyDim());$i++)
         {
             if($countLett=="I")
             {
                 $countLett = "A" ;
             }
             
             if($countNum==$game->getxDim()+1)
             {
                 $countLett++;
                 $countNum = 1;
             }
             
             $board[$countLett.$countNum] = NULL;
             
             $countNum++;
         }        
        
        
        
        if($game->getTourCount()==0)
        {
         $game->setAllJettons($board);
            $game->fillBoard();
        }
               
        
        //affichage tu board
        ?>
         <table>
            <?php $game->makeBoard($game->getAllJettons());?>
         </table>         
        <?php 
       
      $bodybg=null;
      if($game->getTourCount()%2 == 1)
      {
        $bodybg = "#6898d6";
      }
      else
      {
         $bodybg = "#e55b5b";
      }
      
        
         if(isset($game))
         {         
            $_SESSION['game'] = serialize($game);
         }
    }
    else
    {
         unset( $_SESSION['game'] );
        ?>
        <h1>Bienvenue : L'echec de l'echec !</h1>
        <a href="?start">Pour commencer une partie clickez ici (c'est a vos risque et periles)</a>
        <?php
    }
    
    
    ?>
    
    <style type="text/css">
      body{
         background-color: <?php echo $bodybg; ?>;
      }
    </style>

</body>
</html>


