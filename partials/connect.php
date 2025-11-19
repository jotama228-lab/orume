<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "orume";

// Connexion
$connect = mysqli_connect($host, $user, $pass, $dbname);

// Vérification
if ($connect) {
    echo "Connexion réussie à la base de données orume";
} else {
    echo "Échec de connexion : " . mysqli_connect_error();
}
