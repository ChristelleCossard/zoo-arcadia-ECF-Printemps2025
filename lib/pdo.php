<?php

try
{
    $pdo = new PDO("mysql:dbname="._DB_NAME_.";host="._DB_SERVER_.";charset=utf8mb4", _DB_USER_, _DB_PASSWORD_);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}



//$pdo = new PDO('mysql:dbname=cocoresto;host=127.0.0.1;port=3308;charset=utf8mb4', 'root', '');
//$pdo = new PDO('mysql:dbname=paintfab;host=127.0.0.1;port=3308;charset=utf8mb4', 'root', '');

