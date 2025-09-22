<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>sistema corporativo</title> 
</head>

<body>
    <main>
        <h1>Listar todas os usuarios</h1>

        <nav><a href="../listarPerguntas.php">listar perguntas</a> | 
        <a href="../texto/listarUmTexto.php">exibir uma pergunta de texto</a> | 
        <a href="../texto/criarTexto.php">criar pergunta de texto</a> | 
        <a href="../multipla/listarUmaMultipla.php">exibir uma pergunta de multipla escolha</a> | 
        <a href="../multipla/criarMultipla.php">criar pergunta de multipla escolha</a></nav>

        <nav><a href="listarUsu.php">listar usuarios</a> | 
        <a href="criarUsu.php">criar usuario</a> | 
        <a href="listarUmUsu.php">exibir um usuario</a></nav>
        
        <table>
            <tr><th>nome</th><th>email</th><th>senha</th><th>Funcionalidades</th></tr>
            <?php
            $arq=fopen("../../usuarios.txt", "r") or die ("erro");
            $index=0;
            $existe=false;
            while(($linha=fgets($arq))!==false){
                if($linha=="")continue;
                
                $coluna=explode(";", trim($linha));
                if(count($coluna)<3)continue;
                
                echo "<tr>
                <td>".$coluna[0]."</td>
                <td>".$coluna[1]."</td>
                <td>".$coluna[2]."</td>
                <td>
                    <a href='alterarUsu.php?id=".$index."'>alterar</a> | 
                    <a href='excluirUsu.php?id=".$index."' onclick=\"return confirm('tem certeza que deseja excluir este usuario?')\">excluir</a>
                </td>
                </tr>";

                $index++;
                $existe=true;
            }
            if(!$existe)echo "nenhum usuario cadastrado.";
            fclose($arq);
            ?>
        </table>
      </main>
  </body>
</html>