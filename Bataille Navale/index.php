<?php
   session_start();
   
   if(!isset($_SESSION['histo']))
   {
      $_SESSION['histo']=[];
   }
   
   
      if(isset($_GET['boats']))
      {
         $_SESSION['enemisBoats'] = batEnemis();
         header('Location: index.php');
         exit;
      }
      
      if(isset($_GET['destry']))
      {
         unset($_SESSION['enemisBoats']);
         unset($_SESSION['histo']);
         header('Location: index.php');
         exit;
      }
      

?>


<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>Bataille</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="css/style.css" />
   <link rel="icon" href="" type="image/x-icon">
</head>
    
<body>

<?php

   function batEnemis()//-----------------------------------------------------------
   {
      $batteux=array();
      
      for($i=0;$i<6;$i++)
      {
         $tempBat =  array("X"=>rand(1,10),"Y"=>rand(1,10));
         
         if(in_array($tempBat, $batteux)==FALSE)
         {
            $batteux[$i] = $tempBat;
         }
         
      }
      
      return $batteux;
   }
   
   
   function histo($tir)//-----------------------------------------------------------
   {
      $_SESSION['histo'][]=$tir;
   }
   
   function finGame($tirs, $batEnems)//-----------------------------------------------------------
   {
      $count=0;
      
      foreach($tirs as $tir)
      {
         if(in_array($tir, $batEnems))
         {
            $count++;
         }  
      } 
   
      if($count==6)
      {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function tabCreation($qttTAB, $qttTR , $qttTD)//-----------------------------------------------------------
   {
      $table = '';
      for($i=0;$i<$qttTAB;$i++)
      {
         $table = $table . "<table>" . trCreation($qttTR, $qttTD) . "</table>";
      }
      return $table;
   }
      
   function trCreation($qttTR, $qttTD)//-----------------------------------------------------------
   {
      $tr = '';
      for($i=0;$i<$qttTR;$i++)
      {
         $tr = $tr . "<tr>" . tdCreation($qttTD, $i) . "</tr>";
      }
      return $tr;
   }
      
   function tdCreation($qttTD, $Yvalue)//-----------------------------------------------------------
   {
      $td = '';
      for($i=0;$i<$qttTD;$i++)
      {
         if($i==0)
         {
            $td .=  '<td id="headTab" class="X'.$i.' Y'.$Yvalue.' ">'.$Yvalue.'</td>'  ;
         }
         elseif($Yvalue==0)
         {
            $td .=  '<td id="headTab" class="X'.$i.' Y'.$Yvalue.' ">'.$i.'</td>'  ;
         }
         else
         {
            $td .=  '<td class="X'.$i.' Y'.$Yvalue.' "></td>'  ;
         }
         
      }
      return $td;
   }
   
   // FIN FUNCTIONS -------------------------------------------------------------------------------------------------------------------------------------------------

   
   
   
   if(isset($_POST['x']) AND isset($_POST['y']) AND $_POST['y']!="" AND $_POST['x']!="")
   {
      if(is_numeric($_POST['x']) AND is_numeric($_POST['y']))
      {         
          $x=$_POST['x'];
          $y=$_POST['y'];
          
         
          
         histo(array("X"=>$x,"Y"=>$y));                    
      }     
   }

   if(isset($_SESSION['enemisBoats']) AND !finGame($_SESSION['histo'],$_SESSION['enemisBoats']))
   {
      
      
       ?>
      <div style="text-align: center; padding-top: 20px; font-size: 30px; color: #333;">Ou voulez vous tirer?</div>
      <form method="post" action="" class="form">
         <input type="text" name="x" placeholder="COORDONES X"><br />
         <input type="text" name="y" placeholder="COORDONES Y"><br />
         <input type="submit" value="Tirer">
      </form> 
         
      <?php echo tabCreation(1 , 11 , 11); ?>

<div class="legende">
   <div style="background-color:#527cd0;">Ene. Bat.</div>
   <div style="background-color:#de2424;">Bat. Mort.</div>
   <div style="background-color:#444;">Tir Mort.</div>
</div>

<div class="reset">
   <a href="?destry">RESET</a>
</div>

<style type="text/css">

   .form
   {
      width: 200px;
      margin: auto;
      text-align: center;
      padding: 20px;
   }
   table
   {

      margin: auto;
      background-color: lightblue;
      border-collapse: collapse;
   }
   
   #headTab
   {
      width: 40px;
      height: 40px;
      text-align: center;
      font-weight: bold;
      background-color: #eee;
   }
    
   td
   {
      background-color: #ccc;
      border: solid 1px #333;
      width: 40px;
      height: 40px;
   }
   
   .reset
   {
      text-align: center;
      padding: 10px;
   }
   
   .legende
   {
      width: 200px;
      padding: 10px;
      height: 50px;
      margin: auto;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
   }
   
   .legende div
   {
      width: 50px;
      height: 50px;
      border: solid 1px #333;
      text-align: center;
      padding: 5px;
      color: #eee;
      font-weight: bold;
   }
   
   .fin
   {
      text-align: center;
      font-size: 22px;
      font-weight: bold;
      width: 100%;
   }
   
   <?php
   
   foreach($_SESSION['enemisBoats'] as $boat)
   {
      ?>
      .X<?php echo $boat['X']; ?>.Y<?php echo $boat['Y']; ?>
      {
         background-color: #527cd0;
      }
      <?php
   }
   
   foreach($_SESSION['histo'] as $shooted)
   {
      if(in_array($shooted,$_SESSION['enemisBoats'])==TRUE)
      {      
         ?>
         .X<?php echo $shooted['X']; ?>.Y<?php echo $shooted['Y']; ?>
         {
            background-color: #de2424;
         }
         <?php
      }
      elseif($shooted['X']<=10 AND $shooted['Y']<=10)
      {
         ?>
         .X<?php echo $shooted['X']; ?>.Y<?php echo $shooted['Y']; ?>
         {
            background-color: #444;
         }
         <?php
      }
   }
   
   ?>
   
</style>

      <?php
      
   }
   elseif(isset($_SESSION['enemisBoats']) AND finGame($_SESSION['histo'],$_SESSION['enemisBoats']))
   {
      ?>
      <div class="fin">
         <br><br>Bravo! (c'est facile t'est nul)<br><br><br>
         <a href="?destry" style="padding: 10px; margin: auto; width: 100px; margin: auto; display: block; background-color: #bd4848; text-align: center;
      text-decoration: none; font-size: 20px; color: #333; font-weight: bold;">Re-jouer</a>
      </div>
      <?php
   }
   else
   {
      ?>
      <h2 style="text-align: center;">Bataille</h2>
      <a href="?boats" style="padding: 10px; margin: auto; width: 100px; margin: auto; display: block; background-color: #bd4848; text-align: center;
      text-decoration: none; font-size: 20px; color: #333; font-weight: bold;">Jouer!</a>
      <?php
   }

?>
   
<style type="text/css">
      .fin
      {
         text-align: center;
         font-size: 22px;
         font-weight: bold;
         width: 100%;
         color: green;
      }
</style>   
   
</body>
</html>
