
const url="https://api.rawg.io/api/games?key=95623bb7f6264d6d866f005b8a61dc51&page_size=9";

function onResponse(response){  
    return response.json();
    
}

function ricerca_gioco(event){
    event.preventDefault();
    const genere=document.querySelector('#genere').value;
    const piattaforme=document.querySelector('#console').value;
    console.log(genere);
    console.log(piattaforme);
    const richiesta= url+'&genres='+genere+'&platforms='+piattaforme;

    fetch("ApiCercaGiochiPhp.php?q="+encodeURIComponent(richiesta)).then(onResponse).then(visualizza_giochi);
       

}

function visualizza_giochi(json){
    console.log(json);
    
    const elenco_giochi=document.querySelector('#elenco_giochi');
    elenco_giochi.innerHTML="";

    for(let risultato of json.json){

        const Container=document.createElement('div');
        const ContainerTesto=document.createElement('div');
        const img=document.createElement('img');
        const titolo=document.createElement('h1');
        const voto=document.createElement('p');
        const genere=document.createElement('p');
        const piattaforme=document.createElement('p');
        const preferiti=document.createElement("button");
        
        preferiti.classList.add("preferiti");

        

        if(risultato.preferiti==true){
            preferiti.textContent="Rimuovi dai preferiti";
            preferiti .addEventListener('click',rimuoviPreferiti);

        }else{
            preferiti.textContent="Aggiungi ai preferiti";
            preferiti .addEventListener('click',aggiungiPreferiti);
        }


        voto.textContent="Voto Metacritic: "+risultato.Voto+"/100";
        titolo.textContent=risultato.Titolo;
        img.src=risultato.Copertina;
        
        Container.appendChild(img);
        ContainerTesto.appendChild(titolo);
        ContainerTesto.appendChild(voto);

        genere.textContent="Genere:";

       for(gen of risultato.Genere){
            genere.textContent+=" /"+gen;
        }

        piattaforme.textContent="Piattaforme:"
        
        for(consol of risultato.Console){
            piattaforme.textContent+="/ "+consol;
        }
        
        ContainerTesto.appendChild(genere);
        ContainerTesto.appendChild(piattaforme);
        Container.appendChild(ContainerTesto);
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
    fetch("ApiCercaGiochiPhp.php?q="+encodeURIComponent($successivo.url)).then(onResponse).then(visualizza_giochi);
    
}


function paginaPrecedente(event){
    $precedente=document.querySelector("#precedente");
     
    window.scroll({
        top: 250, 
        left: 0, 
        behavior: 'smooth'
      });  
    fetch("ApiCercaGiochiPhp.php?q="+encodeURIComponent($precedente.url)).then(onResponse).then(visualizza_giochi);
    
}




const form=document.querySelector('#form');
form.addEventListener("submit",ricerca_gioco);

