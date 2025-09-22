<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>buscar uma pergunta texto</title>
</head>

<body>
    <main>
        <h1>buscar uma pergunta texto</h1>

        <nav><a href="../listarPerguntas.php">listar perguntas</a> | 
        <a href="listarUmaTexto.php">exibir uma pergunta de texto</a> | 
        <a href="criarTexto.php">criar pergunta de texto</a> | 
        <a href="../multipla/listarUmaMultipla.php">exibir uma pergunta de multipla escolha</a> | 
        <a href="../multipla/criarMultipla.php">criar pergunta de multipla escolha</a></nav>

        <nav><a href="../usuario/listarUsu.php">listar usuarios</a> | 
        <a href="../usuario/criarUsu.php">criar usuario</a> | 
        <a href="../usuario/listarUmUsu.php">exibir um usuario</a></nav>
        
        <form action="listarUmaTexto.php" method="POST">
            <input type="text" name="busca" placeholder="pergunta">
            <button type="submit" value="Submit">buscar</button>
        </form>

        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $busca=trim($_POST['busca']);

            if($busca=="")echo "<p>insira algo</p>";
            else{
                $arq=fopen("../perguntasTexto.txt", "r") or die("erro");
                $achou=false;

                while(($linha=fgets($arq))!==false){
                    $coluna=explode(";", trim($linha));
                    if (count($coluna)<3) continue;

                    if (stripos($coluna[0], $busca)!== false||stripos($coluna[1], $busca)!==false) {
                        echo "<table>
                        <tr><th>id</th><th>pergunta</th><th>resposta</th></tr>
                        <tr>
                        <td>".$coluna[0]."</td>
                        <td>".$coluna[1]."</td>
                        <td>".$coluna[2]."</td>
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