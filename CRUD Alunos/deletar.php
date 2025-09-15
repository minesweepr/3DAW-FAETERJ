<?php
if(!isset($_GET['id'])) die;

$id=intval($_GET['id']);
$arqAl=fopen("alunos.txt", "r") or die("erro");
while(!feof($arqAl)) {
    $linha=fgets($arqAl);
    if($linha===false) continue;
    $linha=trim($linha);
    if($linha==="") continue;
    $linhas[]=$linha;
}
fclose($arqAl);

if(!isset($linhas[$id])) die("aluno nao encontrado");

unset($linhas[$id]);
file_put_contents("alunos.txt", implode("\n", $linhas)."\n");
header("Location: listar.php");
exit;
?>