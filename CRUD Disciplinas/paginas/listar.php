<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../estilos/styleGeral.css" />
  <link rel="stylesheet" href="../estilos/styleListar.css" />
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
          <li class="select"><i class="fa fa-list" aria-hidden="true"></i><a href="listar.php"> Listar Disciplinas</a>
              <li class="sub">&#x2937; Editar</li>
              <li class="sub">&#x2937; Deletar</li>
          </li>
        </ul>
      </nav>
    </aside>

    <main class="corpo"><div class="conteudo">
        <section>
          <h3><i class="fa fa-info-circle" aria-hidden="true"></i> Listar Disciplinas</h3>
        </section>

        <table>
            <tr><th>Nome</th><th>Sigla</th><th>Carga Horária</th><th>Ações</th></tr>
            <?php
            $arqDisc=fopen("disciplinas.txt", "r") or die ("erro ao abrir o arquivo!");
            $index=0;
            $temDisc=false;
            while(($linha=fgets($arqDisc))!==false){
                if($linha==""){
                    continue;
                }
                $coluna = explode(";", $linha);
                if(count($coluna)<3){
                  continue;
                }
                echo "<tr>
                <td>".$coluna[0]."</td>
                <td>".$coluna[1]."</td>
                <td>".$coluna[2]."</td>
                <td>
                    <a class=\"editar\" href='alterar.php?id=".$index."'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i> Editar</a> |
                   <a class=\"deletar\" href='deletar.php?id=".$index."' onclick=\"return confirm('Tem certeza que deseja excluir esta disciplina? Esta ação não poderá ser desfeita.')\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Deletar</a>
                </td>
              </tr>";
                  $index++;
                  $temDisc=true;
            }
            if(!$temDisc){
                echo "<tr><td colspan='4'>Nenhuma disciplina cadastrada.</td></tr>";
            }
            fclose($arqDisc);
            ?>
        </table></div>
      </main>
    </article>
  </body>
</html>