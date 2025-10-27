<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>sistema corporativo</title> 
  <link rel="stylesheet" href="../../../css/geral.css"> 
  <link rel="stylesheet" href="../../../css/tabela.css"> 
  <link rel="stylesheet" href="../../../css/form.css"> 
</head>

<body>
    <nav>
        <ul>
          <li><a href="../../adm/listarPerguntas.php">inicio</a></li>
        
          <li>
            <a href="#">discursivas ▼</a>
            <ul>
              <li><a href="../../../html/adm/texto/AlterarExibirTexto.html">alterar/exibir uma pergunta</a></li>
              <li><a href="../../../html/adm/texto/criarTexto.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">multipla escolha ▼</a>
            <ul>
              <li><a href="../../../html/adm/multipla/AlterarExibirMultipla.html">alterar/exibir uma pergunta</a></li>
              <li><a href="../../../html/adm/multipla/criarMultipla.html">criar pergunta</a></li>
            </ul>
          </li>
      
          <li>
            <a href="#">usuários ▼</a>
            <ul>
              <li><a href="../../adm/usuario/listarUsu.php">listar usuários</a></li>
              <li><a href="../../adm/usuario/listarUmUsu.php">exibir um usuário</a></li>
              <li><a href="../../../html/adm/usuario/criarUsu.html">criar usuário</a></li>
            </ul>
          </li>
      
          <li class="sair"><a href="../../../index.php">sair</a></li>
        </ul>
    </nav>

    <main>
        <h1>Listar todas os usuarios</h1>
        <table>
            <tr><th>nome</th><th>email</th><th>senha</th><th>Funcionalidades</th></tr>
            <?php
            $servidor="localhost";
            $username="root";
            $senha="";
            $database="3daw";

            $conn=new mysqli($servidor, $username, $senha, $database);
            if($conn->connect_error) die(json_encode("erro de conexão ".$conn->connect_error));
            //só para ter crtz pq eu tava tendo um erro em relação a isso
            $conn->set_charset("utf8mb4");

            $sql="SELECT id, nome, email, senha FROM usuario ORDER BY id ASC";
            $resultado=$conn->query($sql);

            if($resultado->num_rows>0){
                while($row=$resultado->fetch_assoc()){
                    echo "<tr>
                    <td>".$row['nome']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['senha']."</td>
                    <td>
                        <a href='alterarUsu.php?id=".$row['id']."'>alterar</a> | 
                        <a href='excluirUsu.php?id=".$row['id']."' onclick=\"return confirm('tem certeza que deseja excluir este usuario?')\">excluir</a>
                    </td>
                    </tr>";
                }
            } else echo "<tr><td colspan='4'>nenhum usuario cadastrado.</td></tr>";
            $conn->close();
            ?>

        </table>
      </main>
  </body>
</html>