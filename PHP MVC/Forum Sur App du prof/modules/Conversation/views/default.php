<style type="text/css">
@charset "UTF-8";

html
{
    font-size: 62.5%;
}

body
{
    margin: 0;
    background-color: #ddd;
}

h4
{
    margin-left: 10vw;
    padding: 5px;
    color: #666;
}

table
{
    width: 500px;
    text-align: center;
    border-collapse: collapse;
    margin-top: 20px;
    margin-bottom: 20px;
    margin-left: 10vw;
}

table td
{
    padding: 5px;
    font-size: 1.9rem;
    border: solid 1px #333;
    
}

.open
{
    background-color: #8fea90;
}

.closed
{
    background-color: #ea8f8f;
}

a
{
    color: #333;
    text-decoration: none;
}
    
</style>

<h4>Conversations</h4>

<?php

$all = $this->getClass();
echo "<table>";
echo "<tr>
                <td><strong>ID</strong></td>
                <td><strong>DATE</strong></td>
                <td><strong>HEURE</strong></td>
                <td><strong>Nb MSG</strong></td>
                <td><strong>Liens</strong></td>
            </tr>";
foreach($all as $key => $conv)
{    
    echo $conv;
    if($key==21)
     break;
}
echo "</table>";