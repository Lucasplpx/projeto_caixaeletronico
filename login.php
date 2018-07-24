<?php
session_start();
require 'connection.php';

if(isset($_POST['agencia']) && !empty($_POST['agencia'])){
    $agencia = addslashes($_POST['agencia']);
    $conta = addslashes($_POST['conta']);
    $senha = md5(addslashes($_POST['senha']));

    $sql = $pdo->prepare("SELECT * FROM contas WHERE agencia = :agencia and conta = :conta and senha = :senha");

    $sql->bindValue(":agencia", $agencia);
    $sql->bindValue(":conta", $conta);
    $sql->bindValue(":senha", $senha);
    $sql->execute();

    if($sql->rowCount() > 0){
        $sql = $sql->fetch();

        $_SESSION['banco'] = $sql['id'];
        header("Location: index.php");
        exit;
    }

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
        Agência: <br/>
        <input type="text" name="agencia"/><br/><br/>

        Conta: <br/>
        <input type="text" name="conta"/><br/><br/>
       
        Senha: <br/>
        <input type="password" name="senha"/><br/><br/>

        <input type="submit" value="Entrar"/>
    
    </form>
    
</body>
</html>