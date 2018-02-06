<main><h2>Choisir la Taverne a modifier/consulter</h2>
<div class="chooseTaverne">
   <form method="get" action="">
         <input type="hidden" name="c" value="Taver">
      <select name="id">
         <?php
         
         foreach($tavernes as $taverne)
         {
            ?><option value="<?php echo $taverne['t_id']; ?>"><?php echo $taverne['t_id'] . " : " . $taverne['t_nom']; ?></option><?php
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

main div.chooseTaverne
{
    background-color: #1a9612;
    width: 450px;
    padding: 20px;
}

main div.chooseTaverne form
{
    width: 90%;
    margin: auto;
    
}

main div.chooseTaverne form select
{
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #473100;
}

main div.chooseTaverne form input
{
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #473100;
    border: none;
    margin-top: 5px;
}
</style>