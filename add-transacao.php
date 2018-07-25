<?php
session_start();
require 'connection.php';

if(isset($_POST['tipo'])){
    $tipo = addslashes($_POST['tipo']);
    $valor = addslashes(str_replace(",", "." , $_POST['valor']));
    $valor = floatval($valor);

    $sql = $pdo->prepare("INSERT INTO historico (id_conta, tipo, valor, data_operacao) VALUES (:id_conta, :tipo, :valor, NOW());");
    $sql->bindValue(":id_conta", $_SESSION['banco']);
    $sql->bindValue(":tipo", $tipo);
    $sql->bindValue(":valor", $valor);
    $sql->execute();

    if($tipo == '0'){

        $sql = $pdo->prepare("UPDATE contas SET saldo = saldo + :valor WHERE id = :id");
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":id", $_SESSION['banco']);
        $sql->execute();
    
    }else{
        $sql = $pdo->prepare("UPDATE contas SET saldo = saldo - :valor WHERE id = :id");
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":id", $_SESSION['banco']);
        $sql->execute();
    }

    header("Location: index.php");
    exit;
    

}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

    <form method="post">
        Tipo de transação: <br/>
        <select name="tipo">
            <option value="" selected>-- Selecione --</option>
            <option value="0">Depósito</option>
            <option value="1">Retirada</option>
        </select><br/><br/>
       

        Valor: <br/>
        <input type="number" min="0" name="valor"/><br/><br/>
       
        
        <input type="submit" value="Adicionar"/>
    
    </form>
    
</body>
</html>