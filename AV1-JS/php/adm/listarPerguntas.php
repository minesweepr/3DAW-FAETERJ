<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>sistema corporativo</title>
  <link rel="stylesheet" href="../../css/geral.css"> 
  <link rel="stylesheet" href="../../css/tabela.css">  
</head>

<body>
    <nav>
        <ul>
          <li><a href="#">inicio</a></li>
        
          <li>
            <a href="#">discursivas ▼</a>
            <ul>
              <li><a href="texto/listarUmTexto.php">exibir uma pergunta</a></li>
              <li><a href="../../html/adm/texto/criarTexto.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">multipla escolha ▼</a>
            <ul>
              <li><a href="multipla/listarUmaMultipla.php">exibir uma pergunta</a></li>
              <li><a href="../../html/adm/multipla/criarMultipla.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">usuários ▼</a>
            <ul>
              <li><a href="usuario/listarUsu.php">listar usuários</a></li>
              <li><a href="usuario/listarUmUsu.php">exibir um usuário</a></li>
              <li><a href="../../html/adm/usuario/criarUsu.html">criar usuário</a></li>
            </ul>
          </li>
      
          <li class="sair"><a href="../../index.php">sair</a></li>
        </ul>
    </nav>

    <main>
        <h1>lista de perguntas</h1>
        <h2>perguntas discursivas</h2>
        <table>
            <tr><th>id</th><th>pergunta</th><th>funcionalidades</th></tr>
            <?php
            $arqTexto=fopen("../../perguntasTexto.txt", "r") or die ("erro");
            $index=0;
            $existe=false;
            while(($linha=fgets($arqTexto))!==false){
                if($linha=="")continue;
                
                $coluna=explode(";", trim($linha));
                if(count($coluna)<2)continue;
                
                echo "<tr>
                <td>".$coluna[0]."</td>
                <td>".$coluna[1]."</td>
                <td>
                    <a href='texto/alterarTexto.php?id=".$index."'>alterar</a> | 
                    <a href='texto/excluirTexto.php?id=".$index."' onclick=\"return confirm('tem certeza que deseja excluir esta pergunta?')\">excluir</a>
                </td>
                </tr>";

                $index++;
                $existe=true;
            }
            if(!$existe)echo "nenhuma pergunta cadastrada.";
            
            fclose($arqTexto);
            ?>
        </table>

        <h2>perguntas de múltipla escolha</h2>
        <table>
            <tr><th>id</th><th>pergunta</th><th>opção 1</th><th>opção 2</th><th>opção 3</th><th>resposta</th><th>Funcionalidades</th></tr>
            <?php
            $arqMulti=fopen("../../perguntasMulti.txt", "r") or die ("erro");
            $index=0;
            $existe=false;
            while(($linha=fgets($arqMulti))!==false){
                if($linha=="")continue;
                
                $coluna=explode(";", trim($linha));
                if(count($coluna)<6)continue;
                
                echo "<tr>
                <td>".$coluna[0]."</td>
                <td>".$coluna[1]."</td>
                <td>".$coluna[2]."</td>
                <td>".$coluna[3]."</td>
                <td>".$coluna[4]."</td>
                <td>".$coluna[5]."</td>
                <td>
                    <a href='multipla/alterarMultipla.php?id=".$index."'>alterar</a> | 
                    <a href='multipla/excluirMultipla.php?id=".$index."' onclick=\"return confirm('tem certeza que deseja excluir esta pergunta?')\">excluir</a>
                </td>
                </tr>";

                $index++;
                $existe=true;
            }
            if(!$existe)echo "nenhuma pergunta cadastrada.";
            
            fclose($arqMulti);
            ?>
        </table>

        <h1>lista respostas</h1>
        <table>
            <tr><th>email</th><th>pergunta</th><th>resposta</th></tr>
            <?php
            $arqResp=fopen("../../respostas.txt", "r") or die ("erro");
            $existe=false;
            while(($linha=fgets($arqResp))!==false){
                if($linha=="")continue;
                
                $coluna=explode(";", trim($linha));
                if(count($coluna)<3)continue;
                
                echo "<tr>
                <td>".$coluna[0]."</td>
                <td>".$coluna[1]."</td>
                <td>".$coluna[2]."</td></tr>";

                $existe=true;
            }
            if(!$existe)echo "nenhuma resposta cadastrada.";
            
            fclose($arqResp);
            ?>
        </table>
      </main>
  </body>
</html>