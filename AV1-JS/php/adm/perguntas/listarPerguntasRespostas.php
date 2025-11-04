<?php
$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $res=$conn->query("SELECT id, texto FROM pergunta WHERE tipo='discursiva' AND id=$id");
    $discursivas=$res->fetch_all(MYSQLI_ASSOC);

    $res=$conn->query("SELECT p.id, p.texto, m.opc_a, m.opc_b, m.opc_c, m.resposta FROM pergunta p JOIN pergunta_multipla m ON p.id=m.id WHERE p.tipo='multipla' AND p.id=$id");
    $multipla=$res->fetch_all(MYSQLI_ASSOC);

    echo json_encode(["discursivas" => $discursivas, "multipla" => $multipla]);
}else{
    $discursivas=$multipla=$respostas=[];
    $res=$conn->query("SELECT id, texto FROM pergunta WHERE tipo='discursiva'");
    while($row=$res->fetch_assoc()) $discursivas[]=$row;
    $res=$conn->query("SELECT p.id, p.texto, m.opc_a, m.opc_b, m.opc_c, m.resposta FROM pergunta p JOIN pergunta_multipla m ON p.id=m.id WHERE p.tipo='multipla'");
    
    while($row = $res->fetch_assoc()) $multipla[]=$row;
    $res=$conn->query("SELECT u.email, p.texto AS pergunta, r.resposta FROM resposta r JOIN usuario u ON r.id_usuario=u.id JOIN pergunta p ON r.id_pergunta=p.id");
    
    while($row = $res->fetch_assoc()) $respostas[]=$row;
    echo json_encode(["discursivas"=>$discursivas, "multipla"=>$multipla, "respostas"=>$respostas]);
}
$conn->close();
?>