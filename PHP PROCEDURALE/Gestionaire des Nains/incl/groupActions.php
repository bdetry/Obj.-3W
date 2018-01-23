<div id="newHoraires" class="actionGrp">
    <h4>Changer a NAINporte quelle heure</h4>
    <form action="?gid=<?php echo $_GET['gid']; ?>" method="post">
        <input type="time" name="heureDebut"> a
        <input type="time" name="heureFin"><br>
        <input type="hidden" name="gid" value="<?php echo $_GET['gid']; ?>">
        <input type="submit" value="Changer">
    </form>
</div>

<div id="newTunnel" class="actionGrp">
    <h4>Changer de tunnel</h4>
    <form action="?gid=<?php echo $_GET['gid']; ?>" method="post">
        <select name="newTunnel">
            <?php
            foreach(tunnel($bdd) as $tunnel)
            {
                ?><option value="<?php echo $tunnel['t_id']; ?>"><?php echo $tunnel['t_id']; ?></option><?php
            }
            ?>
        </select>
        <input type="hidden" name="gid" value="<?php echo $_GET['gid']; ?>">
        <input type="submit" value="Changer">
    </form>
</div>

<div id="newTaverne" class="actionGrp">
    <h4>Changer de taverne</h4>
        <form action="?gid=<?php echo $_GET['gid']; ?>" method="post">
        <select name="newTaverne">
            <?php
            foreach(taverne($bdd) as $taverne)
            {
                ?><option value="<?php echo $taverne['t_id']; ?>"><?php echo $taverne['t_nom']; ?></option><?php
            }
            ?>
        </select>
        <input type="hidden" name="gid" value="<?php echo $_GET['gid']; ?>">
        <input type="submit" value="Changer">
    </form>
     
     <?php
     
     if($errorNewTav==TRUE)
     {
      ?><span style=" display: block;font-size: 1.5rem; color: #bf617a; text-align: center; width: 100%;"> La taverne est pleine !!</span><?php
     }
     
     ?>
        
</div>