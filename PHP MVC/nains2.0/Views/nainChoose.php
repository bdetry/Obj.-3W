<main><h2>Choisir le nain a modifier/consulter</h2>
<div class="chooseNain">
   <form method="get" action="">
         <input type="hidden" name="c" value="Nain">
      <select name="id">
         <?php
         
         foreach($nains as $nain)
         {
            ?><option value="<?php echo $nain['n_id']; ?>"><?php echo $nain['n_id'] . " : " . $nain['n_nom']; ?></option><?php
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

main div.chooseNain
{
    background-color: #1a9612;
    width: 450px;
    padding: 20px;
}

main div.chooseNain form
{
    width: 90%;
    margin: auto;
    
}

main div.chooseNain form select
{
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #473100;
}

main div.chooseNain form input
{
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #473100;
    border: none;
    margin-top: 5px;
}
</style>