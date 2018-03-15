<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>Titre</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <link rel="icon" href="" type="image/x-icon">
<style type="text/css">
    *
    {
        margin: auto;
    }
    p{
        margin: 0;
        border-top:solid 1px #999;
    }
    #contain
    {
        max-height: 80vh;
        overflow: auto;
        width: 200px;
    }
    
    input
    {
        display: block;
        width: 200px;
        margin-bottom: 10px;
         margin-top: 10px;
    }
</style>
</head>
    
<body>

    <input type="text" id="input" placeholder="Search a French city...">

<script type="text/javascript">
    
    function empty_contain(contain)
    {
        if(contain!=null)
        {            
            contain.remove();
        }
        
        return true;
    }
    
    
    function getxhr() {
        var xhr = null;
        if( window.XMLHttpRequest ) { // Si l'objet XMLHttpRequest existe,
            xhr = new XMLHttpRequest;
        } else if( window.ActiveXObject ) { // Sinon (IE < 7), si l'objet ActiveXObject (propriétaire Microsoft) existe,
            try { // Si la version la plus récente de l'objet ActiveXObject existe,
                xhr = new ActiveXObject( 'Msxml2.XMLHTTP' );
            } catch( e ) { // Sinon,
                xhr = new ActiveXObject( 'Microsoft.XMLHTTP' ); // On utilise la première version
            }
        } else { // Sinon, l'objet n'est pas intégré (ou désactivé)
            alert( 'Votre navigateur ne supporte pas la technologie AJAX ! Veuillez le mettre à jour (comme tout le monde bande de glands).' );
        }
    
        return xhr;
    }
    
    var xhr = getxhr();
    
    function search_for(e)
    {
        if(empty_contain(document.getElementById("contain"))==true)
        {
            
        
        var search_value = e.target.value;
        
        if(search_value!="")
        {
            
        
        
        xhr.open( 'GET', 'search.php?s='+search_value, true );
        xhr.send( null );
        
        xhr.onreadystatechange = function ()
        {
            switch( xhr.readyState )
            {
                case 1:
                   console.log('Connexion établie'); 
                    break;
                case 2:
                  console.log('Requête reçue par le serveur');
                    break;
                case 3:
                  console.log('Requête en cours ...');
                    break;
                case 4:
                   console.log('Traitement de la requête terminée. Réponse disponible');
                    
                    if( xhr.status==200 )
                    {
                        
                         let contain = document.createElement('div');
                            contain.setAttribute('id' , 'contain');
                            console.log(document.body);
                            document.body.appendChild(contain);
                        
                       var response = JSON.parse(xhr.responseText); //assuming is not XML
                       if(response!==null)
                       {
                        
                            for(let ville of response)
                            {
                                 let contain = document.getElementById("contain");
                                 let p = document.createElement("p");
                                 p.setAttribute('class' , 'in_contain_ville');
                                 p.innerHTML = ville.ville_nom_reel;
                                 contain.appendChild(p);
                            }
                       }
                       else
                       {
                            let contain = document.getElementById("contain");
                            let p = document.createElement("p");
                            p.setAttribute('class' , 'no_ville');
                            p.innerHTML = "Pas de result";
                            contain.appendChild(p);
                       }
                       
                    }
                    else
                    {
                        alert( 'Une erreur est survenue' );
                        console.log( xhr.status + ' : ' + xhr.statusText );
                    }
                    break;            
           }            
        }
        }
        }
    }
    
    var input = document.getElementById('input');
    input.addEventListener('keyup' , search_for , true);
</script>
</body>
</html>
