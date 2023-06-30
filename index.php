<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scrap Auction</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<main>

<h1>Case</h1>

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

$resultados = array();

foreach ($elementos as $elemento) {
    $domNodeList = $xPath->query($elemento);
    $dados = array();
    
    /** @var DOMNode $node */
    foreach ($domNodeList as $node) {
        $dados[] = $node->nodeValue;
    }
    
    $resultados[] = $dados;
}

  $titulo = $resultados[0][0];
  $avaliacao = $resultados[4][0];
  $data = $resultados[5][0];
  $valorSegunda = $resultados[6][0];
  $endereco = $resultados[1][0];
  $documento = $resultados[3][0];
  $imagem = $resultados[2][0];

  echo "Título: " . $titulo . "<br><br>";
  echo "Avaliacao: " . $avaliacao . "<br><br>";
  echo "Data da primeira avaliacao: " . $data . "<br><br>";
  echo "Valor da Segunda Praca: " . $valorSegunda . "<br><br>";
  echo "Endereco: " . $endereco . "<br><br>";
  echo "Link do documento: <a href= ".$documento. " target='_blank'>". $documento ."</a> <br><br>";
  echo "Link da imagem: <a href=".$imagem. " target='_blank'>". $imagem ."</a> <br><br>";
  echo '<img src="'. $imagem .'"><br>';

?>

</main>

</body>
</html>

