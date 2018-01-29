<?php
if(isset($_SESSION['me']))
   {
      $user = unserialize($_SESSION['me']);
   }
   
   if(isset($_GET['decon']))
   {
    session_destroy();
        header('Location: index.php');
        exit;
   }

?>
<table>
    <tr>
        <td><?php echo $user->getPrenom() ." ". $user->getNom() ?></td>
    </tr>
    <tr>
        <td><a href="?decon" style="color: #e88686;">Deconnecter</a></td>
    </tr>
</table>