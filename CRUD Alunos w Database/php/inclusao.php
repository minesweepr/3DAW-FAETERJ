<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3dawalunos";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$matricula=$_POST['matricula'];
$nome=$_POST['nome'];
$email=$_POST['email'];

if(!$matricula||!$nome||!$email){
    echo json_encode(["erro" => "preencha todos os campos"]);
    exit;
}
$stmt=$conn->prepare("INSERT INTO alunos (matricula, nome, email) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $matricula, $nome, $email);

if($stmt->execute()) echo json_encode(["sucesso"=>"foi"]);
else echo json_encode(["erro"=>"erro ao incluir aluno: " . $stmt->error]);

$stmt->close();
$conn->close();
?>
