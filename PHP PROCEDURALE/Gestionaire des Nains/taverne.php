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
   <title>Taverne</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="style/taverne.css" />
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
      
      if(isset($_GET['tid']))
      {
         $taverne = taverne($bdd, $_GET['tid']);
         $villeConcerne = ville($bdd, $taverne[0]['t_ville_fk']);
         ?>
         <div class="TaverneConatiner">
            <a href="taverne.php" class="retour"> &#8592; Tavernes</a>
            <hr>
            <h4><?php echo $taverne[0]['t_id'] ." : ". $taverne[0]['t_nom']; ?></h4>
            <p>a <a style="color: #666;" href="ville.php?vid=<?php echo $villeConcerne[0]['v_id']; ?>"><?php echo $villeConcerne[0]['v_nom'] ?></a></p>
            <p>
               <span style="font-weight: bold; text-decoration: underline;">Bieres:<br></span>
               <?php
               $bieres=[];
               
               if($taverne[0]['t_blonde']==1)
               {
                  $bieres[]= "Blonde<br>";
               }
               
               if($taverne[0]['t_brune']==1)
               {
                  $bieres[]= "Brune<br>";
               }
               
               if($taverne[0]['t_rousse']==1)
               {
                  $bieres[]= "Rousse<br>";
               }
               
               foreach($bieres as $biere)
               {
                  echo $biere;
               }
               
               ?>
            </p>
            <p> <?php echo combienDeNains($bdd , $_GET['tid']); ?> / <?php echo $taverne[0]['t_chambres']; ?> chambres</p>
         </div>
         <?php
      }
      else
      {
         ?>         
         <h2>Choisir la taverne a modifier/consulter</h2>
         <div class="chooseTaverne">
            <form method="get" action="">
               <select name="tid">
                  <?php
                  
                  foreach(taverne($bdd) as $taverne)
                  {
                     ?><option value="<?php echo $taverne['t_id']; ?>"><?php echo $taverne['t_nom']; ?></option><?php
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
