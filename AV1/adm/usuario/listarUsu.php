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
              <li><a href="../texto/listarUmTexto.php">exibir uma pergunta</a></li>
              <li><a href="../texto/criarTexto.php">criar pergunta</a></li>
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
              <li><a href="listarUsu.php">listar usuários</a></li>
              <li><a href="listarUmUsu.php">exibir um usuário</a></li>
              <li><a href="criarUsu.php">criar usuário</a></li>
            </ul>
          </li>
      
          <li class="sair"><a href="../../index.html">sair</a></li>
        </ul>
    </nav>

    <main>
        <h1>Listar todas os usuarios</h1>
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