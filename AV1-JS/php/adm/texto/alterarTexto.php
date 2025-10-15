<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id=$_POST["id"];
    $idp=$_POST["idp"];
    $novaPergunta=$_POST["pergunta"];
    $encontrou=false;

    $arq=fopen("../../../perguntasTexto.txt", "r") or die("erro ao abrir arq");
    while(!feof($arq)){
        $linha=trim(fgets($arq));
        if($linha!=""){
            $coluna=explode(";", $linha);
            if(count($coluna)>=2){
                if($coluna[0]==$id){
                    $coluna[0]=$idp;
                    $coluna[1]=$novaPergunta;
                    $encontrou=true;
                }
                $linhas[]=implode(";", $coluna);
            }
        }
    }
    fclose($arq);

    if($encontrou){
        $arq=fopen("../../../perguntasTexto.txt", "w") or die("erro ao abrir arq");
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