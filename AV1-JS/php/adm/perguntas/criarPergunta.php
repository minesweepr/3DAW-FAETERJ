<?php
if($_SERVER["REQUEST_METHOD"]!="POST")exit;

$tipo=$_POST['tipo'] ?? '';
$texto=$_POST['texto'] ?? '';
$opc_a=$_POST['opc_a'] ?? '';
$opc_b=$_POST['opc_b'] ?? '';
$opc_c=$_POST['opc_c'] ?? '';
$resposta=$_POST['resposta'] ?? '';

$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$stmt=$conn->prepare("INSERT INTO pergunta (tipo, texto) VALUES (?, ?)");
$stmt->bind_param("ss", $tipo, $texto);
if(!$stmt->execute()){
    echo json_encode(["erro"=>"erro ao inserir pergunta: " . $stmt->error]);
    exit;
}
$idPergunta=$stmt->insert_id;
$stmt->close();

if($tipo==="multipla"){
    if(!$opc_a||!$opc_b||!$opc_c||!$resposta){
        echo json_encode(["erro"=>"preencha todos os campos"]);
        exit;
    }

    $stmt=$conn->prepare("INSERT INTO pergunta_multipla (id, opc_a, opc_b, opc_c, resposta) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $idPergunta, $opc_a, $opc_b, $opc_c, $resposta);
    if(!$stmt->execute()){
        echo json_encode(["erro" => "erro: " . $stmt->error]);
        exit;
    }
    $stmt->close();
}

$conn->close();
echo json_encode(["sucesso"=>"foi"]);
?>