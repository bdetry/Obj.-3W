<!DOCTYPE html>
<?php include 'php/f.php'; include 'php/dbcon.php';

   if(isset($_GET['vid']))
   {
       $villeInfo = ville($bdd , $_GET['vid']);
       
       if(empty($villeInfo))
      {
         header('Location: ville.php');
         exit;
      }
   }       
?>    
<html lang="en">
<head>
   <title>Ville</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="style/ville.css" />
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
      
      if(isset($_GET['vid']))
      {
      
         ?>
         <div class="villeConatiner">
            <a href="ville.php" class="retour"> &#8592; Villes</a>
            <hr>
            <div><?php echo $villeInfo[0]['v_nom']; ?> (<?php echo $villeInfo[0]['v_superficie']; ?> m&sup2;)</div>
            <hr>
            <div>
               <p>Nains d'ici</p>
               <ul>
            <?php
               if(($nainsDici = $bdd->prepare('SELECT * FROM nain WHERE n_ville_fk = :ville'))!==FALSE)
               {
                   if($nainsDici->bindValue('ville' , $_GET['vid']))
                   {
                       if($nainsDici->execute())
                       {
                           if(($toutNainDici = $nainsDici->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                           {
                              foreach($toutNainDici as $nain)
                              {
                                 ?><li><a href="nain.php?nid=<?php echo $nain['n_id']; ?>"><?php echo $nain['n_nom']; ?></a></li><?php
                              }
                           }
                           else
                           {
                              echo "Errue FetchAll";
                           }
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
            
            ?>
               </ul>
            </div>
            <div>
               <p>Tavernes d'ici</p>
               <ul>
            <?php
               if(($taverDici = $bdd->prepare('SELECT * FROM taverne WHERE t_ville_fk = :ville'))!==FALSE)
               {
                   if($taverDici->bindValue('ville' , $_GET['vid']))
                   {
                       if($taverDici->execute())
                       {
                           if(($touteLesTavernesDici = $taverDici->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                           {
                              foreach($touteLesTavernesDici as $taverne)
                              {
                                 ?><li><a href="taverne.php?tid=<?php echo $taverne['t_id']; ?>"><?php echo $taverne['t_nom']; ?></a></li><?php
                              }
                           }
                           else
                           {
                              echo "Errue FetchAll";
                           }
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
            
            ?>
               </ul>
            </div>
            <div>
               <p>Tunnelles partant</p>
               <ul>
            <?php
               if(($tunnelDici = $bdd->prepare('SELECT * FROM tunnel INNER JOIN ville ON tunnel.t_villearrivee_fk  = ville.v_id WHERE t_villedepart_fk = :cetteVille'))!==FALSE)
               {
                   if($tunnelDici->bindValue('cetteVille' , $_GET['vid']))
                   {
                       if($tunnelDici->execute())
                       {
                           if(($TousLesTunnelDici = $tunnelDici->fetchAll(PDO::FETCH_ASSOC))!==FALSE)
                           {
                              foreach($TousLesTunnelDici as $tunnelVille)
                              {
                                 if($tunnelVille['t_progres']==100)
                                 {
                                    $Tunnelstatus = " ouvert ";
                                 }
                                 else
                                 {
                                    $Tunnelstatus = $tunnelVille['t_progres']. "%";
                                 }
                                 
                                 
                                 ?><li><a href="ville.php?vid=<?php echo $tunnelVille['v_id']; ?>"> T. n&#176; <?php echo $tunnelVille['t_id'] .' : vers '. $tunnelVille['v_nom'] . ' ('.$Tunnelstatus.') '; ?> </a></li><?php
                              }
                           }
                           else
                           {
                              echo "Errue FetchAll";
                           }
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
            
            ?>
               </ul>
            </div>
         </div>
         <?php
      }
      else
      { 
         ?>         
         <h2>Choisir la ville a modifier/consulter</h2>
         <div class="chooseVille">
            <form method="get" action="">
               <select name="vid">
                  <?php
                  
                  foreach(ville($bdd) as $ville)
                  {
                     ?><option value="<?php echo $ville['v_id']; ?>"><?php echo $ville['v_id'] . " : " . $ville['v_nom']; ?></option><?php
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
