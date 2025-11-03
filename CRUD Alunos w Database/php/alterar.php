<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3dawalunos";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$matricula=isset($_POST['matricula'])?intval($_POST['matricula']):0;
$nome=isset($_POST['nome'])?trim($_POST['nome']):'';
$email=isset($_POST['email'])?trim($_POST['email']):'';

if(!$matricula || !$nome || !$email){
    echo json_encode(["erro"=>"Preencha todos os campos"]);
    exit;
}

$stmt=$conn->prepare("UPDATE alunos SET nome=?, email=? WHERE matricula=?");
$stmt->bind_param("ssi", $nome, $email, $matricula);

if($stmt->execute()){
    if($stmt->affected_rows>0)echo json_encode(["sucesso"=>"foi"]);
    else echo json_encode(["erro"=>"nenhuma alteracao realizada"]);
}else echo json_encode(["erro"=>"erro: ".$stmt->error]);

$stmt->close();
$conn->close();
?>
