<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $pergunta=$_GET["pergunta"];
    $opc1=$_GET["opc1"];
    $opc2=$_GET["opc2"];
    $opc3=$_GET["opc3"];
    $resposta=$_GET["resposta"];

    $servidor="localhost";
    $username="root";
    $senha="";
    $database="3daw";
    $conn = new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error) die(json_encode("erro de conexão " . $conn->connect_error));
    //só para ter crtz pq eu tava tendo um erro em relação a isso
    $conn->set_charset("utf8mb4");

    $stmt=$conn->prepare("INSERT INTO pergunta (tipo, texto) VALUES (?, ?)");
    $tipo="multipla";
    $stmt->bind_param("ss", $tipo, $pergunta);
    if(!$stmt->execute()) die(json_encode("erro ".$stmt->error));

    $idPergunta=$stmt->insert_id;
    $stmt->close();

    $stmt=$conn->prepare("INSERT INTO pergunta_multipla (id, opc_a, opc_b, opc_c, resposta) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $idPergunta, $opc1, $opc2, $opc3, $resposta);

    if($stmt->execute()) echo("foi");
    else echo json_encode("erro ".$stmt->error);

    $stmt->close();
    $conn->close();
}
?>
