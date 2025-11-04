<?php
session_start();
$servidor="localhost";
$username="root";
$senha="";
$database="3daw";
$conn=new mysqli($servidor, $username, $senha, $database);

if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
$conn->set_charset("utf8mb4");

$erro="";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $nome=trim($_POST['nome']);
    $email=trim($_POST['email']);
    $senha=trim($_POST['senha']);

    $stmt=$conn->prepare("SELECT nome, email, senha FROM usuario WHERE id=-1");
    $stmt->execute();
    $result=$stmt->get_result();
    $admin=$result->fetch_assoc();
    $stmt->close();
    if($admin && $nome===$admin['nome'] && $email===$admin['email'] && $senha===$admin['senha']) {
        $_SESSION['nome']=$nome;
        $_SESSION['email']=$email;
        header("Location: html/adm/listarPerguntasRespostas.html");
        exit;
    }
    $stmt=$conn->prepare("SELECT id, nome, email, senha FROM usuario WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result=$stmt->get_result();
    $usuarioExistente=$result->fetch_assoc();
    $stmt->close();

    if($usuarioExistente){
        if($usuarioExistente['senha']===$senha) {
            $_SESSION['nome']=$usuarioExistente['nome'];
            $_SESSION['email']=$usuarioExistente['email'];
            header("Location: php/questionario/questionario.php");
            exit;
        }else $erro="senha incorreta";
    }else{
        $stmtInsert=$conn->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
        $stmtInsert->bind_param("sss", $nome, $email, $senha);
        $stmtInsert->execute();
        $stmtInsert->close();

        $_SESSION['nome']=$nome;
        $_SESSION['email']=$email;
        header("Location: php/questionario/questionario.php");
        exit;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>questionario</title>
  <link rel="stylesheet" href="css/geral.css"> 
  <link rel="stylesheet" href="css/form.css"> 
  <link rel="stylesheet" href="css/login.css"> 
</head>

<body>
    <main>
        <h1>Login/Cadastro do usuário</h1>
        <form action="index.php" method="POST" class="coluna">
            <label for="nome">nome: <input type="text" name="nome" id="nome" required></label>
            <label for="email">email: <input type="email" name="email" id="email" required></label>
            <label for="senha">senha: <input type="password" name="senha" id="senha" required></label>

            <button class="btn" type="submit">logar</button>
            <?php if(!empty($erro)):?><p style="text-align:center;"><?= htmlspecialchars($erro) ?></p><?php endif; ?>
        </form>
    </main>
</body>
</html>