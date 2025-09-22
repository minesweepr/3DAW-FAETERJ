<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>buscar uma usuario</title>
</head>

<body>
    <main>
        <h1>buscar uma usuario</h1>

        <nav><a href="../listarPerguntas.php">listar perguntas</a> | 
        <a href="../texto/listarUmaTexto.php">exibir uma pergunta de texto</a> | 
        <a href="../texto/criarTexto.php">criar pergunta de texto</a> | 
        <a href="../multipla/listarUmaMultipla.php">exibir uma pergunta de multipla escolha</a> | 
        <a href="../multipla/criarMultipla.php">criar pergunta de multipla escolha</a></nav>

        <nav><a href="listarUsu.php">listar usuarios</a> | 
        <a href="criarUsu.php">criar usuario</a> | 
        <a href="listarUmUsu.php">exibir um usuario</a></nav>
        
        <form action="listarUmUsu.php" method="POST">
            <input type="text" name="busca" placeholder="usuario">
            <button type="submit" value="Submit">buscar</button>
        </form>

        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $busca=trim($_POST['busca']);

            if($busca=="")echo "<p>insira algo</p>";
            else{
                $arq=fopen("../usuarios.txt", "r") or die("erro");
                $achou=false;

                while(($linha=fgets($arq))!==false){
                    $coluna=explode(";", trim($linha));
                    if (count($coluna)<3) continue;

                    if (stripos($coluna[0], $busca)!== false||stripos($coluna[1], $busca)!==false) {
                        echo "<table>
                        <tr><th>nome</th><th>email</th><th>senha</th></tr>
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