<!DOCTYPE html>
<html lang="en" class="body_user_profile">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./public/style.css">
    <script src="./js/script.js"></script>
    <title>MyCinema_PHP</title>
</head>


<body class="body_user_profile">

    <div class="display_result_user_profile">
        <?php include('user_profile_action.php'); ?>
    </div>

<!-- Intervenir sur l'abonnement -->
<?php
if(!empty($_POST) && $_POST['selector'] == "pass_day" && empty($result_1))
{
    // Requête SQL pour CREER l'abonnement
    $query = $db->prepare(

        'INSERT INTO membership (id_user, id_subscription) VALUES (:client_id_,4)');
    
        $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
        $query->execute();
        $result_1 = $query->fetchAll();
        $_POST = array();
        header("Refresh:0");

}
elseif(!empty($_POST) && $_POST['selector'] == "pass_day" && !empty($result_1)) 
{
    // Requête SQL pour MODIFIER l'abonnement

    $query = $db->prepare(

        'UPDATE membership 
        SET membership.id_subscription = 4 
        WHERE membership.id_user = :client_id_');
    
        $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
        $query->execute();
        $result_1 = $query->fetchAll();
        unset($_POST);
        header("Refresh:0");

}
elseif(!empty($_POST) && $_POST['selector'] == "classic" && empty($result_1))
{
        // Requête SQL pour CREER l'abonnement
        $query = $db->prepare(

            'INSERT INTO membership (id_user, id_subscription) VALUES (:client_id_,3)');
        
            $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
            $query->execute();
            $result_1 = $query->fetchAll();
            $_POST = array();
            header("Refresh:0");

}
elseif(!empty($_POST) && $_POST['selector'] == "classic" && !empty($result_1))
{
    // Requête SQL pour MODIFIER l'abonnement

    $query = $db->prepare(

        'UPDATE membership 
        SET membership.id_subscription = 3 
        WHERE membership.id_user = :client_id_');
    
        $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
        $query->execute();
        $result_1 = $query->fetchAll();
        unset($_POST);
        header("Refresh:0");
}
elseif(!empty($_POST) && $_POST['selector'] == "vip" && empty($result_1))
{
            // Requête SQL pour CREER l'abonnement
            $query = $db->prepare(

                'INSERT INTO membership (id_user, id_subscription) VALUES (:client_id_,1)');
            
                $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
                $query->execute();
                $result_1 = $query->fetchAll();
                $_POST = array();
                header("Refresh:0");
}
elseif(!empty($_POST) && $_POST['selector'] == "vip" && !empty($result_1))
{
    // Requête SQL pour MODIFIER l'abonnement

    $query = $db->prepare(

        'UPDATE membership 
        SET membership.id_subscription = 1 
        WHERE membership.id_user = :client_id_');
    
        $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
        $query->execute();
        $result_1 = $query->fetchAll();
        unset($_POST);
        header("Refresh:0");
}
elseif(!empty($_POST) && $_POST['selector'] == "gold" && empty($result_1))
{
            // Requête SQL pour CREER l'abonnement
            $query = $db->prepare(

                'INSERT INTO membership (id_user, id_subscription) VALUES (:client_id_,2)');
            
                $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
                $query->execute();
                $result_1 = $query->fetchAll();
                $_POST = array();
                header("Refresh:0");
}
elseif(!empty($_POST) && $_POST['selector'] == "gold" && !empty($result_1))
{
    // Requête SQL pour MODIFIER l'abonnement

    $query = $db->prepare(

        'UPDATE membership 
        SET membership.id_subscription = 2
        WHERE membership.id_user = :client_id_');
    
        $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
        $query->execute();
        $result_1 = $query->fetchAll();
        unset($_POST);
        header("Refresh:0");
}
elseif(!empty($_POST) && $_POST['selector'] == "inactif" && !empty($result_1))
{
        $query = $db->prepare(

        'DELETE FROM membership_log WHERE id_membership = 1;
        DELETE FROM membership WHERE id_user = :client_id_');
    
        $query->bindValue(':client_id_', $_GET['id'], PDO::PARAM_STR);
        $query->execute();
        $result_1 = $query->fetchAll();
        unset($_POST);
        header("Refresh:0");
}
else
{
    echo "";
}
?>

    <div >
        <form  class="select_sub" method="post" action=<?php echo "user_profile.php?id=$_GET[id]";  ?>>

            <label for="selector">Modifier l'abonnement :</label>
            <select class="select_sub_container"id="selector" name="selector">
            <option class="option_sub" value="">Sélectionnez l'abonnement</option>
            <option class="option_sub" value="inactif">Inactif</option>
                <option class="option_sub" value="pass_day">Pass Day</option>
                <option class="option_sub" value="classic">Classic</option>
                <option class="option_sub" value="vip">VIP</option>
                <option class="option_sub" value="gold">GOLD</option>
            </select>
            <input class="btn_profil_user_" type="submit" value="Modifier">
        </form>
    </div>


    <div>
        <a href="accueil.php">
            <button class="button_accueil">
                Revenir à la page d'accueil
            </button>
        </a>
    </div>

</body>
</html>