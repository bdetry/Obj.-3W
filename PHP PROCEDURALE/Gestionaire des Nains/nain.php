<!DOCTYPE html>

<?php
include 'php/dbcon.php';
    if(isset($_POST['ngid']) AND isset($_GET['nid']))
    {
        if($_POST['ngid']=="vacc")
        {
            if(($resource = $bdd->prepare('UPDATE nain SET n_groupe_fk = NULL WHERE n_id = :nid'))!==FALSE)
            {
                if($resource->bindValue('nid' , $_GET['nid']))
                {
                    if($resource->execute())
                    {
                        header('Location: nain.php?nid='.$_GET['nid']);
                        exit;
                    }
                    else
                    {
                        echo "Erreur execute();";
                    }
                }
                else
                {
                     echo "Erreur bindValue();";
                }
            }
            else
            {
                echo "Erreur prepare();";
            } 
        }
        else
        {
            if(($resource = $bdd->prepare('UPDATE nain SET n_groupe_fk = :newGroup WHERE n_id = :nid'))!==FALSE)
            {
                if($resource->bindValue('newGroup' , $_POST['ngid']) AND $resource->bindValue('nid' , $_GET['nid']))
                {
                    if($resource->execute())
                    {
                         header('Location: nain.php?nid='.$_GET['nid']);
                           exit;
                    }
                    else
                    {
                        echo "Erreur execute();";
                    }
                }
                else
                {
                     echo "Erreur bindValue();";
                }
            }
            else
            {
                echo "Erreur prepare();";
            } 
        }
    }

?>
    
<html lang="en">
<head>
   <title>Nain</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="style/nain.css" />
   <link rel="stylesheet" type="text/css" href="style/menu.css" />
   <link rel="icon" href="medias/favicon.ico" type="image/x-icon">
</head>
    
<body>
   
   <?php include 'php/f.php'; ?>
   
    <header>
      <h1><a href="index.php">Les Nains</a></h1>
        <?php include 'incl/menu.php'; ?>    
    </header>
    
    <main>
      
   <?php
      if(isset($_GET['nid']))
      {
         if(is_numeric($_GET['nid']))
         {
            $nain = nain($bdd, $_GET['nid']);
            
            if(!empty($nain))
            {
               include 'incl/nainFiche.php'; // LA FICHE DU NAIN
            }
            else
            {
               ?>
               
               <div class="nainProfile">
                  <a href="nain.php"> &#8592; Retour</a>
                  <hr>
                  Le Nain n'existe pas!
               </div>
               <?php
            }   
         }
         else
         {
            echo "Errer reception donnes";
         }
      }
      else
      {
      ?>
         <h2>Choisir le nain a modifier/consulter</h2>
         <div class="chooseNain">
            <form method="get" action="">
               <select name="nid">
                  <?php
                  
                  foreach(nain($bdd) as $nain)
                  {
                     ?><option value="<?php echo $nain['n_id']; ?>"><?php echo $nain['n_id'] . " : " . $nain['n_nom']; ?></option><?php
                  }
                  
                  ?>
               </select>
               <input type="submit" value="Continuer">
            </form>
         </div>
      <?php
      
      }   
   ?>
      
    </main>

</body>
</html>
