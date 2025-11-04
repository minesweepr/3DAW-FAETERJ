<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$id=isset($_GET['id'])?intval($_GET['id']):0;
$tipo=isset($_GET['tipo'])?$_GET['tipo']:'';

if(!$id||!$tipo){
    echo json_encode(["erro"=>"preencha todos os campos"]);
    exit;
}

if($tipo==="discursiva"){
    $stmt=$conn->prepare("SELECT id, texto FROM pergunta WHERE id=? AND tipo='discursiva'");
    $stmt->bind_param("i", $id);
}else if($tipo==="multipla") {
    $stmt=$conn->prepare("SELECT p.id, p.texto, m.opc_a, m.opc_b, m.opc_c, m.resposta FROM pergunta p JOIN pergunta_multipla m ON p.id=m.id WHERE p.id=? AND p.tipo='multipla'");
    $stmt->bind_param("i", $id);
}else{
    echo json_encode(["erro"=>"tipo invalido"]);
    exit;
}

$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows===0) echo json_encode(["erro"=>"pergunta nao encontrada"]);
else echo json_encode($result->fetch_assoc());

$stmt->close();
$conn->close();
?>