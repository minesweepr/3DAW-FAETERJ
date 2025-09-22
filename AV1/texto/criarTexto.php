<?php
$msg="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $idp=$_POST['idp'];
    $pergunta=$_POST['pergunta'];
    $resposta=$_POST['resposta'];

    if(!file_exists("../perguntasTexto.txt")){
        $arq=fopen("../perguntasTexto.txt", "w") or die ("erro");
        fclose($arq);
    }
    $arq=fopen("../perguntasTexto.txt", "a") or die ("erro");
    $linha="$idp;$pergunta;$resposta\n";
    fwrite($arq, $linha);
    fclose($arq);
    $msg="sucesso";

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>criar pergunta texto</title>
  <style>label{display:flex;flex-direction:row;}</style>
</head>

<body>
    <main>
        <h1>criar pergunta texto</h1>

        <nav><a href="../listarPerguntas.php">listar perguntas</a> | 
        <a href="listarUmaTexto.php">exibir uma pergunta de texto</a> | 
        <a href="criarTexto.php">criar pergunta de texto</a> | 
        <a href="../multipla/listarUmaMultipla.php">exibir uma pergunta de multipla escolha</a> | 
        <a href="../multipla/criarMultipla.php">criar pergunta de multipla escolha</a></nav>

        <nav><a href="../usuario/listarUsu.php">listar usuarios</a> | 
        <a href="../usuario/listarUmUsu.php">criar usuario</a> | 
        <a href="../usuario/criarUsu.php">exibir um usuario</a></nav>

        <form action="criarTexto.php" method="POST">
            <label for="idp">
                id: <input type="number" name="idp" id="idp">
            </label>
            <label for="pergunta">
                pergunta: <input type="text" name="pergunta" id="pergunta">
            </label>
            <label for="resposta">
                resposta: <input type="text" name="resposta" id="resposta">
            </label>

            <button type="submit" value="Submit">enviar</button>
        </form>
        <?php echo $msg;?>
      </main>
  </body>
</html>