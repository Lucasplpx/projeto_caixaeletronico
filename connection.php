<?php

$dns = "mysql:dbname=projeto_caixaeletronico;dbhost=localhost";
$user = "root";
$pass = "root";


try{

    $pdo = new PDO($dns, $user, $pass);

}catch(PDOException $er){
    echo "Erro ".$er->getMessage();
    exit;
}


?>