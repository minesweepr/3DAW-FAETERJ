<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email=$_SESSION['email'];
    $arquivo=fopen("../respostas.txt", "a") or die("erro a 1");
    $arqTexto=fopen("../perguntasTexto.txt", "r") or die("erro r 1");
    $index=1;
    while (($linha=fgets($arqTexto))!==false){
        if($linha=="")continue;
        $coluna=explode(";", trim($linha));
        if(count($coluna)<2) continue;
        $pergunta=$coluna[1];
        $respostaUsu="respostaT_".$index;
        $resposta=isset($_POST[$respostaUsu])?trim($_POST[$respostaUsu]) : "";
        fwrite($arquivo, "$email;$pergunta;$resposta\n");
        $index++;
    }
    fclose($arqTexto);

    $arqMulti=fopen("../perguntasMulti.txt", "r") or die("erro r 2");
    $index=1;
    while (($linha=fgets($arqMulti))!==false){
        if($linha=="") continue;
        $coluna=explode(";", trim($linha));
        if(count($coluna)<6)continue;
        $pergunta=$coluna[1];
        $respostaUsu="respostaM_".$index;
        $resposta=isset($_POST[$respostaUsu])?trim($_POST[$respostaUsu]) : "";
        fwrite($arquivo, "$email;$pergunta;$resposta\n");
        $index++;
    }
    fclose($arqMulti);
    fclose($arquivo);
    echo "sucesso";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>questionario</title>
</head>

<body>
    <main>
        <h1>questionario</h1>
        <fieldset>
        <legend>perguntas textuais</legend>
        <form action="questionario.php" method="POST">
            <?php
            $arqTexto=fopen("../perguntasTexto.txt", "r") or die ("erro");
            $index=1;
            $existe=false;
            while(($linha=fgets($arqTexto))!==false){
                if($linha=="")continue;
                
                $coluna=explode(";", trim($linha));
                if(count($coluna)<2)continue;
                
                echo "<p>".$index."- ".$coluna[1]."</p>
                <textarea name='respostaT_".$index."' rows='4' cols='50'></textarea><br><br>";

                $index++;
                $existe=true;
            }
            if(!$existe)echo "nenhuma pergunta cadastrado.";
            
            fclose($arqTexto);
            ?>
            </fieldset>

            <fieldset>
            <legend>perguntas de multipla escolha</legend>
            <?php
            $arqMulti=fopen("../perguntasMulti.txt", "r") or die ("erro");
            $index=1;
            $existe=false;
            while(($linha=fgets($arqMulti))!==false){
                if($linha=="")continue;
                
                $coluna=explode(";", trim($linha));
                if(count($coluna)<6)continue;
                
                echo "<p>".$index."- ".$coluna[1]."</p>";

                echo "<input type='radio' name='respostaM_".$index."' value='".$coluna[2]."' id='respostaM_{".$index."}_1'>
                <label for='respostaM_{".$index."}_1'>".$coluna[2]."</label><br>
                <input type='radio' name='respostaM_".$index."' value='".$coluna[3]."' id='respostaM_{".$index."}_2'>
                <label for='respostaM_{".$index."}_2'>".$coluna[3]."</label><br>
                <input type='radio' name='respostaM_".$index."' value='".$coluna[4]."' id='respostaM_{".$index."}_3'>
                <label for='respostaM_{".$index."}_3'>".$coluna[4]."</label><br>";

                $index++;
                $existe=true;
            }
            if(!$existe)echo "nenhuma pergunta cadastrado.";
            
            fclose($arqMulti);
            ?>
            </fieldset>
            <button type="submit" value="Submit">enviar</button>
        </form>
      </main>
  </body>
</html>