<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $senhaUsu=$_POST['senha'];

    $servidor="localhost";
    $username="root";
    $senha="";
    $database="3daw";
    $conn=new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error) die(json_encode("erro de conexão " . $conn->connect_error));
    //só para ter crtz pq eu tava tendo um erro em relação a isso
    $conn->set_charset("utf8mb4");

    $stmt=$conn->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senhaUsu);

    if($stmt->execute()) echo("foi");
    else echo json_encode("erro ".$stmt->error);

    $stmt->close();
    $conn->close();
}
?>


