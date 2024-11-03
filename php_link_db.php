<?php
$servername = "mysql:host=localhost;dbname=cinema";
$username = "raoulbajj";
$password = "Dracaufeu123";
$db = new PDO($servername, $username, $password);

if (!$db) 
{
  die("Echec de la connexion !");
}
else
{
  echo "Connexion réussie !";
}
?>