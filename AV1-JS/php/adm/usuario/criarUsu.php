<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $senha=$_POST['senha'];

    if(!file_exists("../../../usuarios.txt")){
        $arq=fopen("../../../usuarios.txt", "w") or die("erro na criacao do arq");
        fclose($arq);
    }
    $arq=fopen("../../../usuarios.txt", "a") or die("erro abertura");
    $linha="$nome;$email;$senha\n";
    fwrite($arq, $linha);
    fclose($arq);
    echo "foi";
}
?>

