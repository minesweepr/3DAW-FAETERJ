<?php
if (file_exists("../usuarios.txt")) {
    $arq=fopen("../usuarios.txt", "r") or die("erro ao abrir o arq1");
    while (($linha=fgets($arq))!==false) {
        $linhas[]=explode(";", trim($linha));
    }
    fclose($arq);
}
$id=$_GET['id'];
if ($id==-1 || !isset($linhas[$id]))die("usuario não encontrada");


$coluna=$linhas[$id];
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $senha=$_POST['senha'];

    $linhas[$id]=[$nome, $email, $senha];
    $arq=fopen("../usuarios.txt", "w") or die("erro ao escrever o arq2");
    foreach ($linhas as $coluna){
        $linha=implode(";", $coluna)."\n";
        fwrite($arq, $linha);
    }
    fclose($arq);
    header("Location: listarUsu.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alterar usuario</title>
    </head>
    <body>
        <h1>alterar usuario</h1>
        
        <nav><a href="../listarPerguntas.php">listar perguntas</a> | 
        <a href="../texto/listarUmaTexto.php">exibir uma pergunta de texto</a> | 
        <a href="../texto/criarTexto.php">criar pergunta de texto</a> | 
        <a href="../multipla/listarUmaMultipla.php">exibir uma pergunta de multipla escolha</a> | 
        <a href="../multipla/criarMultipla.php">criar pergunta de multipla escolha</a></nav>

        <nav><a href="listarUsu.php">listar usuarios</a> | 
        <a href="listarUmUsu.php">criar usuario</a> | 
        <a href="criarUsu.php">exibir um usuario</a></nav>
        
        <main>
            <form action="alterarUsu.php?id=<?php echo $id; ?>" method="POST">
                <label for="nome">
                    nome: <input type="text" name="nome" id="nome" value="<?php echo "$coluna[0]"; ?>">
                </label>
                <label for="perguemailnta">
                    email: <input type="text" name="email" id="email" value="<?php echo "$coluna[1]"; ?>">
                </label>
                <label for="senha">
                    senha: <input type="text" name="senha" id="senha" value="<?php echo "$coluna[2]"; ?>">
                </label>

                <button type="submit" value="Submit">enviar</button>
            </form>
        </main>
    </body>
</html>
