<?php
// CONNECTION A LA DATABASE
$servername = "mysql:host=localhost;dbname=cinema";
$username = "raoulbajj";
$password = "Dracaufeu123";
$db = new PDO($servername, $username, $password);



// ------------------------------------------------------- RECHERCHE DE FILMS ----------------------------------------------------------------------------
// Affichage des résultats en fonction de si le client a effectué ou non une recherche
if (empty($_POST['nom']) && empty($_POST['genre']) && empty($_POST['distributeur']) && empty($_POST['date_de_projection']) && empty($_POST["search_member_by_first_name"]) && empty($_POST["search_member_by_last_name"]) && empty($_POST["search_hist_by_first_name"]) && empty($_POST["search_hist_by_last_name"]))
{
    echo '
    <script>
    const div_result = document.getElementsByClassName("result_display");
    div_result[0].classList.add("active");
    </script>';
}
else 
{
    echo '
    <script>
    const div_result = document.getElementsByClassName("result_display");
    div_result[0].classList.remove("active"); 
    </script>';
}

// Si le client a rentré seulement un nom de film et rien d'autre alors effectue ce code : 
if (!empty($_POST['nom']) && empty($_POST['genre']) && empty($_POST['distributeur']) && empty($_POST['date_de_projection']))
{
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination - nombre de résultat trouvés :
    $query_ = $db->prepare(
    'SELECT title FROM movie WHERE title LIKE :movie_title');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }

    if($i <= 1)
    {
        echo "<div class='result_nbr'><span class='nbr_result'>" . $i . "</span>&nbsp;résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'><span class='nbr_result'>" . $i . "</span>&nbsp;résultats trouvés :</div>";
    }


    // Résultat
    $query = $db->prepare('SELECT title FROM movie WHERE title LIKE :movie_title');
    $query->bindValue(':movie_title', '%'.$array_name.'%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach($result as $key)
    {
    echo "<div class='display_result'>$key[0]." . "<br></div>";
    }

} 

// si le client n'entre que le genre :
if (empty($_POST['nom']) && !empty($_POST['genre']) && empty($_POST['distributeur']) && empty($_POST['date_de_projection'])) 
{

    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
    'SELECT genre.genre_name, movie.title from movie_genre
    join genre on movie_genre.id_genre = genre.id
    join movie on movie_genre.id_movie = movie.id
    WHERE movie.title LIKE :movie_title AND genre.genre_name = :movie_genre');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;

    foreach($result_pagination as $key)
    {
        $i++;
    }

    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }

    // Requête de base
    $query = $db->prepare(
    'SELECT genre.genre_name, movie.title from movie_genre
    join genre on movie_genre.id_genre = genre.id
    join movie on movie_genre.id_movie = movie.id
    WHERE movie.title LIKE :movie_title AND genre.genre_name = :movie_genre');

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) 
    {
        echo "<div class='display_result'>Titre : $key[title] <br> ";
        echo "Genre : </strong>$key[genre_name]</div>";
    }
}

// Si le client a rentré le nom + le genre = effectue ce code :
if (!empty($_POST['nom']) && !empty($_POST['genre']) && empty($_POST['distributeur']) && empty($_POST['date_de_projection'])) 
{
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
    'SELECT movie_genre.id_movie, genre.genre_name, movie.title from movie_genre
    join genre on movie_genre.id_genre = genre.id
    join movie on movie_genre.id_movie = movie.id
    WHERE movie.title LIKE :movie_title AND genre.genre_name = :movie_genre');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }

        if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }

    $query = $db->prepare(
    'SELECT movie_genre.id_movie, genre.genre_name, movie.title from movie_genre
    join genre on movie_genre.id_genre = genre.id
    join movie on movie_genre.id_movie = movie.id
    WHERE movie.title LIKE :movie_title AND genre.genre_name = :movie_genre');

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) 
    {
        echo "<div class='display_result'>Titre : $key[2] <br> ";
        echo "Genre : </strong>$key[1]</div>";
    }   
}

