<div class="actionNain">
    <h3>Assigner groupe en NAIN click</h3>
    <form action="?id=<?php echo $_GET['id']; ?>&c=Nain&do=ChangeGroup" method="post">
        <select name="ngid">
            <?php
            
            foreach($groupes as $groupe)
            {
                ?><option value="<?php echo $groupe['g_id']; ?>">Groupe <?php echo $groupe['g_id'] ?></option><?php
            }
            
            ?>
            <option value="vacc">Envoyer en vaccances</option>
        </select>
        <input type="submit" value="Changer de groupe">
    </form>
</div>

<style type="text/css">
    .actionNain 
    {
         width: 40%;
        float: left;
        background-color: #ccc;
        padding: 10px;
        box-sizing: border-box;
    }
    
    .actionNain  h3
    {
        padding: 0;
        margin: 0;
        font-size: 2rem;
        color: #666;
        text-align: center;
    }
    
    .actionNain form , .actionNain form input , .actionNain form select
    {
        width: 90%;
        padding: 10px;
    }
</style>