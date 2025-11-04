<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$nome=isset($_POST['nome'])?trim($_POST['nome']):'';
$email=isset($_POST['email'])?trim($_POST['email']):'';
$senha=isset($_POST['senha'])?trim($_POST['senha']):'';
$emailOriginal=isset($_POST['emailOriginal'])?trim($_POST['emailOriginal']):'';

if(!$nome || !$email || !$senha){
    echo json_encode(["erro"=>"Preencha todos os campos"]);
    exit;
}

$stmt=$conn->prepare("UPDATE usuario SET nome=?, email=?, senha=? WHERE email=?");
$stmt->bind_param("ssss", $nome, $email, $senha, $emailOriginal);

if($stmt->execute()){
    if($stmt->affected_rows>0)echo json_encode(["sucesso"=>"foi"]);
    else echo json_encode(["erro"=>"nenhuma alteracao realizada"]);
}else echo json_encode(["erro"=>"erro: ".$stmt->error]);

$stmt->close();
$conn->close();
?>