// Si le client a rentré le nom + le distributeur = effectue ce code :
if (!empty($_POST['nom']) && empty($_POST['genre']) && !empty($_POST['distributeur']) && empty($_POST['date_de_projection'])) 
{
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];
    
    // // Pagination
    $query_ = $db->prepare(
    'SELECT distributor.id, distributor.name, movie.title, movie.id_distributor from distributor
    INNER JOIN movie ON movie.id_distributor = distributor.id
    WHERE movie.title LIKE :movie_title AND distributor.name LIKE :movie_distributeur');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }
    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }

    // Requête de base
    $query = $db->prepare(
    'SELECT distributor.id, distributor.name, movie.title, movie.id_distributor from distributor
    INNER JOIN movie ON movie.id_distributor = distributor.id
    WHERE movie.title LIKE :movie_title AND distributor.name LIKE :movie_distributeur'
    );
    
    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();
    
    
    foreach ($result as $key) {
        echo "<div class='display_result'>Titre : $key[title] <br> ";
        echo "Distributeur : </strong>$key[name]</div>";
    }
}

// Si le client a rentré seulement le distributeur = effectue ce code :
if (empty($_POST['nom']) && empty($_POST['genre']) && !empty($_POST['distributeur']) && empty($_POST['date_de_projection'])) 
{

    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
    'SELECT distributor.id, distributor.name, movie.title, movie.id_distributor from distributor
    INNER JOIN movie ON movie.id_distributor = distributor.id
    WHERE movie.title LIKE :movie_title AND distributor.name LIKE :movie_distributeur');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }
    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }


    
    $query = $db->prepare(
    'SELECT distributor.id, distributor.name, movie.title, movie.id_distributor from distributor
    INNER JOIN movie ON movie.id_distributor = distributor.id
    WHERE movie.title LIKE :movie_title AND distributor.name LIKE :movie_distributeur'
    );

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) 
    {
        echo "<div class='display_result'>Titre : $key[2] <br> ";
        echo "Distributeur : </strong>$key[1]</div>";
    }
}

// si le client a rentré nom + genre + distributeur :
if (!empty($_POST['nom']) && !empty($_POST['genre']) && !empty($_POST['distributeur']) && empty($_POST['date_de_projection'])) 
{
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
    'SELECT movie_genre.id_movie, genre.genre_name, movie.title, distributor.id, distributor.name, movie.id_distributor from movie_genre 
    join genre on movie_genre.id_genre = genre.id 
    join movie on movie_genre.id_movie = movie.id
    join distributor on movie.id_distributor = distributor.id
    WHERE movie.title LIKE :movie_title AND genre.genre_name LIKE :movie_genre AND distributor.name LIKE :movie_distributeur');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query_->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }

    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }



    $query = $db->prepare(

    'SELECT movie_genre.id_movie, genre.genre_name, movie.title, distributor.id, distributor.name, movie.id_distributor from movie_genre 
    join genre on movie_genre.id_genre = genre.id 
    join movie on movie_genre.id_movie = movie.id
    join distributor on movie.id_distributor = distributor.id
    WHERE movie.title LIKE :movie_title AND genre.genre_name LIKE :movie_genre AND distributor.name LIKE :movie_distributeur');

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) 
    {
        echo "<div class='display_result'>Titre : $key[title] <br> ";
        echo "Genre : </strong>$key[genre_name]<br>";
        echo "Distributeur : </strong>$key[name]</div>";
    }
}

// Si le client a rentré la date de projection
if (empty($_POST['nom']) && empty($_POST['genre']) && empty($_POST['distributeur']) && !empty($_POST['date_de_projection'])) {
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
    'SELECT movie_schedule.date_begin, movie.title FROM movie_schedule
    JOIN movie on movie_schedule.id_movie = movie.id
    WHERE movie.title LIKE :movie_title AND movie_schedule.date_begin LIKE :date_de_projection');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }

    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }




    $query = $db->prepare(
    'SELECT movie_schedule.date_begin, movie.title FROM movie_schedule
    JOIN movie on movie_schedule.id_movie = movie.id
    WHERE movie.title LIKE :movie_title AND movie_schedule.date_begin LIKE :date_de_projection'
    );

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) {
        echo "<div class='display_result'>Titre : $key[title] <br> ";
        echo "Date de projection : </strong>$key[date_begin]</div>";
    }
}

