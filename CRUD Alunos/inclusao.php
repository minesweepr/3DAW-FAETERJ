<?php
require_once 'REGEX.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(empty($erroEmail) && empty($erroNome) && empty($erroMatricula)){
        if(!file_exists("alunos.txt")){
            $arqAl=fopen("alunos.txt", "w") or die ("erro");
            fclose($arqAl);
        }
        $arqAl=fopen("alunos.txt", "a") or die ("erro");
        $linha="$matricula;$nome;$email\n";
        fwrite($arqAl, $linha);
        fclose($arqAl);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>incluir aluno</title>

  <style>
            form{
                display: flex;
                gap: 10px;
                width: fit-content;
                align-content: center;
            }
            form{
                flex-direction: column;
            }
  </style>
</head>
<body>
    <main>
        <h1>Incluir Aluno</h1>
        <nav><a href="inclusao.php">incluir</a> | <a href="listar.php">listar</a></nav>
        <!--verificar com expressao regular ou REGEX-->
        <form action="inclusao.php" method="POST">
            <label for="matricula">
                matricula: <input type="number" name="matricula" id="matricula">
                <?php if ($erroMatricula) echo $erroMatricula; ?>
            </label>
            <label for="nome">
                nome: <input type="text" name="nome" id="nome">
                <?php if ($erroNome) echo $erroNome; ?>
            </label>
            <label for="email">
                email: <input type="text" name="email" id="email">
                <?php if ($erroEmail) echo $erroEmail; ?>
            </label>
            <button type="submit" value="Submit">incluir</button>
        </form>

        
      </main>
  </body>
</html>