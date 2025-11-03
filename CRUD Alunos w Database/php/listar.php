<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3dawalunos";
$conn =new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$sql="SELECT * FROM alunos";
$resultado=$conn->query($sql);
$alunos=[];
if($resultado->num_rows>0){
  while($linha=$resultado->fetch_assoc()) $alunos[]=$linha;
}
header("Content-Type: application/json; charset=UTF-8");
echo json_encode($alunos);

$conn->close();
?>
