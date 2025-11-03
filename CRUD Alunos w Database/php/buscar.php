<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3dawalunos";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

if(!isset($_GET['matricula'])||empty($_GET['matricula'])){
    echo json_encode(["erro"=>"preencha a matricula"]);
    exit;
}
$matricula = intval($_GET['matricula']);

$stmt=$conn->prepare("SELECT matricula, nome, email FROM alunos WHERE matricula=?");
$stmt->bind_param("i", $matricula);
$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows===0) echo json_encode(["erro"=>"Aluno não encontrado"]);
else echo json_encode($result->fetch_assoc());

$stmt->close();
$conn->close();
?>
