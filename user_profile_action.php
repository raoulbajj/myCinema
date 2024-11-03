<?php
    // CONNECTION A LA DATABASE
    $servername = "mysql:host=localhost;dbname=cinema";
    $username = "raoulbajj";
    $password = "Dracaufeu123";
    $db = new PDO($servername, $username, $password);

    // requête qui affiche les infos du client
    $query = $db->prepare(

        'SELECT * FROM user WHERE user.id LIKE :client_id');
    
        $query->bindValue(':client_id', $_GET['id'], PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();

        foreach ($result as $key) 
        {
            echo "ID client : $key[id]<br>";
            echo "Adresse email : $key[email]<br>";
            echo "Prénom : $key[firstname]<br>";
            echo "Nom : $key[lastname]<br>";
            echo "Adresse : $key[address]<br>";
            echo "Code postal : $key[zipcode]<br>";
            echo "Ville : $key[city]<br>";
            echo "Pays : $key[country]<br>";
        }


        // requête qui affiche le statut de l'abonnement
        $query = $db->prepare(

            'SELECT subscription.name from subscription 

            join membership on subscription.id = membership.id_subscription
            join user on membership.id_user = user.id

            WHERE user.id like :client_id_');
        
            $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
            $query->execute();
            $result_1 = $query->fetchAll();
            if(array_key_exists(0, $result_1))
            {
                echo "<div>Type d'abonnement : " . "<span class='red_'>" . $result_1[0][0] . "</span></div>";
            }
            elseif (empty($result_1))
            {
                echo "<div>Type d'abonnement : <span class='red_'>Inactif</span></div>";
            }
            else
            {
                die;
            }
    ?>