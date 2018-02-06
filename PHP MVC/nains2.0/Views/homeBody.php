<main>
      <div class="homeContainer">
         <h2 style="color: #444;">Bienvenue sur la page principale du gestionaire des nains !!</h2>
         <a href="?c=Nain">Nains</a>
         <a href="?c=Ville">Villes</a>
         <a href="?c=Group">Groupes</a>
         <a href="?c=Taver">Tavernes</a>
      </div>
</main>

<style type="text/css">


body main
{
    width: 100%;
    height: 90vh;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
}

div.homeContainer
{
    width: 70%;
    height: 50vh;
    box-sizing: border-box;
}

div.homeContainer a
{
    width: 49%;
    height: 25vh;
    line-height: 25vh;
    display: block;
    float: left;
    text-align: center;
    background-color: #eee;
    border: solid 1px #ccc;
    text-decoration: none;
    color:  #443100;
    font-size: 2.5rem;
    font-weight: bold;
}

div.homeContainer a:hover
{    
    background-color: #fff;
    font-size: 2.6rem;
    text-decoration: underline;
}
</style>