<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$idOriginal=$_POST['id'] ?? 0;
$idp=$_POST['idp'] ?? 0;
$tipo=$_POST['tipo'] ?? '';
$pergunta=$_POST['pergunta'] ?? '';
$opc1=$_POST['opc1'] ?? '';
$opc2=$_POST['opc2'] ?? '';
$opc3=$_POST['opc3'] ?? '';
$resposta=$_POST['resposta'] ?? '';

if(!$idp || !$tipo) exit;

if($tipo==="discursiva"){
    $stmt=$conn->prepare("UPDATE pergunta SET texto=? WHERE id=? AND tipo='discursiva'");
    $stmt->bind_param("si", $pergunta, $idp);
    if($stmt->execute())echo json_encode(["sucesso"=>"foi"]);
    else echo json_encode(["erro"=>"erro: ".$stmt->error]);
    $stmt->close();
}else if($tipo==="multipla"){
    $stmt1=$conn->prepare("UPDATE pergunta SET texto=? WHERE id=? AND tipo='multipla'");
    $stmt1->bind_param("si", $pergunta, $idp);
    $ok1=$stmt1->execute();

    $stmt2=$conn->prepare("UPDATE pergunta_multipla SET opc_a=?, opc_b=?, opc_c=?, resposta=? WHERE id=?");
    $stmt2->bind_param("ssssi", $opc1, $opc2, $opc3, $resposta, $idp);
    $ok2=$stmt2->execute();

    if($ok1 && $ok2) echo json_encode(["sucesso" => "foi"]);
    else echo json_encode(["erro" => "erro ao alterar"]);
    
    $stmt1->close();
    $stmt2->close();
}else echo json_encode(["erro"=>"tipo invalido"]);
$conn->close();
?>