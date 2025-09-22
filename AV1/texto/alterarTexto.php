<?php
if (file_exists("../perguntasTexto.txt")) {
    $arq=fopen("../perguntasTexto.txt", "r") or die("erro ao abrir o arq1");
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
    $resposta=$_POST['resposta'];

    $linhas[$id]=[$idp, $pergunta, $resposta];
    $arq=fopen("../perguntasTexto.txt", "w") or die("erro ao escrever o arq2");
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
        <title>Alterar pergunta</title>
    </head>
    <body>
        <h1>alterar perguntas</h1>
        
        <nav><a href="../listarPerguntas.php">listar perguntas</a> | 
        <a href="listarUmaTexto.php">exibir uma pergunta de texto</a> | 
        <a href="criarTexto.php">criar pergunta de texto</a> | 
        <a href="../multipla/listarUmaMultipla.php">exibir uma pergunta de multipla escolha</a> | 
        <a href="../multipla/criarMultipla.php">criar pergunta de multipla escolha</a></nav>

        <nav><a href="../usuario/listarUsu.php">listar usuarios</a> | 
        <a href="../usuario/criarUsu.php">criar usuario</a> | 
        <a href="../usuario/listarUmUsu.php">exibir um usuario</a></nav>

        <main>
            <form action="alterarTexto.php?id=<?php echo $id; ?>" method="POST">
                <label for="idp">
                    id: <input type="number" name="idp" id="idp" value="<?php echo "$coluna[0]"; ?>">
                </label>
                <label for="pergunta">
                    pergunta: <input type="text" name="pergunta" id="pergunta" value="<?php echo "$coluna[1]"; ?>">
                </label>
                <label for="resposta">
                    resposta: <input type="text" name="resposta" id="resposta" value="<?php echo "$coluna[2]"; ?>">
                </label>

                <button type="submit" value="Submit">enviar</button>
            </form>
        </main>
    </body>
</html>
