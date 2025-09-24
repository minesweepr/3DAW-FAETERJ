<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>sistema corporativo</title>
  <link rel="stylesheet" href="../../style/geral.css"> 
  <link rel="stylesheet" href="../../style/tabela.css"> 
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
        <h1>buscar uma pergunta texto</h1>
        <form action="listarUmTexto.php" method="POST">
            <input type="text" name="busca" placeholder="pergunta">
            <button class="btn" type="submit" value="Submit">buscar</button>
        </form>

        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $busca=trim($_POST['busca']);

            if($busca=="")echo "<p>insira algo</p>";
            else{
                $arq=fopen("../../perguntasTexto.txt", "r") or die("erro");
                $achou=false;

                while(($linha=fgets($arq))!==false){
                    $coluna=explode(";", trim($linha));
                    if (count($coluna)<2) continue;

                    if (stripos($coluna[0], $busca)!== false||stripos($coluna[1], $busca)!==false) {
                        echo "<table>
                        <tr><th>id</th><th>pergunta</th></tr>
                        <tr>
                        <td>".$coluna[0]."</td>
                        <td>".$coluna[1]."</td>
                        </tr>
                        </table>";
                        $achou=true;
                    }
                }
            }
            if(!$achou){
                echo "pergunta nao encontrada";
            }
            fclose($arq);
        }
        ?>
      </main>
  </body>
</html>