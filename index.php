<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scrap Auction</title>
</head>
<body>

<?php 

libxml_use_internal_errors(true);

$conteudo = file_get_contents('https://agostinholeiloes.com.br/item/1435/detalhes?page=1');

$documento = new DOMDocument();
$documento->loadHTML($conteudo);

$xPath = new DOMXPath($documento);
$domNodeList = $xPath->query('.//*[contains(concat(" ",normalize-space(@class)," ")," container ")][contains(concat(" ",normalize-space(@class)," ")," detalhes-lote ")]//h4/following-sibling::*[1]/self::h4');

/** @var DOMNode $elemento */
foreach ($domNodeList as $elemento) {
  echo $elemento->textContent . PHP_EOL."<br><br>";
}

?>

</body>
</html>