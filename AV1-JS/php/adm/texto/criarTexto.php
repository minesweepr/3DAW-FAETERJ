<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $idp=$_GET["idp"];
    $pergunta=$_GET["pergunta"];

    if(!file_exists("../../../perguntasTexto.txt")) {
        $arq=fopen("../../../perguntasTexto.txt","w") or die("erro na criacao do arq");
        fclose($arq);
    }
    $arq=fopen("../../../perguntasTexto.txt","a") or die("erro abertura");

    $linha="$idp;$pergunta\n";
    fwrite($arq,$linha);
    fclose($arq);    
    echo "foi";
}
?>