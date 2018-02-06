<main><h2>Choisir la ville a modifier/consulter</h2>
<div class="chooseVille">
   <form method="get" action="">
         <input type="hidden" name="c" value="Ville">
      <select name="id">
         <?php
         
         foreach($nains as $nain)
         {
            ?><option value="<?php echo $nain['v_id']; ?>"><?php echo $nain['v_id'] . " : " . $nain['v_nom']; ?></option><?php
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

main div.chooseVille
{
    background-color: #1a9612;
    width: 450px;
    padding: 20px;
}

main div.chooseVille form
{
    width: 90%;
    margin: auto;
    
}

main div.chooseVille form select
{
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #473100;
}

main div.chooseVille form input
{
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #473100;
    border: none;
    margin-top: 5px;
}
</style>