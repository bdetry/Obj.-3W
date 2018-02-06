<div id="newTaverne" class="actionGrp">
    <h4>Changer de taverne</h4>
        <form action="?id=<?php echo $gid; ?>&c=Group&do=ChangeTav" method="post">
        <select name="newTaverne">
            <?php
            foreach($tavernes as $taverne)
            {
                ?><option value="<?php echo $taverne['t_id']; ?>"><?php echo $taverne['t_nom']; ?></option><?php
            }
            ?>
        </select>
        <input type="submit" value="Changer">
    </form>
</div>


</div>
</main>


<style type="text/css">
    
    .actionContainer
    {
        width: 100%;
    }
    
    .actionGrp
    {
        width: 100%;
        box-sizing: border-box;
        padding: 10px;
        background-color: #eee;
        margin-top: 5px;
    }
    
    .actionGrp h4
    {
        text-align: center;
        padding:10px;
        font-size: 1.5rem;
        color: #333;
        margin: 0;
        background-color: #7dd177;
        box-sizing: border-box;
    }
    
    .actionGrp form
    {
        margin: auto;
        width: 100%;
        text-align: center;
        padding: 10px;
    }
    
    .actionGrp form input
    {
        margin: 5px;
    }
    
</style>


