<?php
if (file_exists("../../../usuarios.txt")) {
    $arq=fopen("../../../usuarios.txt", "r") or die("erro ao abrir o arq1");
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
    $arq=fopen("../../../usuarios.txt", "w") or die("erro ao escrever o arq2");
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
        <title>sistema corporativo</title>
        <link rel="stylesheet" href="../../../css/geral.css"> 
        <link rel="stylesheet" href="../../../css/form.css"> 
    </head>
    <body>
    <nav>
        <ul>
          <li><a href="../../adm/listarPerguntas.php">inicio</a></li>
        
          <li>
            <a href="#">discursivas ▼</a>
            <ul>
              <li><a href="../../../html/adm/texto/AlterarExibirTexto.html">alterar/exibir uma pergunta</a></li>
              <li><a href="../../../html/adm/texto/criarTexto.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">multipla escolha ▼</a>
            <ul>
              <li><a href="../../../html/adm/multipla/AlterarExibirMultipla.html">alterar/exibir uma pergunta</a></li>
              <li><a href="../../../html/adm/multipla/criarMultipla.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">usuários ▼</a>
            <ul>
              <li><a href="../../adm/usuario/listarUsu.php">listar usuários</a></li>
              <li><a href="../../adm/usuario/listarUmUsu.php">exibir um usuário</a></li>
              <li><a href="../../../html/adm/usuario/criarUsu.html">criar usuário</a></li>
            </ul>
          </li>
      
          <li class="sair"><a href="../../../index.php">sair</a></li>
        </ul>
    </nav>

        <main>
            <h1>alterar usuario</h1>
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

                <button class="btn" type="submit" value="Submit">enviar</button>
            </form>
        </main>
    </body>
</html>
