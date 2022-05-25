const api_endpoint='https://www.cheapshark.com/api/1.0/games?title=';
const collegamento="https://www.cheapshark.com/redirect?dealID=";

const risultati_giochi=10;

function onResponse(response){  
    return response.json();
}


function ricerca_gioco(event){
    event.preventDefault();
    const testo=document.querySelector('#contenuto').value;
    const testoCodificato=encodeURIComponent(testo);

    richiesta= api_endpoint+testoCodificato+'&limit='+risultati_giochi;

    fetch("ApiStorePhp.php?q="+encodeURIComponent(richiesta)).then(onResponse).then(visualizza_giochi);
}


function visualizza_giochi(json){
    console.log(json);

    const giochi=document.querySelector('#giochi_shop');
    giochi.innerHTML="";

    if(json[0].content===false){
        const noElement=document.createElement('h1');
        noElement.textContent="Non ho trovato nessun gioco" ;
        giochi.appendChild(noElement);
    }
    
    else{
        for(let result of json){

            const negozio=document.createElement("img");
            negozio.classList.add("acquisto");

            if(result.carrello==true){
                
                negozio.src="./immagini/cestino.png";
                negozio.addEventListener('click',rimuoviCarrello);
    
            }else{
                
                negozio.src="./immagini/AggiungiCarrello.png";
                negozio.addEventListener('click',aggiungiCarrello);
            }
    
            
            

            const Container=document.createElement('div');

            const img=document.createElement('img');
            img.classList.add("img");
            const nomeGioco=document.createElement('a');
            const prezzo=document.createElement('p');
            const idGioco=document.createElement('u');
            idGioco.classList.add("hidden");

            idGioco.textContent=result.gameID;

            prezzo.textContent="$"+result.Prezzo;
            nomeGioco.textContent=result.Titolo;
            nomeGioco.href=collegamento+result.cheapestDealID;
            nomeGioco.target="_blank";
            img.src=result.Copertina;

            Container.appendChild(idGioco);
            Container.appendChild(img);
            Container.appendChild(nomeGioco);
            Container.appendChild(prezzo);
            Container.appendChild(negozio);
            giochi.appendChild(Container); 

        }

    }
}

function risali(){
    window.scroll({
        top: 250, 
        left: 0, 
        behavior: 'smooth'
      });
}






const form=document.querySelector('#ricerca');
form.addEventListener('submit',ricerca_gioco);