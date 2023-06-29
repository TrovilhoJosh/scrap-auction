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
$domNodeList2 = $xPath->query('//*[@id="lote_1435"]/div[4]/div[1]/div[2]/div[1]/text()[3]');
$domNodeList3 = $xPath->query('//*[@id="carouselImgsLoteGrande"]/div/div[1]/a/@href');
$domNodeList4 = $xPath->query('//*[@id="lote_1435"]/div[3]/div[7]/p[1]/a/@href');
$domNodeList5 = $xPath->query('//*[@id="lote_1435"]/div[3]/div[3]/h6[3]/text()');
$domNodeList6 = $xPath->query('//*[@id="lote_1435"]/div[3]/div[3]/h6[5]/text()');
$domNodeList7 = $xPath->query('//*[@id="lote_1435"]/div[3]/div[3]/h6[8]/text()');



/** @var DOMNode $elemento */
foreach ($domNodeList as $elemento) {
  echo $elemento->textContent . PHP_EOL."<br><br>";
}
/** @var DOMNode $elemento2 */
foreach ($domNodeList2 as $elemento2) {
  echo $elemento2->textContent . PHP_EOL."<br><br>";
}
/** @var DOMNode $elemento3 */
foreach ($domNodeList3 as $elemento3) {
  $valor = $elemento3->nodeValue;
  echo "<img src=".$valor."> <br><br>";
  echo $valor."<br><br>";
}
/** @var DOMNode $elemento4 */
foreach ($domNodeList4 as $elemento4) {
  $valor = $elemento4->nodeValue;
  echo "<a href=".$valor."> Acessar Documento </a> <br><br>";
}
/** @var DOMNode $elemento5 */
foreach ($domNodeList5 as $elemento5) {
  echo $elemento5->textContent . PHP_EOL."<br><br>";
}
/** @var DOMNode $elemento6 */
foreach ($domNodeList6 as $elemento6) {
  echo $elemento6->textContent . PHP_EOL."<br><br>";
}
/** @var DOMNode $elemento7 */
foreach ($domNodeList7 as $elemento7) {
  echo $elemento7->textContent . PHP_EOL."<br><br>";
}

?>

</body>
</html>