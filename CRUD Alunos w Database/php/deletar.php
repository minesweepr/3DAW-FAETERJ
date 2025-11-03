<?php
if(!isset($_GET['matricula']))die;
$matricula=$_GET['matricula'];

$servidor="localhost";
$username="root";
$senha="";
$database="3dawalunos";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$stmt=$conn->prepare("DELETE FROM alunos WHERE matricula=?");
$stmt->bind_param("i", $matricula);

if($stmt->execute()){
    $stmt->close();
    $conn->close();
    header("Location: ../html/listar.html");
    exit;
} else echo json_encode("erro ".$stmt->error);
?>