<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
    $id=$_GET["id"];
    $resp=array();

    $arq=fopen("../../../perguntasMulti.txt","r") or die("erro ao abrir arq");
    while(!feof($arq)){
        $linha=trim(fgets($arq));
        if($linha!=""){
            $colunaDados=explode(";", $linha);
            if(count($colunaDados)>=6 && $colunaDados[0]==$id){
                $resp["id"]=$colunaDados[0];
                $resp["pergunta"]=$colunaDados[1];
                $resp["opc1"]=$colunaDados[2];
                $resp["opc2"]=$colunaDados[3];
                $resp["opc3"]=$colunaDados[4];
                $resp["resposta"]=$colunaDados[5];
                break;
            }
        }
    }
    fclose($arq);
    if(empty($resp)) $resp["erro"]="a pergunta nao foi encontrada";

    $jPerguntas=json_encode($resp, JSON_UNESCAPED_UNICODE);
    echo $jPerguntas;
    exit;
}
?>