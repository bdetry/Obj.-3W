<!DOCTYPE html>
    
<html lang="en">
<head>
   <title>LISTE CHIANEES JS _ PAYS DEP VILLE</title>
   <meta type="description" content="">
   <meta charset="UTF-8">
   <link rel="icon" href="" type="image/x-icon">
</head>
    
<body>
    
    <script type="text/javascript">
        
    </script>
    
    <form method="post" id="form" data-href="/ver/ajax.php" data-method="post"></form>
    
    <script type="text/javascript">
        function getXHR()
        {
                var xhr = null;

                if( window.XMLHttpRequest ) {
                    xhr = new XMLHttpRequest();
                } else if( window.ActiveXObject ) {
                    try {
                        xhr = new ActiveXObject( 'Msxml2.XMLHTTP' );
                    } catch ( e ) {
                        xhr = new ActiveXObject( 'Microsoft.XMLHTTP' );
                    }
                } else {
                    alert( 'Votre navigateur ne supporte pas la technologie AJAX.' );
                }

                return xhr;
        }
        
        var form = document.getElementById('form');
        var optin = document.createElement('select');
        optin.setAttribute('id' , 'pays');
        optin.setAttribute('name' , 'pays');
        
        function create_city_list(dep_id , xhr)
        {
            
            var list_sup_ini = document.getElementById('city');
            if(list_sup_ini!==null)
            {
                form.removeChild(list_sup_ini);
            }
            
            if(dep_id.length==1)
            {
                dep_id = "0"+dep_id;
            }
            
            console.log(dep_id);
            
            xhr.open( 'GET', 'php/db3.php?dep='+dep_id, true );
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
                           var citys = JSON.parse(xhr.responseText);
                           var optin_city;
                           if(citys!==null)
                           {
                                if(form.querySelectorAll('#city').length==0)
                                {
                                    optin_city = document.createElement('select');
                                    optin_city.setAttribute('id' , 'city');
                                    optin_city.setAttribute('name' , 'city');
                                    form.appendChild(optin_city);  
                                }
                            
                                let first_select = document.createElement('option');
                                first_select.setAttribute('value', "");
                                first_select.innerHTML = "...";
                                
                                
                                if(form.querySelectorAll('#city').length!=0)
                                {
                                    optin_city.appendChild(first_select);
                                    console.log(citys);
                                   for(let city of citys)
                                    {
                                        let temp_select = document.createElement('option');
                                        temp_select.setAttribute('value', city.ville_id);
                                        temp_select.setAttribute('class', 'city_select');                                
                                        temp_select.innerHTML =  city.ville_nom_reel;
                                        optin_city.appendChild(temp_select);
                                       
                                    }
                                }
                                console.log("City affiches");
                           }
                           else                           
                           {
                                if(form.querySelectorAll('#city').length!=0)
                                {
                                    optin_dep = form.querySelectorAll('#city');
                                    optin_dep[0].remove();                                    
                                    console.log("Pas de villes");
                                }
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
        
        
        
        
        function create_dep_list(ville_id , xhr)
        {
            xhr.open( 'GET', 'php/db2.php?ville='+ville_id, true );
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
                           var deps = JSON.parse(xhr.responseText);
                           var optin_dep;
                           if(deps!==null)
                           {
                                if(form.querySelectorAll('#deps').length==0)
                                {
                                    optin_dep = document.createElement('select');
                                    optin_dep.setAttribute('id' , 'deps');
                                    optin_dep.setAttribute('name' , 'deps');
                                    form.appendChild(optin_dep);  
                                }
                            
                                let first_select = document.createElement('option');
                                first_select.setAttribute('value', "");
                                first_select.innerHTML = "...";
                                
                                
                                if(form.querySelectorAll('#deps').length!=0)
                                {
                                    optin_dep.appendChild(first_select);
                                    optin_dep.addEventListener('change' , get_from_db_ville, true);
                                    
                                   for(let dep of deps)
                                    {
                                        let temp_select = document.createElement('option');
                                        temp_select.setAttribute('value', dep.departement_id);
                                        temp_select.setAttribute('class', 'dep_select');                                
                                        temp_select.innerHTML =  dep.departement_nom;
                                        optin_dep.appendChild(temp_select);
                                       
                                    }
                                }
                                console.log("Deps affiches");
                           }
                           else                           
                           {
                                if(form.querySelectorAll('#deps').length!=0)
                                {
                                    optin_dep = form.querySelectorAll('#deps');
                                    optin_dep[0].remove();                                    
                                    console.log("Pas de departement");
                                }
                           }
                           
                           var list_sup_ini = document.getElementById('city');
                            if(list_sup_ini!==null)
                            {
                                form.removeChild(list_sup_ini);
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
        
        const  get_from_db_ville = function ( e )
        {
            var xhr = getXHR();
            var dep_id = e.target.value;
            create_city_list(dep_id , xhr);
        }
        
        const get_from_db_dep = function ( e )
        {
            var xhr = getXHR();
            var ville_id = e.target.value;
            create_dep_list(ville_id , xhr);
        }
                
        function get_from_db_country( xhr )
        {
            xhr.open( 'GET', 'php/db.php', true );
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
                           var pays = JSON.parse(xhr.responseText);
                           
                        let first_select = document.createElement('option');
                        first_select.setAttribute('value', "");
                        first_select.innerHTML = "...";
                        optin.appendChild(first_select);
                        optin.addEventListener('change' , get_from_db_dep, true);   
                           for(let pay of pays)
                           {
                                let temp_select = document.createElement('option');
                                temp_select.setAttribute('value', pay.pays_id);
                                temp_select.setAttribute('class', 'pays_select');                                
                                temp_select.innerHTML =  pay.pays_nom;                                
                                
                                optin.appendChild(temp_select);
                           }
                           console.log("Pays affiches");
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
        
        
        form.appendChild(optin); 
        document.body.addEventListener('load' , get_from_db_country(getXHR()) , true);
    </script>
    
</body>
</html>
