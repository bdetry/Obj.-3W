<?php

session_start();

//la funtion verifie si la prob 10/100 est atteinte
function fuiteProb()
{
    $intervalle = range(0,100);
    
    $rand = rand(0,100);
    
    $value =  $intervalle[$rand];
    
    if($value <= 10)
    {
        return true;
    }
    
    return false;
    
}


//la funtion verifie si la prob 8/100 est atteinte
function repostProb()
{
    $intervalle = range(0,100);
    
    $rand = rand(0,100);
    
    $value =  $intervalle[$rand];
    
    if($value <= 8)
    {
        return true;
    }
    
    return false;
    
}

function loadClass( $className )
{
    $_str_file = 'classes/'.$className.'.class.php';
    if( file_exists( $_str_file ) )
        require_once( $_str_file );
}
spl_autoload_register( 'loadClass' ); // On lance la procédure d'auto-chargement des classes avec la fonction "includeClass" en callback

if(isset($_GET['decon']))
{
  session_destroy();
  header('Location: index.php');
}


?>

<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>Street Fight</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="style/style.css" />
   <link rel="icon" href="" type="image/x-icon">
</head>
    
<body>    
  <?php
  
    if(isset($_SESSION['game']))
    {
      ?><div class="menu"><a href="?decon">Re-start</a></div><?php
        $game = unserialize($_SESSION['game']);
        
        
        if(isset($_GET['me']) AND isset($_GET['to']))
        {
          if($_GET['me']!=$_GET['to'])
          {
            
            $index = $game->getIndex($_GET['to']);
            $indexMe = $game->getIndex($_GET['me']);
            
             if($index!=FALSE)
             {              
                if(fuiteProb()==true)
                {
                  $game->unsetOnePerso($indexMe);
                  echo "<span class='mesg'>FIGHTER EN FUITE !</span>";
                }
                
                if(repostProb()==true)
                {
                  if($game->getOnePerso($indexMe)->addLife())
                  {
                    echo "<span class='mesg'>REPOST !</span>";
                  }
                }
              
                if($game->getOnePerso($index)->addLife())
                {
                  echo "<span class='mesg'>BOOM !</span>";
                  ?>
                  <script type="text/javascript">window.location.href = "./index.php";</script>
                  <?php
                }
             }
          }
          else
          {
            echo "<span class='alert'>Non! Pas posible!</span>";
          }
        }
        
        $game->unsetPerso();
        
        foreach($game->getAllPersInGame() as $perso)
        {
          echo $perso;
        }
        
        $_SESSION['game'] = serialize($game);

    }
    elseif(isset($_GET['go']))
    {
        if(isset($_POST['nbFighters']) AND is_numeric($_POST['nbFighters']) AND $_POST['nbFighters']>0)
        {
           new gameMod($_POST['nbFighters']);
           ?>
           <script type="text/javascript">window.location.href = "./index.php";</script>
           <?php
        }
        else
        {
           ?><script type="text/javascript">window.location.href = "./index.php";</script><?php
        }
    }
    else
    {
        ?>
            <h3>Street Fight</h3><hr>
            <div class="welcomForm">
                <form method="post" action="?go">
                    <label for="nbFighters">Combien de Fighters voulez vous?</label>
                    <input type="number" style="width: 30px;" id="nbFighters" name="nbFighters"><br>
                    <input type="submit" value="Bataille !">
                </form>
            </div>        
        <?php
    }  
  ?>
  
  
</body>
</html>
