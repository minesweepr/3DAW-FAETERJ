<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=$_POST["id"];
    $idp=$_POST["idp"];
    $novaPergunta=$_POST["pergunta"];
    $novaOpc1=$_POST["opc1"];
    $novaOpc2=$_POST["opc2"];
    $novaOpc3=$_POST["opc3"];
    $novaResposta=$_POST["resposta"];

    $encontrou=false;

    $arq=fopen("../../../perguntasMulti.txt", "r") or die("erro ao abrir arq");
    while(!feof($arq)){
        $linha=trim(fgets($arq));
        if($linha!=""){
            $coluna=explode(";", $linha);
            if(count($coluna)>=6){
                if($coluna[0]==$id){
                    $coluna[0]=$idp;
                    $coluna[1]=$novaPergunta;
                    $coluna[2]=$novaOpc1;
                    $coluna[3]=$novaOpc2;
                    $coluna[4]=$novaOpc3;
                    $coluna[5]=$novaResposta;
                    $encontrou=true;
                }
                $linhas[]=implode(";", $coluna);
            }
        }
    }
    fclose($arq);

    if($encontrou){
        $arq=fopen("../../../perguntasMulti.txt", "w") or die("erro ao abrir arq");
        foreach($linhas as $linha) fwrite($arq, $linha . "\n");
        fclose($arq);
        //https://www.php.net/manual/en/function.json-encode.php perguntar para o professor se pode fzer assim e mostrar ref
        echo json_encode(array("sucesso" => "pergunta alterada"));
    }else{
        //https://www.php.net/manual/en/function.json-encode.php perguntar para o professor se pode fzer assim e mostrar ref
        echo json_encode(array("erro" => "pergunta nao encontrada"));
    }
    exit;
}
?>