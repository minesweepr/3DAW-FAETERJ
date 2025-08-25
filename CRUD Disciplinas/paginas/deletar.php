<?php
if(!isset($_GET['id'])){
    die;
}
$id=intval($_GET['id']);
$arqDisc=fopen("disciplinas.txt", "r") or die("Erro ao abrir o arquivo!");
while(!feof($arqDisc)) {
    $linha=fgets($arqDisc);
    if($linha===false) continue;
    $linha=trim($linha);
    if($linha==="") continue;
    $linhas[]=$linha;
}
fclose($arqDisc);

if(!isset($linhas[$id])){
    die("Disciplina não encontrada!");
}
unset($linhas[$id]);
file_put_contents("disciplinas.txt", implode("\n", $linhas)."\n");
header("Location: listar.php");
exit;
?>