// Si le client a rentré le nom + la date de projection
if (!empty($_POST['nom']) && empty($_POST['genre']) && empty($_POST['distributeur']) && !empty($_POST['date_de_projection'])) {
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
    'SELECT movie_schedule.date_begin, movie.title FROM movie_schedule
    JOIN movie on movie_schedule.id_movie = movie.id
    WHERE movie.title LIKE :movie_title AND movie_schedule.date_begin LIKE :date_de_projection');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }

    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }





    $query = $db->prepare(
    'SELECT movie_schedule.date_begin, movie.title FROM movie_schedule
    JOIN movie on movie_schedule.id_movie = movie.id
    WHERE movie.title LIKE :movie_title AND movie_schedule.date_begin LIKE :date_de_projection'
    );

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) {
        echo "<div class='display_result'>Titre : $key[title] <br> ";
        echo "Date de projection : </strong>$key[date_begin]</div>";
    }
}

// Si le client a rentré nom + genre + distributeur + date de projection
if (!empty($_POST['nom']) && !empty($_POST['genre']) && !empty($_POST['distributeur']) && !empty($_POST['date_de_projection'])) 
{
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
    'SELECT movie_genre.id_movie, genre.genre_name, movie.title, distributor.id, distributor.name,
    movie.id_distributor, movie_schedule.id_movie, movie_schedule.date_begin from movie_genre 

    join genre on movie_genre.id_genre = genre.id 
    join movie on movie_genre.id_movie = movie.id 
    join movie_schedule on movie.id = movie_schedule.id_movie 
    join distributor on movie.id_distributor = distributor.id 

    WHERE movie.title LIKE :movie_title 
    AND genre.genre_name LIKE :movie_genre 
    AND distributor.name LIKE :movie_distributeur 
    AND movie_schedule.date_begin LIKE :date_de_projection');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query_->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query_->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }

    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }




    $query = $db->prepare(

    'SELECT movie_genre.id_movie, genre.genre_name, movie.title, distributor.id, distributor.name,
    movie.id_distributor, movie_schedule.id_movie, movie_schedule.date_begin from movie_genre 

    join genre on movie_genre.id_genre = genre.id 
    join movie on movie_genre.id_movie = movie.id 
    join movie_schedule on movie.id = movie_schedule.id_movie 
    join distributor on movie.id_distributor = distributor.id 

    WHERE movie.title LIKE :movie_title 
    AND genre.genre_name LIKE :movie_genre 
    AND distributor.name LIKE :movie_distributeur 
    AND movie_schedule.date_begin LIKE :date_de_projection');

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key)
    {
        {
            echo "<div class='display_result'>Titre : $key[title]<br>";
            echo "Genre : </strong>$key[genre_name]<br>";
            echo "Distributeur : </strong>$key[name]<br>";
            echo "Date de projection : </strong>$key[date_begin]</div>";
        }
    }
    // Titre : The Accountant
    // Genre : Action
    // Distributeur : Warner Bros.
    // Date de projection : 2018-01-01 21:00:00
}

// Si le client a rentré genre + distributeur :
if (empty($_POST['nom']) && !empty($_POST['genre']) && !empty($_POST['distributeur']) && empty($_POST['date_de_projection'])) 
{
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
    'SELECT movie_genre.id_movie, genre.genre_name, movie.title, distributor.id, distributor.name, movie.id_distributor from movie_genre 
    join genre on movie_genre.id_genre = genre.id 
    join movie on movie_genre.id_movie = movie.id
    join distributor on movie.id_distributor = distributor.id
    WHERE movie.title LIKE :movie_title AND genre.genre_name LIKE :movie_genre AND distributor.name LIKE :movie_distributeur');

    $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query_->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query_->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
    
    foreach($result_pagination as $key)
    {
        $i++;
    }

    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }



    $query = $db->prepare(

    'SELECT movie_genre.id_movie, genre.genre_name, movie.title, distributor.id, distributor.name, movie.id_distributor from movie_genre 
    join genre on movie_genre.id_genre = genre.id 
    join movie on movie_genre.id_movie = movie.id
    join distributor on movie.id_distributor = distributor.id
    WHERE movie.title LIKE :movie_title AND genre.genre_name LIKE :movie_genre AND distributor.name LIKE :movie_distributeur');

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) 
    {
        echo "<div class='display_result'>Titre : $key[title] <br> ";
        echo "Genre : </strong>$key[genre_name]<br>";
        echo "Distributeur : </strong>$key[name]</div>";
    }
}

