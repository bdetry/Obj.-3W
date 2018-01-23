<!DOCTYPE html>
<?php include 'php/f.php'; include 'php/dbcon.php';

if(isset($_GET['gid']))
{
   $groupeInfo = groupe($bdd , $_GET['gid']);
   
   if(empty($groupeInfo))
  {
     header('Location: groupe.php');
     exit;
  }
}

if(isset($_POST['heureDebut']) AND isset($_POST['heureFin']) AND isset($_POST['gid']))
{
   if($_POST['heureDebut']!="" AND $_POST['heureDebut']!="")
   {
      $debut = $_POST['heureDebut'] . ":00";
      $fin = $_POST['heureFin'] . ":00";
      
      if(($resource = $bdd->prepare('UPDATE groupe SET g_debuttravail = :heureDebut , g_fintravail  = :heureFin WHERE g_id = :gid '))!==FALSE)
      {
          if($resource->bindValue('heureDebut' , $debut) AND $resource->bindValue('heureFin' , $fin) AND  $resource->bindValue('gid' , $_POST['gid']))
          {
              if($resource->execute())
              {
                 header('Location: groupe.php?gid='.$_POST['gid']);
                  exit;
              }
          }
      }
   }
}

if(isset($_POST['newTunnel']))
{
   if(is_numeric($_POST['newTunnel']))
   {
      if(($resource = $bdd->prepare('UPDATE groupe SET g_tunnel_fk = :newtunnel WHERE g_id = :gid '))!==FALSE)
      {
          if($resource->bindValue('newtunnel' , $_POST['newTunnel']) AND $resource->bindValue('gid' , $_POST['gid']))
          {
              if($resource->execute())
              {
                header('Location: groupe.php?gid='.$_POST['gid']);
               exit;
              }
          }
      }
   }
}
$errorNewTav = FALSE;
if(isset($_POST['newTaverne']))
{
   if(is_numeric($_POST['newTaverne']) AND $_POST['newTaverne']!="")
   {
      $nbChambres = taverne($bdd, $_POST['newTaverne'])[0]['t_chambres'];    
      $nbNains = combienDeNains($bdd , $_POST['newTaverne']);      
      $nbNainsGrp = nianDansGroupe($bdd, $_POST['gid'])[0];
      
      if($nbChambres >= $nbNains+$nbNainsGrp)
      {
         if(($resource = $bdd->prepare('UPDATE groupe SET g_taverne_fk  = :newtavene WHERE g_id = :gid '))!==FALSE)
         {
             if($resource->bindValue('newtavene' , $_POST['newTaverne']) AND $resource->bindValue('gid' , $_POST['gid']))
             {
                 if($resource->execute())
                 {
                   header('Location: groupe.php?gid='.$_POST['gid']);
                  exit;
                 }
             }
         }
      }
      else
      {
         $errorNewTav = TRUE;
      }
   
   }
}
?>    
<html lang="en">
<head>
   <title>Groupe</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="style/groupe.css" />
   <link rel="stylesheet" type="text/css" href="style/menu.css" />
   <link rel="icon" href="medias/favicon.ico" type="image/x-icon">
</head>
    
<body>
    <header>
      <h1><a href="index.php">Les Nains</a></h1>
        <?php include 'incl/menu.php'; ?>    
    </header>
    <main>

<?php

if(isset($_GET['gid']))
{
   $tunnelProgress = tunnel($bdd , $groupeInfo[0]['g_tunnel_fk'])[0]['t_progres'];
   if($tunnelProgress==100)
   {
      $tunStatus = " Entretiennent ";
   }
   else
   {
      $tunStatus = " ".$tunnelProgress . "% ";
   }
   
   $taverneConcerne = taverne($bdd , $groupeInfo[0]['g_taverne_fk']);
   $tunnelConcerne = tunnel($bdd , $groupeInfo[0]['g_tunnel_fk']);
  ?>
  <div class="groupeConatiner">
      <a href="groupe.php" class="retour"> &#8592; Groupes</a>
      <hr>
      <div>
         <h3>Groupe n&#176; <?php  echo $groupeInfo[0]['g_id']; ?></h3>
         <p>S'hydrate chez : <a href="taverne.php?tid=<?php echo $taverneConcerne[0]['t_id'];?>"><?php  echo $taverneConcerne[0]['t_nom']; ?></a></p>
         <hr>
         <p>Tunnel n&#176; <?php echo tunnel($bdd , $groupeInfo[0]['g_tunnel_fk'])[0]['t_id'];?><br>
         <?php echo $groupeInfo[0]['g_debuttravail'] . " a " . $groupeInfo[0]['g_fintravail']?><br>
             <a href="ville.php?vid=<?php echo ville($bdd , $tunnelConcerne[0]['t_villedepart_fk'])[0]['v_id'];?>">             
                <?php echo ville($bdd , $tunnelConcerne[0]['t_villedepart_fk'])[0]['v_nom'];?>     
             </a> -
             <a href="ville.php?vid=<?php echo ville($bdd , $tunnelConcerne[0]['t_villearrivee_fk'])[0]['v_id'];?>">    
             <?php
            echo ville($bdd , $tunnelConcerne[0]['t_villearrivee_fk'])[0]['v_nom']; ?>
             
             </a>
             (<?php echo $tunStatus;?>)
         </p>
         <hr>
         <p>
            <span>Membres</span>
            <ul>
               <?php               
                  if(($resource = $bdd->prepare('SELECT * FROM nain WHERE n_groupe_fk  = :gid'))!==FALSE)
                  {
                      if($resource->bindValue('gid' , $groupeInfo[0]['g_id']))
                      {
                          if($resource->execute())
                          {
                              // execution seccesful
                              if(($nainsDuGroupe = $resource->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                              {
                                 foreach($nainsDuGroupe as $nain)
                                 {
                                    ?>
                                    <li>
                                    <a href="nain.php?nid=<?php echo nain($bdd , $nain['n_id'])[0]['n_id'];?>">  
                                    <?php echo $nain['n_nom']; ?>
                                    </a>
                                    </li>                                    
                                    <?php
                                 }
                              }
                          }
                      }
                  }
               ?>
            </ul>
         </p>
      </div>
      <div>
         <?php include 'incl/groupActions.php'; ?>
      </div>
  </div>
  <?php
}
else
{
      ?>         
   <h2>Choisir le groupe a modifier/consulter</h2>
   <div class="chooseGroupe">
      <form method="get" action="">
         <select name="gid">
            <?php
            
            foreach(groupe($bdd) as $groupe)
            {
               ?><option value="<?php echo $groupe['g_id']; ?>"><?php echo $groupe['g_id']; ?></option><?php
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
