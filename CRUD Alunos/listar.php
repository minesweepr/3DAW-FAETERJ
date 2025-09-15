<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Somente listar alunos</title>


  <style>
    table{
        text-align:center;
    }
  </style>  
</head>

<body>
    <main>
        <h1>Listar Alunos</h1>
        <a href="inclusao.php">incluir</a> | <a href="listar.php">listar</a>
        
        <table>
            <tr><th>Matricula</th><th>Nome</th><th>Email</th><th>Funções</th></tr>
            <?php
            $arqAl=fopen("alunos.txt", "r") or die ("erro");
            $index=0;
            $temAl=false;
            while(($linha=fgets($arqAl))!==false){
                if($linha=="")continue;
                
                $coluna=explode(";", $linha);
                if(count($coluna)<3)continue;
                
                echo "<tr>
                <td>".$coluna[0]."</td>
                <td>".$coluna[1]."</td>
                <td>".$coluna[2]."</td>
                <td>
                    <a href='alterar.php?id=".$index."'>alterar</a> | 

                    <a href='deletar.php?id=".$index."' onclick=\"return confirm('Tem certeza que deseja excluir esta disciplina? Esta ação não poderá ser desfeita.')\">deletar</a>
                </td>
                </tr>";

                $index++;
                $temAl=true;
            }
            if(!$temAl){
                echo "nenhum aluno cadastrado.";
            }
            fclose($arqAl);
            ?>
        </table>
      </main>
  </body>
</html>