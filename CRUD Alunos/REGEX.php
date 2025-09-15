<?php
$erroEmail=$erroNome=$erroMatricula="";
$matricula=$nome=$email="";

//checagem com REGEX inicio
if (empty($_POST["nome"])) $erroNome="nome nao pode ser vazio";
else {
$nome=$_POST["nome"];
    if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) $erroNome="nome invalido";
}

if (empty($_POST["email"])) $erroEmail="email nao pode ser vazio";
else {
$email=$_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erroEmail="email invalido";
}

if (empty($_POST["matricula"])) $erroMatricula="matricula nao pode ser vazia";
else {
$matricula=$_POST["matricula"];
    if (!preg_match('/^\d+$/',$matricula)) $erroMatricula="matricula invalida";
}
    //checagem com REGEX fim
?>