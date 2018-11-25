<?php
session_start();
error_reporting(1);
unset($_SESSION['emailEnviado']);
$_SESSION['emailEnviado'] = true;

require_once("includes/conexao.php"); //CONEXÃO COM A BASE DE DADOS
require_once("ac/ActiveCampaign.class.php"); //BIBLIOTECA ACTIVE CAMPAIGN

$universidade = 7; //FACULDADE
$campanha = 4; //CAMPANHA

//SELECIONA A CAMPANHA E CRIA AS CONFIGURAÇÕES PARA AUTOMAÇÃO
$sqlcamp = "SELECT * FROM campanha WHERE id_campanha = " . $campanha;
$resultcamp = mysqli_query($sqlconex, $sqlcamp);
$rowscamp = $resultcamp->fetch_assoc();
$status = $rowscamp['campanha_status'];

//SELECIONA A UNIVERSIDADE (FACULDADE) E CRIA AS CONFIGURAÇÕES PARA AUTOMAÇÃO
$sqlun = "SELECT * FROM instituicao WHERE id_instituicao = " . $universidade;
$resultun = mysqli_query($sqlconex, $sqlun);
$rowsun = $resultun->fetch_assoc();