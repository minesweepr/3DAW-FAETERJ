<?php
$msg="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $senha=$_POST['senha'];

    if(!file_exists("../../usuarios.txt")){
        $arq=fopen("../../usuarios.txt", "w") or die ("erro");
        fclose($arq);
    }
    $arq=fopen("../../usuarios.txt", "a") or die ("erro");
    $linha="$nome;$email;$senha\n";
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
  <style>label{display:flex;flex-direction:row;}</style>
</head>

<body>
    <main>
        <h1>criar pergunta texto</h1>

        <nav><a href="../listarPerguntas.php">listar perguntas</a> | 
        <a href="../texto/listarUmTexto.php">exibir uma pergunta de texto</a> | 
        <a href="../texto/criarTexto.php">criar pergunta de texto</a> | 
        <a href="../multipla/listarUmaMultipla.php">exibir uma pergunta de multipla escolha</a> | 
        <a href="../multipla/criarMultipla.php">criar pergunta de multipla escolha</a></nav>

        <nav><a href="listarUsu.php">listar usuarios</a> | 
        <a href="criarUsu.php">criar usuario</a> | 
        <a href="listarUmUsu.php">exibir um usuario</a></nav>

        <form action="criarUsu.php" method="POST">
            <label for="nome">
                nome: <input type="text" name="nome" id="nome">
            </label>
            <label for="email">
                email: <input type="text" name="email" id="email">
            </label>
            <label for="senha">
                senha: <input type="text" name="senha" id="senha">
            </label>

            <button type="submit" value="Submit">enviar</button>
        </form>
        <?php echo $msg;?>
      </main>
  </body>
</html>