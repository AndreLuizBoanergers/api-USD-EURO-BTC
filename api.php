<?php
error_reporting(1);
extract($GET);
$qtd = $_GET['Reais'];
$api = "http://economia.awesomeapi.com.br/json/last/USD-BRL,EUR-BRL,BTC-BRL";

$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $api);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response);
$altaDollar = $json->USDBRL->high;
$baixaDollar = $json->USDBRL->low;
$variacao = $json->USDBRL->varBid;
$compra = $json->USDBRL->bid;
$venda = $json->EURBRL->ask;
$altaEURO = $json->EURBRL->high;
$baixaEURO = $json->EURBRL->low;
$variacaoEURO = $json->EURBRL->varBid;
$compraEURO = $json->EURBRL->bid;
$vendaEURO = $json->EURBRL->ask;
$altaBTC = $json->BTCBRL->high;
$baixaBTC = $json->BTCBRL->low;
$variacaoBTC = $json->BTCBRL->varBid;
$compraBTC = $json->BTCBRL->bid;
$vendaBTC = $json->BTCBRL->ask;


$resultUSD = number_format($qtd * $compra,2,",","");
$resultEURO = number_format($qtd * $compraEURO,2,",","");
$resultBTC = ($qtd/$compraBTC) / 100;

$cotacoes = json_encode(array("REAL"=>array("Reais"=>$qtd, "Qtd Compra"=>$resultUSD, "Alta"=> $altaDollar, "Baixa"=>$baixaDollar,"Compra"=>$compra,"Venda"=>$venda,"Variacao"=>$variacao),"EURO"=>array("Reais"=>$qtd, "Qtd Compra"=>$resultEURO, "Alta"=> $altaEURO, "Baixa"=>$baixaEURO,"Compra"=>$compraEURO,"Venda"=>$vendaEURO,"Variacao"=>$variacaoEURO),"BTC"=>array("Reais"=>$qtd, "Qtd Compra"=>$resultBTC ,"Alta"=> $altaBTC, "Baixa"=>$baixaBTC,"Compra"=>$compraBTC,"Venda"=>$vendaBTC,"Variacao"=>$variacaoBTC)
));

var_dump($cotacoes);
