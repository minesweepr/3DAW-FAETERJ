<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $pergunta=$_GET["pergunta"];

    $servidor="localhost";
    $username="root";
    $senha="";
    $database="3daw";
    $conn =new mysqli($servidor, $username, $senha, $database);

    if($conn->connect_error) die(json_encode("erro de conexão " . $conn->connect_error));
    //só para ter crtz pq eu tava tendo um erro em relação a isso
    $conn->set_charset("utf8mb4");

    $stmt=$conn->prepare("INSERT INTO pergunta (tipo, texto) VALUES (?, ?)");
    $tipo="discursiva";
    $stmt->bind_param("ss", $tipo, $pergunta);

    if($stmt->execute()) echo("foi");
    else echo json_encode("erro ".$stmt->error);

    $stmt->close();
    $conn->close();
}
?>
