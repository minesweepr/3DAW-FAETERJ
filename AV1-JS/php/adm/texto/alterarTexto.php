<?php
if (file_exists("../../../perguntasTexto.txt")) {
    $arq=fopen("../../../perguntasTexto.txt", "r") or die("erro ao abrir o arq1");
    while (($linha=fgets($arq))!==false) {
        $linhas[]=explode(";", trim($linha));
    }
    fclose($arq);
}
$id=$_GET['id'];
if ($id==-1 || !isset($linhas[$id]))die("pergunta não encontrada");


$coluna=$linhas[$id];
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $idp=$_POST['idp'];
    $pergunta=$_POST['pergunta'];

    $linhas[$id]=[$idp, $pergunta, $resposta];
    $arq=fopen("../../../perguntasTexto.txt", "w") or die("erro ao escrever o arq2");
    foreach ($linhas as $coluna){
        $linha=implode(";", $coluna)."\n";
        fwrite($arq, $linha);
    }
    fclose($arq);
    header("Location: ../listarPerguntas.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>sistema corporativo</title>
        <link rel="stylesheet" href="../../../css/geral.css"> 
        <link rel="stylesheet" href="../../../css/form.css"> 
    </head>
    <body>
    <nav>
        <ul>
          <li><a href="../listarPerguntas.php">inicio</a></li>
        
          <li>
            <a href="#">discursivas ▼</a>
            <ul>
              <li><a href="../texto/listarUmTexto.php">exibir uma pergunta</a></li>
              <li><a href="../../../html/adm/texto/criarTexto.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">multipla escolha ▼</a>
            <ul>
              <li><a href="../multipla/listarUmaMultipla.php">exibir uma pergunta</a></li>
              <li><a href="../../../html/adm/multipla/criarMultipla.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">usuários ▼</a>
            <ul>
              <li><a href="../usuario/listarUsu.php">listar usuários</a></li>
              <li><a href="../usuario/listarUmUsu.php">exibir um usuário</a></li>
              <li><a href="../../../html/adm/usuario/criarUsu.html">criar usuário</a></li>
            </ul>
          </li>
      
          <li class="sair"><a href="../../../index.php">sair</a></li>
        </ul>
    </nav>
        
        <main>
            <h1>alterar perguntas</h1>
            <form action="alterarTexto.php?id=<?php echo $id; ?>" method="POST">
                <label for="idp">
                    id: <input type="number" name="idp" id="idp" value="<?php echo "$coluna[0]"; ?>">
                </label>
                <label for="pergunta">
                    pergunta: <input type="text" name="pergunta" id="pergunta" value="<?php echo "$coluna[1]"; ?>">
                </label>

                <button class="btn" type="submit" value="Submit">enviar</button>
            </form>
        </main>
    </body>
</html>
