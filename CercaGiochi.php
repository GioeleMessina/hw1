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
                
                <script src="AggiungiRimuoviPreferiti.js" defer="true"></script>
                <script src="ApiCercaGiochi.js" defer="true"></script>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="HomePageCss.css"/>
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
                                    <a id="preferiti" href=Preferiti.php>Preferiti</a>
                                    <a id="shop"href=Shop.php>Shop</a>
                                    <a id="logout"href=phpDisconnect.php>Logout</a>
                                        

                                </div>
                            </div>
                        
                            <h1>
                                <strong>Rimani sempre aggioranto sul mondo dei videogames</strong><br/>
                            </h1>

                        </nav>


                    </header>
                    
                    <section>
                        <div id="titoloCercaGiochi">
                            <h1><strong>Non sai a cosa giocare? Prendi spunto da qui per il tuo prossimo gioco </strong></h1>
                        </div>

                        <form id="form">
                            Genere:
                            <select id="genere" name='genere'>
                                <option value='action'>Azione</option>
                                <option value='adventure'>Avventura</option>
                                <option value='role-playing-games-rpg'>RPG</option>
                                <option value='shooter'>Sparatutto</option>
                                <option value='puzzle'>Puzzle</option>
                                <option value='strategy'>Strategia</option>
        
                            </select>
        
                            Console:
                            <select id="console" name='console'>   
                                <option value='4'>PC</option>
                                <option value='1'>Xbox One</option>
                                <option value='186'>Xbox Series S/X</option>
                                <option value='14'>Xbox 360</option>
                                <option value='18'>PlayStation 4</option>
                                <option value='187'>PlayStation 5</option>
                                <option value='7'>Nintendo Switch </option>
                                
                            </select>
                            
                            <label>&nbsp;<input id="submit" type='submit'  ></label>

                        </form>

                        <div id="elenco_giochi"> </div>

                        <div id="bottoni">
                            <a id="precedente" class="hidden" >Precedente</a>
                            <a id="successivo" class="hidden">Successivo</a>
                            
                        </div>

                    </section>

                    <footer>
                        <p>Gioele Messina 1000002040<br/>A.A. 2021/2022</p>
                    </footer>
                    
                </article>
                

            </body>
</html>

