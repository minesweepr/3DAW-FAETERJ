<?php
if(!isset($_GET['email']))die;
$email=$_GET['email'];

$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
//só para ter crtz pq eu tava tendo um erro em relação a isso
$conn->set_charset("utf8mb4");

$stmt=$conn->prepare("DELETE FROM usuario WHERE email=?");
$stmt->bind_param("s", $email);

if($stmt->execute()){
    $stmt->close();
    $conn->close();
    header("Location: ../../../html/adm/usuario/listarUsu.html");
    exit;
} else echo json_encode("erro ".$stmt->error);
?>