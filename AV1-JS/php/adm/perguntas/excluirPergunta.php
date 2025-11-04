<?php
if(!isset($_GET['id'])) die("id nao enviado");
$id=$_GET['id'];

$servidor="localhost";
$username="root";
$senha="";
$database="3daw";

$conn=new mysqli($servidor, $username, $senha, $database);
if($conn->connect_error) die("erro: ".$conn->connect_error);
$conn->set_charset("utf8mb4");

$stmt=$conn->prepare("DELETE FROM pergunta WHERE id=?");
$stmt->bind_param("i", $id);

if($stmt->execute()) echo "foi";
else echo "erro: ".$stmt->error;

$stmt->close();
$conn->close();
?>