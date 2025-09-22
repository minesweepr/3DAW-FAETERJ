<?php
if(!isset($_GET['id']))die;

$id=intval($_GET['id']);
$arq=fopen("../../usuarios.txt", "r") or die("erro ao abrir o arquivo");
while(!feof($arq)) {
    $linha=fgets($arq);
    if($linha===false) continue;
    $linha=trim($linha);
    if($linha==="") continue;
    $linhas[]=$linha;
}
fclose($arq);
if(!isset($linhas[$id]))die("usuario nao encontrado");

unset($linhas[$id]);
file_put_contents("../../usuarios.txt", implode("\n", $linhas)."\n");
header("Location: listarUsu.php");
exit;
?>