<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: Login.php");
        exit;
    }
?>


<!DOCTYPE html>
    <html>
            <head>
                <title >GAME ZONE</title>
                <script src="apiShop.js" defer="true"></script>
                <script src="AggiungiRimuoviCarrello.js" defer="true"></script>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="HomePageCss.css"/>
                <link rel="stylesheet" href="ShopCss.css"/>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Caveat&display=swap" rel="stylesheet"> 
            </head>

            <body>

                <article>
                    <header> 
                            
                        
                    <nav>
                    
                        <div id="intestazione">
                            
                            <img id="titoloPagina" src="./immagini/logo.png"/>
                            
                            
                                <div id="menu">
                                    <a id="home"href=Home.php>Home</a>
                                    <a id="cerca"href=cercaGiochi.php>Cerca Giochi</a>
                                    <a id="preferiti" href=Preferiti.php>Preferiti</a>
                                    <a id="logout"href=phpDisconnect.php>Logout</a>
                                    

                                </div>
                        </div>
                       
                        <h1>
                            <strong>Rimani sempre aggioranto sul mondo dei videogames</strong><br/>
                        </h1>

                    </nav>


                    </header>
                    
                    <section>

                        <div id="titoloShop">
                            <h1><strong>Trova la migliore offerta per il tuo prossimo acquisto </strong></h1>
                        </div>

                        <div id="formShop"> 
                            <form id="ricerca">
                                <label id="label">Nome gioco: <input type='text' id='contenuto'></label>
                                <input id="cerca" type="submit" value="ricerca">
                            </form>
                        </div>

                        <div id="shop">
                        <img src="./immagini/carrello.PNG"/>
                        
                            <a href=Carrello.php>Carrello</a>
                        </div>

                        <div id="giochi_shop"> </div>
                    </section>

                    <footer>
                        
                        <p>Gioele Messina 1000002040<br/>A.A. 2021/2022</p>
                    </footer>
                </article>
            </body>
    </html>