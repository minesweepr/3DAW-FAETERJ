<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn =new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$sql="SELECT * FROM usuario";
$resultado=$conn->query($sql);
$usuarios=[];
if($resultado->num_rows>0){
  while($linha=$resultado->fetch_assoc()) $usuarios[]=$linha;
}
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($usuarios);

$conn->close();
?>