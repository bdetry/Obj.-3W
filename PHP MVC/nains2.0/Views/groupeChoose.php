<main><h2>Choisir le Groupe a modifier/consulter</h2>
<div class="groupeVille">
   <form method="get" action="">
         <input type="hidden" name="c" value="Group">
      <select name="id">
         <?php
         
         foreach($groupes as $groupe)
         {
            ?><option value="<?php echo $groupe['g_id']; ?>"><?php echo $groupe['g_id'] ;?></option><?php
         }
         
         ?>
      </select>
      <input type="submit" value="Continuer">
   </form>
</div>
</main>

<style type="text/css">
main h2
{
    margin-top: 10vh;
    color: #333;
}

main div.groupeVille
{
    background-color: #1a9612;
    width: 450px;
    padding: 20px;
}

main div.groupeVille form
{
    width: 90%;
    margin: auto;
    
}

main div.groupeVille form select
{
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #473100;
}

main div.groupeVille form input
{
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #473100;
    border: none;
    margin-top: 5px;
}
</style>