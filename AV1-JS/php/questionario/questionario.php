<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: ../../index.php");
    exit;
}

$servidor="localhost";
$username="root";
$senha="";
$database="3daw";

$conn=new mysqli($servidor, $username, $senha, $database);
if($conn->connect_error) die("erro de conexão: " . $conn->connect_error);
$conn->set_charset("utf8mb4");

$email=$_SESSION['email'];
$stmt=$conn->prepare("SELECT id FROM usuario WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result=$stmt->get_result();
$user=$result->fetch_assoc();
$stmt->close();
if(!$user) die("ususario n encontrado");

$userId=$user['id'];
if($_SERVER['REQUEST_METHOD']==='POST'){
    $stmt=$conn->prepare("SELECT id FROM pergunta WHERE tipo='discursiva'");
    $stmt->execute();
    $result=$stmt->get_result();
    while($row=$result->fetch_assoc()){
        $resposta = isset($_POST["respostaT_".$row['id']])?trim($_POST["respostaT_".$row['id']]):'';
        if($resposta!==''){
            $stmtInsert=$conn->prepare("INSERT INTO resposta (id_usuario, id_pergunta, resposta) VALUES (?, ?, ?)");
            $stmtInsert->bind_param("iis", $userId, $row['id'], $resposta);
            $stmtInsert->execute();
            $stmtInsert->close();
        }
    }
    $stmt->close();

    $stmt=$conn->prepare("SELECT p.id, pm.opc_a, pm.opc_b, pm.opc_c FROM pergunta p JOIN pergunta_multipla pm ON p.id=pm.id");
    $stmt->execute();
    $result=$stmt->get_result();
    while($row=$result->fetch_assoc()){
        $resposta=isset($_POST["respostaM_".$row['id']])?trim($_POST["respostaM_".$row['id']]) : '';
        if($resposta!==''){
            $stmtInsert=$conn->prepare("INSERT INTO resposta (id_usuario, id_pergunta, resposta) VALUES (?, ?, ?)");
            $stmtInsert->bind_param("iis", $userId, $row['id'], $resposta);
            $stmtInsert->execute();
            $stmtInsert->close();
        }
    }
    $stmt->close();
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Questionário</title>
  <link rel="stylesheet" href="../../css/geral.css"> 
  <link rel="stylesheet" href="../../css/questionario.css"> 
  <link rel="stylesheet" href="../../css/form.css"> 
</head>

<body>
    <main>
        <h1>Questionário</h1>
        <form action="questionario.php" method="POST">

            <fieldset>
            <legend>Perguntas discursivas</legend>
            <?php
            $stmt = $conn->prepare("SELECT id, texto FROM pergunta WHERE tipo='discursiva'");
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows===0) echo "<p>nenhuma pergunta cadastrada.</p>";
            else{
                $index=1;
                while($row = $result->fetch_assoc()){
                    echo "<p>".$index." - ".$row['texto']."</p>";
                    echo "<textarea name='respostaT_".$row['id']."' rows='4' cols='50'></textarea><br><br>";
                    $index++;
                }
            }
            $stmt->close();
            ?>
            </fieldset>

            <fieldset>
            <legend>Perguntas de múltipla escolha</legend>
            <?php
            $stmt=$conn->prepare("SELECT p.id, p.texto, pm.opc_a, pm.opc_b, pm.opc_c FROM pergunta p JOIN pergunta_multipla pm ON p.id=pm.id");
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows===0) echo "<p>nenhuma pergunta cadastrada.</p>";
            else{
                $index=1;
                while($row=$result->fetch_assoc()){
                    echo "<p>".$index." - ".$row['texto']."</p>";
                    echo "<input type='radio' name='respostaM_".$row['id']."' value='".$row['opc_a']."' id='r".$row['id']."_1'><label for='r".$row['id']."_1'>".$row['opc_a']."</label><br>";
                    echo "<input type='radio' name='respostaM_".$row['id']."' value='".$row['opc_b']."' id='r".$row['id']."_2'><label for='r".$row['id']."_2'>".$row['opc_b']."</label><br>";
                    echo "<input type='radio' name='respostaM_".$row['id']."' value='".$row['opc_c']."' id='r".$row['id']."_3'><label for='r".$row['id']."_3'>".$row['opc_c']."</label><br><br>";
                    $index++;
                }
            }
            $stmt->close();
            $conn->close();
            ?>
            </fieldset>

            <button class="btn" type="submit">Enviar</button>
        </form>
    </main>
</body>
</html>