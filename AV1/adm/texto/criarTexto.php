<?php
$msg="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $idp=$_POST['idp'];
    $pergunta=$_POST['pergunta'];

    if(!file_exists("../../perguntasTexto.txt")){
        $arq=fopen("../../perguntasTexto.txt", "w") or die ("erro");
        fclose($arq);
    }
    $arq=fopen("../../perguntasTexto.txt", "a") or die ("erro");
    $linha="$idp;$pergunta\n";
    fwrite($arq, $linha);
    fclose($arq);
    $msg="sucesso";

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>sistema corporativo</title>
  <link rel="stylesheet" href="../../style/geral.css"> 
  <link rel="stylesheet" href="../../style/form.css"> 
</head>

<body>
    <nav>
        <ul>
          <li><a href="../listarPerguntas.php">inicio</a></li>
        
          <li>
            <a href="#">discursivas ▼</a>
            <ul>
              <li><a href="listarUmTexto.php">exibir uma pergunta</a></li>
              <li><a href="criarTexto.php">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">multipla escolha ▼</a>
            <ul>
              <li><a href="../multipla/listarUmaMultipla.php">exibir uma pergunta</a></li>
              <li><a href="../multipla/criarMultipla.php">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">usuários ▼</a>
            <ul>
              <li><a href="../usuario/listarUsu.php">listar usuários</a></li>
              <li><a href="../usuario/listarUmUsu.php">exibir um usuário</a></li>
              <li><a href="../usuario/criarUsu.php">criar usuário</a></li>
            </ul>
          </li>
      
          <li class="sair"><a href="../../index.html">sair</a></li>
        </ul>
    </nav>

    <main>
        <h1>criar pergunta texto</h1>

        <form action="criarTexto.php" method="POST">
            <label for="idp">
                id: <input type="number" name="idp" id="idp">
            </label>
            <label for="pergunta">
                pergunta: <input type="text" name="pergunta" id="pergunta">
            </label>

            <button class="btn" type="submit" value="Submit">enviar</button>
        </form>
        <?php echo $msg;?>
      </main>
  </body>
</html>