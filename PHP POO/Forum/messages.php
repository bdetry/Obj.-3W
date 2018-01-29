<?php
session_start();

function loadClass( $className )
{
    $_str_file = 'classes/' .$className. '.class.php';
    if( file_exists( $_str_file ) )
        require_once( $_str_file );
}
spl_autoload_register( 'loadClass' ); // On lance la procédure d'auto-chargement des classes avec la fonction "includeClass" en callback

    if(!isset($_GET['id']) OR $_GET['id']==NULL)
    {
        header('Location: ./index.php');
    }
    
    $p=null;
    if(isset($_GET['p']))
    {
      $p = "p=".$_GET['p'];
    }
    
   if(isset($_GET['cont']))
   {      
      $modal =  new userModal();
      
      if($modal->makeSession($_POST['email']))
      {
         $actual = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
         $url = str_replace('&cont' , '' , $actual);
         
        header('Location: '.$url);
        exit;
      }
      else
      {
         ?>
         <table>
            <tr>
               <td style="color: red;">Le mail existe pas !</td>
            </tr>
         </table>
         <?php
      }
      
   }
   
   if(isset($_SESSION['me']))
   {
      $user = unserialize($_SESSION['me']);
   }
   
   
   if(isset($_SESSION['me']) AND isset($_GET['post']))
   {
      if(isset($_POST['cont']) AND $_POST['cont']!="")
      {
         if($user->postMsg($_GET['id'], $user->getId(), $_POST['cont']))
         {
         ?>
         <table>
            <tr>
               <td style="color: green;">Publie</td>
            </tr>
         </table>
         <?php
         }
         else
         {
         ?>
         <table>
            <tr>
               <td style="color: red;">Erreur de publication!</td>
            </tr>
         </table>
         <?php
         }
      }
      else
      {
         ?>
         <table>
            <tr>
               <td style="color: red;">Le corps est vide!</td>
            </tr>
         </table>
         <?php
      }
   }
   
?>


<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>Conversation</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width;user-scalable=no;initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="styles/index.css" />
   <link rel="icon" href="" type="image/x-icon">
</head>
    
<body>
   <?php
   

   if(isset($_SESSION['me']))
   {
      require_once('includes/men.php');
   }
   ?>
    <table>
        <tr>
            <td><a href="./index.php" style="display: block; width: 100%; height: 100%;">&#8592;Retour</a></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td><a href="?id=<?php echo $_GET['id']; ?>&bydate&<?php echo $p; ?>" style="display: block; width: 100%; height: 100%;">By date</a></td>
            <td><a href="?id=<?php echo $_GET['id']; ?>&byid" style="display: block; width: 100%; height: 100%;">By ID</a></td>
            <td><a href="?id=<?php echo $_GET['id']; ?>&byaut" style="display: block; width: 100%; height: 100%;">By Aut</a></td>
        </tr>
    </table>
    
    <?php
    
    $convMod = new ConversationModal($_GET['id']);
    
    if($convMod->getConv()->getCheure()!=NULL)
    {
        $conv = $convMod->getConv();
        

       
       
        $msgs = $conv->getCmsg();
        
        if($msgs!=NULL)
        {
            echo '<table style="width:650px; margin-bottom:50px;">
            <tr>
                <td style="width:100px"><strong>Date</strong></td>
                <td><strong>Heure</strong></td>
                <td><strong>Auteur</strong></td>
                <td><strong>Message</strong></td>
            </tr';
            
           $init=null;
           $end=null;
           
           if(!isset($_GET['p']) OR $_GET['p']==1)
           {
                $init = 0;
           }
           elseif(is_numeric($_GET['p']))
           {
                $init = $_GET['p'] * 20;
           }
           
           if(!isset($_GET['p']) OR $_GET['p']==1)
           {
                $end = 20;
           }
           elseif(is_numeric($_GET['p']))
           {
                $end = $init + 20;
           }
            
            for($i=$init;$i<=$end;$i++)
            {
                if(!isset($msgs[$i]))
                {
                    break;
                }
                else
                {
                  echo $msgs[$i];  
                }               
            }
            
            
            echo '</table>';
            
            $nbMsgs= count($msgs);
            $maxPages = $nbMsgs/20;
            
            $prev=null;
            if(!isset($_GET['p']) OR $_GET['p']==1)
            {
                $prev=1;
            }
            elseif(is_numeric($_GET['p']))
            {
                $prev=$_GET['p'] - 1;
            }
            
            $next=null;
            if(!isset($_GET['p']) OR $_GET['p']==1)
            {
                $next=2;
            }
            elseif(is_numeric($_GET['p']))
            {
                $next=$_GET['p'] + 1;
            }
            
            if(isset($_GET['p']))
            {
                if($maxPages<$_GET['p'])
                {
                    ?><script type="text/javascript">        
                    window.location.href = "?id=<?php echo $_GET['id']; ?>"; 
                   </script><?php
                }
            }
            
            $tri=null;
            if(isset($_GET['byid']))
            {
               $tri = "byid";
            }
            elseif(isset($_GET['bydate']))
            {
               $tri = "bydate";
            }
            elseif(isset($_GET['byaut']))
            {
               $tri = "byaut";
            }
            
            if(isset($_SESSION['me']))
            {
               ?>
               <table>
                  <tr>
                     <td>
                        <form method="post" action="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>&post">
                           <label for="cont">Message</label><br>
                           <textarea name="cont" cols="50" rows="20" placeholder="Contenue..."></textarea><br>
                           <input type="submit" value="Publier">
                        </form>                        
                     </td>
                  </tr>

               </table>
               <?php
            }
            else
            {
               ?>
               <table>
                  <tr>
                     <td>
                        <form method="post" action="<?php echo (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>&cont">
                           <label for="email">Connectez-vous</label><br>
                           <input type="text" name="email" placeholder="Emial">
                           <input type="submit">
                        </form>                        
                     </td>
                  </tr>

               </table>
               
               <?php
            }

         
        ?>
        
        
        
        
        
        <table style="margin-bottom: 100px;">
            <tr>
                <td><a href="?id=<?php echo $_GET['id']; ?>&p=<?php echo $prev ?>&<?php echo $tri; ?>" style="display: block; width: 100%; height: 100%;">&larr;</a></td>
                <td><a href="?id=<?php echo $_GET['id']; ?>&p=<?php echo $next ?>&<?php echo $tri; ?>" style="display: block; width: 100%; height: 100%;">&rarr;</a></td>
            </tr>
        </table>
        <?php
        
        }
        else
        {
            echo '
            <table>
                 <tr>
                     <td>La conversation est vide</td>
                 <tr>
             </table>
            ';
        }
        
        
    }
    else
    {
       ?><script type="text/javascript">        
        window.location.href = "./404.php";        
       </script><?php
    }
    
    
    ?>    
</body>
</html>