// Si le client a rentré genre + date :
if (empty($_POST['nom']) && !empty($_POST['genre']) && empty($_POST['distributeur']) && !empty($_POST['date_de_projection'])) 
{
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

        // Pagination
        $query_ = $db->prepare(
            'SELECT movie.title, movie.id, movie_genre.id_movie, movie_genre.id_genre, 
            genre.genre_name, genre.id, movie_schedule.id_movie, movie_schedule.date_begin FROM movie
        
            JOIN movie_genre ON movie.id = movie_genre.id_movie
            JOIN genre ON movie_genre.id_genre = genre.id
            JOIN movie_schedule ON movie.id = movie_schedule.id_movie
        
            WHERE movie.title LIKE :movie_title AND genre.genre_name LIKE :movie_genre AND movie_schedule.date_begin LIKE :date_de_projection');

            $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
            $query_->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
            $query_->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
            $query_->execute();
            $result_pagination = $query_->fetchAll();
            static $i = 0;
            
            foreach($result_pagination as $key)
            {
                $i++;
            }
        
            if($i <= 1)
            {
                echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
            }
            else
            {
                echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
            }




    $query = $db->prepare(

    'SELECT movie.title, movie.id, movie_genre.id_movie, movie_genre.id_genre, 
    genre.genre_name, genre.id, movie_schedule.id_movie, movie_schedule.date_begin FROM movie

    JOIN movie_genre ON movie.id = movie_genre.id_movie
    JOIN genre ON movie_genre.id_genre = genre.id
    JOIN movie_schedule ON movie.id = movie_schedule.id_movie

    WHERE movie.title LIKE :movie_title AND genre.genre_name LIKE :movie_genre AND movie_schedule.date_begin LIKE :date_de_projection');

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_genre', $array_genre, PDO::PARAM_STR);
    $query->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) 
    {
        echo "<div class='display_result'>Titre : $key[title]<br>";
        echo "Genre : </strong>$key[genre_name]<br>";
        echo "Date de projection : </strong>$key[date_begin]</div>";
    }
}

// Si le client à rentré distributeur + date :
if (empty($_POST['nom']) && empty($_POST['genre']) && !empty($_POST['distributeur']) && !empty($_POST['date_de_projection'])) 
{
    $array_name = $_POST['nom'];
    $array_genre = $_POST['genre'];
    $array_distributeur = $_POST['distributeur'];
    $array_date_de_projection = $_POST['date_de_projection'];

    // Pagination
    $query_ = $db->prepare(
        'SELECT movie.title, movie.id, movie_schedule.id_movie, distributor.name, distributor.id, movie_schedule.date_begin from movie 

        join movie_schedule ON movie.id = movie_schedule.id_movie
        join distributor ON movie.id_distributor = distributor.id
        
        WHERE movie.title LIKE :movie_title AND movie_schedule.date_begin LIKE :date_de_projection AND distributor.name LIKE :movie_distributeur');

        $query_->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
        $query_->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
        $query_->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
        $query_->execute();
        $result_pagination = $query_->fetchAll();
        static $i = 0;
        
        foreach($result_pagination as $key)
        {
            $i++;
        }
    
        if($i <= 1)
        {
            echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
        }
        else
        {
            echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
        }




    $query = $db->prepare(

    'SELECT movie.title, movie.id, movie_schedule.id_movie, distributor.name, distributor.id, movie_schedule.date_begin from movie 

    join movie_schedule ON movie.id = movie_schedule.id_movie
    join distributor ON movie.id_distributor = distributor.id
    
    WHERE movie.title LIKE :movie_title AND movie_schedule.date_begin LIKE :date_de_projection AND distributor.name LIKE :movie_distributeur');

    $query->bindValue(':movie_title', '%' . $array_name . '%', PDO::PARAM_STR);
    $query->bindValue(':movie_distributeur', '%' . $array_distributeur . '%', PDO::PARAM_STR);
    $query->bindValue(':date_de_projection', strval($array_date_de_projection) . '%', PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $key) 
    {
        echo "<div class='display_result'>Titre : $key[title]<br>";
        echo "Distributeur : $key[name]<br>";
        echo "Date de projection : $key[date_begin]</div>";
    }
}


// -------------------------------------------------------- RECHERCHE DE CLIENT --------------------------------------------------------------------------

// si le prénom est rempli
if (!empty($_POST["search_member_by_first_name"]) && empty($_POST["search_member_by_last_name"]) ) 
{
    $array_first_name = $_POST["search_member_by_first_name"];

    // Pagination
    $query_ = $db->prepare(
    'SELECT * FROM user WHERE user.firstname LIKE :client_first_name');

    $query_->bindValue(':client_first_name', '%' . $array_first_name . '%', PDO::PARAM_STR);

    $query_->execute();
    $result_pagination = $query_->fetchAll();
    static $i = 0;
        
    foreach($result_pagination as $key)
    {
        $i++;
    }
    
    if($i <= 1)
    {
        echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
    }
    else
    {
        echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
    }

    $query = $db->prepare(

        'SELECT * FROM user WHERE user.firstname LIKE :client_first_name');
    
        $query->bindValue(':client_first_name', '%' . $array_first_name . '%', PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $key) 
        {
            $_GET['id'] = "$key[id]";          

            echo "<div class='display_result'>ID client : $key[id]<br>";
            echo "Adresse email : $key[email]<br>";
            echo "Prénom : $key[firstname]<br>";
            echo "Nom : $key[lastname]<br>";
            echo "Adresse : $key[address]<br>";
            echo "Code postal : $key[zipcode]<br>";
            echo "Ville : $key[city]<br>";
            echo "<div class='user_right'><div>Pays : $key[country]</div><a class='user_profile' href='user_profile.php?id=$_GET[id]'><button class='btn_profil_user'>User profile</button></a></div></div>";
        }

        if(empty($result))
        {
        echo "<div class='display_result'>Aucun résultat trouvé pour " . '" ' . $array_first_name . '" ';
        }

        $_POST = array();
}

// si le nom est rempli
if (empty($_POST["search_member_by_first_name"]) && !empty($_POST["search_member_by_last_name"]) ) 
{
    $array_last_name = $_POST["search_member_by_last_name"];

    // Pagination
    $query_ = $db->prepare(
        'SELECT * FROM user WHERE user.lastname LIKE :client_last_name');
    
        $query_->bindValue(':client_last_name', '%' . $array_last_name . '%', PDO::PARAM_STR);
    
        $query_->execute();
        $result_pagination = $query_->fetchAll();
        static $i = 0;
            
        foreach($result_pagination as $key)
        {
            $i++;
        }
        
        if($i <= 1)
        {
            echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
        }
        else
        {
            echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
        }




    $query = $db->prepare(

        'SELECT * FROM user WHERE user.lastname LIKE :client_last_name');
    
        $query->bindValue(':client_last_name', '%' . $array_last_name . '%', PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $key) 
        {
            $_GET['id'] = "$key[id]";           

            echo "<div class='display_result'>ID client : $key[id]<br>";
            echo "Adresse email : $key[email]<br>";
            echo "Prénom : $key[firstname]<br>";
            echo "Nom : $key[lastname]<br>";
            echo "Adresse : $key[address]<br>";
            echo "Code postal : $key[zipcode]<br>";
            echo "Ville : $key[city]<br>";
            
            echo "<div class='user_right'><div>Pays : $key[country]</div><a class='user_profile' href='user_profile.php?id=$_GET[id]'><button class='btn_profil_user'>User profile</button></a></div></div>";
        }

        if(empty($result))
        {
        echo "<div class='display_result'>Aucun résultat trouvé pour " . '" ' . $array_last_name . ' "';
        }
        $_POST = array();
}

// si les DEUX champs sont remplis alors = effectue ce code :
if (!empty($_POST["search_member_by_first_name"]) && !empty($_POST["search_member_by_last_name"]) ) 
{
    $array_first_name = $_POST["search_member_by_first_name"];
    $array_last_name = $_POST["search_member_by_last_name"];

    // Pagination
    $query_ = $db->prepare(
        'SELECT * FROM user WHERE user.firstname LIKE :client_first_name AND user.lastname LIKE :client_last_name');
    
        $query_->bindValue(':client_first_name', '%' . $array_first_name . '%', PDO::PARAM_STR);
        $query_->bindValue(':client_last_name', '%' . $array_last_name . '%', PDO::PARAM_STR);    
        $query_->execute();
        $result_pagination = $query_->fetchAll();
        static $i = 0;
            
        foreach($result_pagination as $key)
        {
            $i++;
        }
        
        if($i <= 1)
        {
            echo "<div class='result_nbr'>" . $i . " résultat trouvé :</div>";
        }
        else
        {
            echo "<div class='result_nbr'>" . $i . " résultats trouvés :</div>";
        }




    $query = $db->prepare(

        'SELECT * FROM user WHERE user.firstname LIKE :client_first_name AND user.lastname LIKE :client_last_name');
    
        $query->bindValue(':client_first_name', '%' . $array_first_name . '%', PDO::PARAM_STR);
        $query->bindValue(':client_last_name', '%' . $array_last_name . '%', PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $key) 
        {
            $_GET['id'] = "$key[id]";           

            echo "<div class='display_result'>ID client : $key[id]<br>";
            echo "Adresse email : $key[email]<br>";
            echo "Prénom : $key[firstname]<br>";
            echo "Nom : $key[lastname]<br>";
            echo "Adresse : $key[address]<br>";
            echo "Code postal : $key[zipcode]<br>";
            echo "Ville : $key[city]<br>";
            
            echo "<div class='user_right'><div>Pays : $key[country]</div><a class='user_profile' href='user_profile.php?id=$_GET[id]'><button class='btn_profil_user'>User profile</button></a></div></div>";
        }

        if(empty($result))
        {
        echo "<div class='display_result'>Aucun résultat trouvé pour " . '" ' . $array_first_name . " / " . $array_last_name . ' "';
        }

        $_POST = array();
}

// -------------------------------------------------------- HISTORIQUE DU CLIENT -------------------------------------------------------------------------
 

// si le prénom et le nom sont remplis
if (!empty($_POST["search_hist_by_first_name"]) && !empty($_POST["search_hist_by_last_name"]) )
{
    $array_first_name = $_POST["search_hist_by_first_name"];
    $array_last_name = $_POST["search_hist_by_last_name"];

    $query = $db->prepare(

        'SELECT membership_log.id_membership, movie.title, user.firstname, user.lastname from membership_log

        join movie on membership_log.id_session = movie.id
        join membership on membership_log.id_membership = membership.id
        join user on membership.id_user = user.id

        where user.firstname LIKE :client_first_name  AND user.lastname LIKE :client_last_name');

        $query->bindValue(':client_first_name', '%' . $array_first_name . '%', PDO::PARAM_STR);
        $query->bindValue(':client_last_name', '%' . $array_last_name . '%', PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();
        $result_1 = $result;


    static $i = 0;
    foreach ($result_1 as $key) 
    {
        $i++;
    }

    $first_name = $result[0]['firstname'];
    $last_name = $result[0]['lastname'];
    $id_membership = $result[0]['id_membership'];

    echo "<div class='display_result'>" . "Nom : $last_name<br>" . "Prénom : $first_name<br>" . "ID : $id_membership<br>" . "<h4 class='red_'>Historique du client :<br>" . $i . " résultats trouvés :\n </h4>";

    foreach($result as $key)
    {
        echo "- " . $key['title'] . "\n<br>";
    }
    echo "</div>";
}

// Si un des deux champs n'est pas rempli :
if (!empty($_POST["search_hist_by_first_name"]) && empty($_POST["search_hist_by_last_name"]) )
{
    echo "<div class='display_result'>Attention, vous devez remplir les deux champs 'NOM' et 'PRENOM' pour effectuer votre recherche.<div>";
}

// Si un des deux champs n'est pas rempli :
if (empty($_POST["search_hist_by_first_name"]) && !empty($_POST["search_hist_by_last_name"]) )
{
    echo "<div class='display_result'>Attention, vous devez remplir les deux champs 'NOM' et 'PRENOM' pour effectuer votre recherche.<div>";
}
?>