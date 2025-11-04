<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

if(!isset($_GET['email'])||empty($_GET['email'])){
    echo json_encode(["erro"=>"preencha o email"]);
    exit;
}
$email=$_GET['email'];

$stmt=$conn->prepare("SELECT email, nome, senha FROM usuario WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows===0) echo json_encode(["erro"=>"usuario não encontrado"]);
else echo json_encode($result->fetch_assoc());

$stmt->close();
$conn->close();
?>