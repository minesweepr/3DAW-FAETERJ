<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];

if(!$nome||!$email||!$senha){
    echo json_encode(["erro" => "preencha todos os campos"]);
    exit;
}
$stmt=$conn->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha);

if($stmt->execute()) echo json_encode(["sucesso"=>"foi"]);
else echo json_encode(["erro"=>"erro ao incluir usuario: " . $stmt->error]);

$stmt->close();
$conn->close();
?>