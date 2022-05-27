const end_point="https://api.rawg.io/api/games?key=95623bb7f6264d6d866f005b8a61dc51&metacritic=90,100&page_size=12";


function onResponse(response){
    console.log(response);
    return response.json();
}



function onJson(json){
    
    console.log(json);
    const elenco_giochi=document.querySelector('#ricerca_giochi');
    
    elenco_giochi.innerHTML="";

    for(let risultato of json.json){
        
        const Container=document.createElement('div');
        const ContainerTesto=document.createElement('div');
        const img=document.createElement('img');
        const titolo=document.createElement('h1');
        const voto=document.createElement('p');

        voto.textContent="Voto Metacritic: "+risultato.Voto+"/100";
        titolo.textContent=risultato.Titolo;
        img.src=risultato.Copertina;

        Container.appendChild(img);
        ContainerTesto.appendChild(titolo);
        ContainerTesto.appendChild(voto);
        Container.appendChild(ContainerTesto);

        const preferiti=document.createElement("button");
        preferiti.classList.add("preferiti");

        if(risultato.preferiti==true){
            preferiti.textContent="Rimuovi dai preferiti";
            preferiti .addEventListener('click',rimuoviPreferiti);

        }else{
            preferiti.textContent="Aggiungi ai preferiti";
            preferiti .addEventListener('click',aggiungiPreferiti);
        }

        Container.appendChild(preferiti);
        elenco_giochi.appendChild(Container);   
        
    }

    if(json.PagSucc!==null){
        const successivo=document.querySelector("#successivo");
        successivo.classList.add("attivo");
        successivo.url=json.PagSucc;
        successivo.addEventListener("click",paginaSuccessiva);
        
    }else{
        const successivo=document.querySelector("#successivo");
        successivo.classList.remove("attivo");
        successivo.classList.add("hidden");
    }

    if(json.PagPrecc!==null){
        const precedente=document.querySelector("#precedente");
        precedente.classList.add("attivo");
        precedente.url=json.PagPrecc;
        precedente.addEventListener("click",paginaPrecedente);
    }else{
        const precedente=document.querySelector("#precedente");
        precedente.classList.remove("attivo");
        precedente.classList.add("hidden");
    }
}

function paginaSuccessiva(event){
    $successivo=document.querySelector("#successivo");   
    window.scroll({
        top: 250, 
        left: 0, 
        behavior: 'smooth'
      });
    fetch("ApiHomePagePhp.php?q="+encodeURIComponent($successivo.url)).then(onResponse).then(onJson);
    
}


function paginaPrecedente(event){
    $precedente=document.querySelector("#precedente"); 
    window.scroll({
        top: 250, 
        left: 0, 
        behavior: 'smooth'
      });
    fetch("ApiHomePagePhp.php?q="+encodeURIComponent($precedente.url)).then(onResponse).then(onJson);
    
}



fetch("ApiHomePagePhp.php?q="+encodeURIComponent(end_point)).then(onResponse).then(onJson);



