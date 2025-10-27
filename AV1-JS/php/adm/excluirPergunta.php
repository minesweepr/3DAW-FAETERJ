<?php
if(!isset($_GET['id']))die;
$id=$_GET['id'];

$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
//só para ter crtz pq eu tava tendo um erro em relação a isso
$conn->set_charset("utf8mb4");

$stmt=$conn->prepare("DELETE FROM pergunta WHERE id=?");
$stmt->bind_param("i", $id);

if($stmt->execute()){
    $stmt->close();
    $conn->close();
    header("Location: listarPerguntas.php");
    exit;
} else echo json_encode("erro ".$stmt->error);
?>