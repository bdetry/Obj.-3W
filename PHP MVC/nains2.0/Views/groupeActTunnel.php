<div id="newTunnel" class="actionGrp">
    <h4>Changer de tunnel</h4>
    <form action="?id=<?php echo $gid; ?>&c=Group&do=ChangeTun" method="post">
        <select name="newTunnel">
            <?php
            foreach($tunnels as $tunnel)
            {
                ?><option value="<?php echo $tunnel['t_id']; ?>"><?php echo $tunnel['t_id']; ?></option><?php
            }
            ?>
        </select>
        <input type="submit" value="Changer">
    </form>
</div>