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

$elementos = [
    './/*[contains(concat(" ",normalize-space(@class)," ")," container ")][contains(concat(" ",normalize-space(@class)," ")," detalhes-lote ")]//h4/following-sibling::*[1]/self::h4',
    '//*[@id="lote_1435"]/div[4]/div[1]/div[2]/div[1]/text()[3]',
    '//*[@id="carouselImgsLoteGrande"]/div/div[1]/a/@href',
    '//*[@id="lote_1435"]/div[3]/div[7]/p[1]/a/@href',
    '//*[@id="lote_1435"]/div[3]/div[3]/h6[3]/text()',
    '//*[@id="lote_1435"]/div[3]/div[3]/h6[5]/text()',
    '//*[@id="lote_1435"]/div[3]/div[3]/h6[8]/text()'
];

foreach ($elementos as $elemento) {
    $domNodeList = $xPath->query($elemento);
    
    /** @var DOMNode $node */
    foreach ($domNodeList as $node) {
        $value = $node->nodeValue;
        
        if (strpos($elemento, 'a/@href') !== false) {
            echo "<a href=".$value." target='_blank'>". $value ."</a> <br><br>";

        } else {
            echo $value.PHP_EOL."<br><br>";
        }
    }
}

?>

</body>
</html>