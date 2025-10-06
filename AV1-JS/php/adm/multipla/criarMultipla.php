<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $idp=$_GET["idp"];
    $pergunta=$_GET["pergunta"];
    $opc1=$_GET["opc1"];
    $opc2=$_GET["opc2"];
    $opc3=$_GET["opc3"];
    $resposta=$_GET["resposta"];

    if(!file_exists("../../../perguntasMulti.txt")) {
        $arq=fopen("../../../perguntasMulti.txt","w") or die("erro na criacao do arq");
        fclose($arq);
    }
    $arq=fopen("../../../perguntasMulti.txt","a") or die("erro abertura");

    $linha="$idp;$pergunta;$opc1;$opc2;$opc3;$resposta\n";
    fwrite($arq,$linha);
    fclose($arq);    
    echo "foi";
}
?>