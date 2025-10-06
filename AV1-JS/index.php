<?php
session_start(); 
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome=$_POST['nome'];
    $email=$_SESSION['email']=$_POST['email'];//https://www.reddit.com/r/PHPhelp/comments/mp75pq/how_do_you_store_a_php_variable_in_between_page/
    $senha=$_POST['senha'];

    if ($email==='adm@adm.com' || $nome==='adm'){
        header("Location: php/adm/listarPerguntas.php");
        exit;
    }

    if(!file_exists("usuarios.txt")){
        $arq=fopen("usuarios.txt", "w") or die ("erro");
        fclose($arq);
    }

    $duplicado=false;
    $arq=fopen("usuarios.txt", "r") or die ("erro");
    while(($linha=fgets($arq))!==false){
        $coluna=explode(";", trim($linha));
        if(count($coluna)>2){
            if(strcmp($coluna[1],$email)==0){
                $duplicado=true;
                break;
            }
        }
    }
    fclose($arq);

    if(!$duplicado){
        $arq=fopen("usuarios.txt", "a") or die ("erro");
        $linha="$nome;$email;$senha\n";
        fwrite($arq, $linha);
        fclose($arq);
    }
    header("Location: php/questionario/questionario.php");

}
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
        <h1>login/cadastro do usuário</h1>

        <form action="index.php" method="POST">
            <label for="nome">
                nome: <input type="text" name="nome" id="nome">
            </label>
            <label for="email">
                email: <input type="text" name="email" id="email">
            </label>
            <label for="senha">
                senha: <input type="password" name="senha" id="senha">
            </label>

            <button class="btn" type="submit" value="Submit">logar</button>
        </form>
      </main>
  </body>
</html>