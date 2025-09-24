<?php
$msg="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $idp=$_POST['idp'];
    $pergunta=$_POST['pergunta'];
    $opc1=$_POST['opc1'];
    $opc2=$_POST['opc2'];
    $opc3=$_POST['opc3'];
    $resposta=$_POST['resposta'];

    if(!file_exists("../../perguntasMulti.txt")){
        $arq=fopen("../../perguntasMulti.txt", "w") or die ("erro");
        fclose($arq);
    }
    $arq=fopen("../../perguntasMulti.txt", "a") or die ("erro");
    $linha="$idp;$pergunta;$opc1;$opc2;$opc3;$resposta\n";
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
              <li><a href="../texto/listarUmTexto.php">exibir uma pergunta</a></li>
              <li><a href="../texto/criarTexto.php">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">multipla escolha ▼</a>
            <ul>
              <li><a href="listarUmaMultipla.php">exibir uma pergunta</a></li>
              <li><a href="criarMultipla.php">criar pergunta</a></li>
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
        <h1>criar pergunta multipla</h1>
        
        <form action="criarMultipla.php" method="POST">
            <label for="idp">
                id: <input type="number" name="idp" id="idp">
            </label>
            <label for="pergunta">
                pergunta: <input type="text" name="pergunta" id="pergunta">
            </label>
            <label for="opc1">
                opção 1: <input type="text" name="opc1" id="opc1">
            </label>
            <label for="opc2">
                opção 2: <input type="text" name="opc2" id="opc2">
            </label>
            <label for="opc3">
                opção 3: <input type="text" name="opc3" id="opc3">
            </label>
            <label for="resposta">
                resposta: <input type="text" name="resposta" id="resposta">
            </label>

            <button class="btn" type="submit" value="Submit">enviar</button>
        </form>
        <?php echo $msg;?>
      </main>
  </body>
</html>