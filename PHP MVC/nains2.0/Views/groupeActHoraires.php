<div class="actionContainer">


<div id="newHoraires" class="actionGrp">
    <h4>Changer a NAINporte quelle heure</h4>
    <form action="./?id=<?php echo $gid; ?>&c=Group&do=ChangeHor" method="post">
        <input type="time" name="heureDebut"> a
        <input type="time" name="heureFin"><br>
        <input type="submit" value="Changer">
    </form>
</div>