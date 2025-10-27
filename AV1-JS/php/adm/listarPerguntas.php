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
          <li><a href="../adm/listarPerguntas.php">inicio</a></li>
        
          <li>
            <a href="#">discursivas ▼</a>
            <ul>
              <li><a href="../../html/adm/texto/AlterarExibirTexto.html">alterar/exibir uma pergunta</a></li>
              <li><a href="../../html/adm/texto/criarTexto.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">multipla escolha ▼</a>
            <ul>
              <li><a href="../../html/adm/multipla/AlterarExibirMultipla.html">alterar/exibir uma pergunta</a></li>
              <li><a href="../../html/adm/multipla/criarMultipla.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">usuários ▼</a>
            <ul>
              <li><a href="../adm/usuario/listarUsu.php">listar usuários</a></li>
              <li><a href="../adm/usuario/listarUmUsu.php">exibir um usuário</a></li>
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
            $servidor="localhost";
            $username="root";
            $senha="";
            $database="3daw";

            $conn=new mysqli($servidor, $username, $senha, $database);
            if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
            //só para ter crtz pq eu tava tendo um erro em relação a isso
            $conn->set_charset("utf8mb4");

            $sql="SELECT id, texto FROM pergunta WHERE tipo='discursiva' ORDER BY id ASC;";
            $resultado=$conn->query($sql);

            if($resultado->num_rows>0){
                while($row=$resultado->fetch_assoc()){
                    echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['texto']."</td>
                    <td>
                        <a href='../../html/adm/texto/AlterarExibirTexto.html?id=".$row['id']."'>alterar</a> | 
                        <a href='excluirPergunta.php?id=".$row['id']."' onclick=\"return confirm('tem certeza que deseja excluir esta pergunta?')\">excluir</a>
                    </td>
                    </tr>";
                }
            } else echo "<tr><td colspan='3'>nenhuma pergunta cadastrada.</td></tr>";
            $conn->close();
            ?>
        </table>

        <h2>perguntas de múltipla escolha</h2>
        <table>
            <tr><th>id</th><th>pergunta</th><th>opção 1</th><th>opção 2</th><th>opção 3</th><th>resposta</th><th>Funcionalidades</th></tr>
            <?php
            $servidor="localhost";
            $username="root";
            $senha="";
            $database="3daw";

            $conn=new mysqli($servidor, $username, $senha, $database);
            if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
            //só para ter crtz pq eu tava tendo um erro em relação a isso
            $conn->set_charset("utf8mb4");

            $sql="SELECT pergunta_multipla.id, pergunta.texto, pergunta_multipla.opc_a, pergunta_multipla.opc_b, pergunta_multipla.opc_c, 
            pergunta_multipla.resposta FROM pergunta_multipla JOIN pergunta ON pergunta_multipla.id = pergunta.id ORDER BY 
            pergunta_multipla.id ASC;";
            $resultado=$conn->query($sql);

            if($resultado->num_rows>0){
                while($row=$resultado->fetch_assoc()){
                    echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['texto']."</td>
                    <td>".$row['opc_a']."</td>
                    <td>".$row['opc_b']."</td>
                    <td>".$row['opc_c']."</td>
                    <td>".$row['resposta']."</td>
                    <td>
                        <a href='../../html/adm/multipla/AlterarExibirMultipla.html?id=".$row['id']."'>alterar</a> | 
                        <a href='excluirPergunta.php?id=".$row['id']."' onclick=\"return confirm('tem certeza que deseja excluir esta pergunta?')\">excluir</a>
                    </td>
                    </tr>";
                }
            } else echo "<tr><td colspan='7'>nenhuma pergunta cadastrada.</td></tr>";
            $conn->close();
            ?>
        </table>

        <h1>lista respostas</h1>
        <table>
            <tr><th>email</th><th>pergunta</th><th>resposta</th></tr>
            <?php
            $servidor="localhost";
            $username="root";
            $senha="";
            $database="3daw";

            $conn=new mysqli($servidor, $username, $senha, $database);
            if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
            //só para ter crtz pq eu tava tendo um erro em relação a isso
            $conn->set_charset("utf8mb4");

            $sql="SELECT usuario.email, pergunta.texto AS pergunta, resposta.resposta FROM resposta JOIN usuario ON resposta.id_usuario=usuario.id 
            JOIN pergunta ON resposta.id_pergunta=pergunta.id ORDER BY resposta.id ASC;";
            $resultado=$conn->query($sql);

            if($resultado->num_rows>0){
                while($row=$resultado->fetch_assoc()){
                    echo "<tr>
                    <td>".$row['email']."</td>
                    <td>".$row['pergunta']."</td>
                    <td>".$row['resposta']."</td></tr>";
                }
            } else echo "<tr><td colspan='3'>nenhuma resposta cadastrada.</td></tr>";
            $conn->close();
            ?>
        </table>
      </main>
  </body>
</html>