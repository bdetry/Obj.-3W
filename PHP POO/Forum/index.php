<?php
session_start();
   

function loadClass( $className )
{
    $_str_file = 'classes/' .$className. '.class.php';
    if( file_exists( $_str_file ) )
        require_once( $_str_file );
}
spl_autoload_register( 'loadClass' ); // On lance la procédure d'auto-chargement des classes avec la fonction "includeClass" en callback

?>

<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>Forum OOP</title>
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

$displayStart = new DisplayModal();
$display = $displayStart->getDisplay();
$display->setConvsInstrans();

echo($display);



?>
    
 
</body>
</html>
