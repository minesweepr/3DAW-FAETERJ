<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>sistema corporativo</title>
  <style>
    table{text-align:center; margin-bottom:20px;}
    table, th, td{border: 1px solid black;border-collapse: collapse;padding:5px;}
  </style>  
</head>

<body>
    <main>
        <h1>Listar todas as perguntas</h1>

        <nav><a href="listarPerguntas.php">listar perguntas</a> | 
        <a href="texto/listarUmTexto.php">exibir uma pergunta de texto</a> | 
        <a href="texto/criarTexto.php">criar pergunta de texto</a> | 
        <a href="multipla/listarUmaMultipla.php">exibir uma pergunta de multipla escolha</a> | 
        <a href="multipla/criarMultipla.php">criar pergunta de multipla escolha</a></nav>

        <nav><a href="usuario/listarUsu.php">listar usuarios</a> | 
        <a href="usuario/listarUmUsu.php">criar usuario</a> | 
        <a href="usuario/criarUsu.php">exibir um usuario</a></nav>
        
        <table>
            <tr><th>id</th><th>pergunta</th><th>Funcionalidades</th></tr>
            <?php
            $arqTexto=fopen("../perguntasTexto.txt", "r") or die ("erro");
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
            if(!$existe)echo "nenhuma pergunta cadastrado.";
            
            fclose($arqTexto);
            ?>
        </table>

        <table>
            <tr><th>id</th><th>pergunta</th><th>opção 1</th><th>opção 2</th><th>opção 3</th><th>resposta</th><th>Funcionalidades</th></tr>
            <?php
            $arqMulti=fopen("../perguntasMulti.txt", "r") or die ("erro");
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
            if(!$existe)echo "nenhuma pergunta cadastrado.";
            
            fclose($arqMulti);
            ?>
        </table>

        <table>
            <tr><th>email</th><th>pergunta</th><th>resposta</th></tr>
            <?php
            $arqResp=fopen("../respostas.txt", "r") or die ("erro");
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