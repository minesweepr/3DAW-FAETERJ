<?php
if(!isset($_GET['id']))die;

$id=intval($_GET['id']);
$arq=fopen("../../../perguntasMulti.txt", "r") or die("erro ao abrir o arquivo");
while(!feof($arq)) {
    $linha=fgets($arq);
    if($linha===false) continue;
    $linha=trim($linha);
    if($linha==="") continue;
    $linhas[]=$linha;
}
fclose($arq);
if(!isset($linhas[$id]))die("pergunta nao encontrada");

unset($linhas[$id]);
file_put_contents("../../../perguntasMulti.txt", implode("\n", $linhas)."\n");
header("Location: ../listarPerguntas.php");
exit;
?>