<?php
if (file_exists("disciplinas.txt")) {
    $arqDisc=fopen("disciplinas.txt", "r") or die("erro ao abrir arquivo");
    while (($linha=fgets($arqDisc))!==false) {
        $disciplinas[]=explode(";", trim($linha));
    }
    fclose($arqDisc);
}

$id=$_GET['id'];
if ($id==-1 || !isset($disciplinas[$id])) {
    die("Disciplina não encontrada");
}

$disciplina = $disciplinas[$id];
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $nome=$_POST['nome'];
    $sigla=$_POST['sigla'];
    $carga=$_POST['carga'];

    $disciplinas[$id] =[$nome, $sigla, $carga];

    $arqDisc=fopen("disciplinas.txt", "w") or die("erro ao abrir arquivo");
    foreach ($disciplinas as $disciplina){
        $linha=implode(";", $disciplina)."\n";
        fwrite($arqDisc, $linha);
    }
    fclose($arqDisc);

    header("Location: listar.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../estilos/styleGeral.css" />
  <link rel="stylesheet" href="../estilos/styleCriar.css" />
  <title>Sistema de Gerenciamento de Disciplinas</title>
</head>
<body>
  <header class="topo">
    <h2>Sistema de Gerenciamento de Disciplinas <span>2025</span></h2>
  </header>

  <section class="container">
    <aside class="esquerdo">
      <h1>CRUD</h1>
      <nav>
        <ul>
          <li><i class="fa fa-user-plus" aria-hidden="true"></i><a href="criar.php"> Criar Disciplinas</a></li>
          <li><i class="fa fa-list" aria-hidden="true"></i><a href="listar.php"> Listar Disciplinas</a>
              <li class="sub">&#x2937; Editar</li>
              <li class="sub">&#x2937; Deletar</li>
          </li>
        </ul>
      </nav>
    </aside>

    <main class="corpo"><div class="conteudo">
        <section>
          <h3><i class="fa fa-info-circle" aria-hidden="true"></i> Alterar Disciplinas</h3>
        </section>
        <form action="alterar.php?id=<?php echo $id; ?>" method="POST">
            <label for="nome">
                Nome da Disciplina: <input type="text" name="nome" id="nome" value="<?php echo "$disciplina[0]"; ?>">
            </label>
            <label for="sigla">
                Sigla da Disciplina: <input type="text" name="sigla" id="sigla" value="<?php echo "$disciplina[1]"; ?>">
            </label>
            <label for="carga">
                Carga Horária: <input type="number" name="carga" id="carga" value="<?php echo "$disciplina[2]"; ?>">
            </label>

            <button type="submit" value="Submit">Alterar Disciplina Atual</button>
        </form>
      </main>
    </article>
  </body>
</html>