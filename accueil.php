<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./public/style.css">
    <script src="./js/script.js"></script>
    <title>MyCinema_PHP</title>
</head>



<body>
        <!--------------------------------------------------------  FORMULAIRES ------------------------------------------------------------------>
        <!-- Recherche de film par genre/distributeur/nom/date de projection -->
        <div class="search">
            <form class="search_form" action="accueil.php" method="post">
                <label class="margined title" for="search_film">Recherche de film : </label>
                <input class="margined" type="text" id="search_film" name="nom" placeholder="Titre du film">


                <!-- SELECT GENRE -->
                <select  class="genre_select" name="genre">
                    <option class="fond_noir fond" id="selection" value="">&nbsp; Sélectionnez un genre :</option>
                    <option class="fond_noir fond" value="Action">&nbsp; Action</option>
                    <option class="fond_noir fond" value="Adventure">&nbsp; Adventure</option>
                    <option class="fond_noir fond" value="Animation">&nbsp; Animation</option>
                    <option class="fond_noir fond" value="Biography">&nbsp; Biography</option>
                    <option class="fond_noir fond" value="Comedy">&nbsp; Comedy</option>
                    <option class="fond_noir fond" value="Crime">&nbsp; Crime</option>
                    <option class="fond_noir fond" value="Drama">&nbsp; Drama</option>
                    <option class="fond_noir fond" value="Family">&nbsp; Family</option>
                    <option class="fond_noir fond" value="Fantasy">&nbsp; Fantasy</option>
                    <option class="fond_noir fond" value="Horror">&nbsp; Horror</option>
                    <option class="fond_noir fond" value="Mistery">&nbsp; Mistery</option>
                    <option class="fond_noir fond" value="Romance">&nbsp; Romance</option>
                    <option class="fond_noir fond" value="Sci-fi">&nbsp; Sci-fi</option>
                    <option class="fond_noir fond" value="Thriller">&nbsp; Thriller</option>Drama
                </select>


                <input class="margined_top" type="text" id="search_film" name="distributeur"
                    placeholder="Distributeur">
                <p class="padding_p title">Format date : <span class="red">01-01-1111<span></p>
                <input class="margined_bot" type="text" id="search_film" name="date_de_projection"
                    placeholder="Date de projection">
                <input class="margined rechercher" type="submit" value="Rechercher">
            </form>


            <!-- Recherche de membre par nom et/ou prénom -->
            <!-- interface afin d'intervenir sur l'abonnement (ajouter, supprimer, modifier) -->
            <form class="search_form" action="accueil.php" method="post">
                <label class="margined title" for="search_member">Recherche client : </label>
                <input class="margined" type="text" id="search_member" name="search_member_by_first_name" placeholder="Prénom">
                <input class="margined" type="text" id="search_member" name="search_member_by_last_name" placeholder="Nom">
                <input class="margined rechercher" type="submit" value="Rechercher">
            </form>


            <!-- Recherche de l'historique du membre -->
            <!-- interface d'ajout à l'historique ( film vu aujourd'hui) -->
            <form class="search_form" action="accueil.php" method="post">
                <label class="margined title" for="search_hist">Historique du client : </label>
                <input class="margined" type="text" id="search_hist" name="search_hist_by_first_name" placeholder="Prénom">
                <input class="margined" type="text" id="search_hist" name="search_hist_by_last_name" placeholder="Nom">
                <input class="margined rechercher" type="submit" value="Rechercher">
            </form>


            <!-- interface d'ajout de séance pour un film -->
            <form class="search_form" action="accueil.php" method="post">
                <label class="margined title" for="add_session">Ajouter une séance : </label>
                <input class="margined" type="text" id="add_session" name="add_session" placeholder="Nom du film">
                <input class="margined rechercher" type="submit" value="Rechercher">
            </form>
        </div>

        <!-- Lecteur musique -->
        <div class="audio">
            <p class="txt_audio_">
                Penny Dreadful - Soundtrack - Main Theme - Abel Korzeniowski
            </p>
            <div class="icons">
                <button class="btn-music-play">
                    <img class="play" src="./public/assets/play.png" alt="" width="50px" height="50px">
                </button>
                <audio id="my-audio" src="./public/assets/penny_dreadfull.mp3"></audio>
                <button class="btn-music-pause">
                    <img class="pause" src="./public/assets/pause.png" alt="" width="50px" height="50px">
                </button>
                <button class="btn-music-stop">
                    <img class="stop" src="./public/assets/stop.png" alt="" width="50px" height="50px">
                </button>
            </div>
            <div class="txt_audio_">
                <p class='txt_audio'></p>
            </div>
        </div>

<!-------------------------------------------------------- ZONE D'AFFICHAGE DES RESULTATS ------------------------------------------------------------------>
        <div class="result_display">
            <div class="grey_zone">

                <?php
                    include("search_by_name_only.php");
                    $_POST = array();
                ?>
                    
            </div>
            <div class="btn_div">
                <button id="load-button">
                    <img class="load_btn"src="./public/assets/plus.png" alt="" width="40px" height="40px">
                </button>
            </div>
        </div>

</body>
</html>