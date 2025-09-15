<?php
$erroEmail=$erroNome=$erroMatricula="";
if (file_exists("alunos.txt")) {
    $arqAl=fopen("alunos.txt", "r") or die("erro");
    while (($linha=fgets($arqAl))!==false) $alunos[]=explode(";", trim($linha));
    fclose($arqAl);
}

$id=$_GET['id'];
if ($id==-1 || !isset($alunos[$id])) die("aluno não encontrado :(");

$aluno = $alunos[$id];
if ($_SERVER['REQUEST_METHOD']=='POST') {
    require_once 'REGEX.php';
    if(empty($erroEmail) && empty($erroNome) && empty($erroMatricula)){
        $alunos[$id] =[$matricula, $nome, $email];

        $arqAl=fopen("alunos.txt", "w") or die("erro");
        foreach ($alunos as $aluno){
            $linha=implode(";", $aluno)."\n";
            fwrite($arqAl, $linha);
        }
        fclose($arqAl);
        header("Location: listar.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>alterar aluno</title>

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
        <h1>Alterar Aluno</h1>
        <nav><a href="inclusao.php">incluir</a> | <a href="listar.php">listar</a></nav>
        <form action="alterar.php?id=<?php echo $id; ?>" method="POST">
            <label for="matricula">
                matricula: <input type="number" name="matricula" id="matricula" value="<?php echo "$aluno[0]"; ?>">
                <?php if ($erroMatricula) echo $erroMatricula; ?>
            </label>
            <label for="nome">
                nome: <input type="text" name="nome" id="nome" value="<?php echo "$aluno[1]"; ?>">
                <?php if ($erroNome) echo $erroNome; ?>
            </label>
            <label for="email">
                email: <input type="text" name="email" id="email" value="<?php echo "$aluno[2]"; ?>">
                <?php if ($erroEmail) echo $erroEmail; ?>
            </label>
            <button type="submit" value="Submit">alterar</button>
        </form>
      </main>
  </body>
</html>