<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scrap Auction</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<?php 
$link = $_GET['link'] ?? '';
?>
<main>

<img src="logo.png" class="logo" alt="Agostinho Leilões">

<br>

<p><b>Observação:</b> O link deve ser da página do lote, onde possui todas informações disponíveis e deve seguir o padrão de rotas do site, contendo /item/idDoLote/detalhes?page=1
</p>


<form action="<?=$_SERVER['PHP_SELF'] ?>" method="get">
      <label for="link">Link do lote:</label>
      <input type="text" name="link" id="idLink" value="<?=$link?>" placeholder="Ex: https://agostinholeiloes.com.br/item/????/detalhes?page=1">
      <input type="submit" value="Buscar"></input>
</form>

<br>
<?php

$padrao = '/^https:\/\/agostinholeiloes.com.br\/item\/\d+\/detalhes\?page=\d+$/';

if (!empty($link)) {
  if (preg_match($padrao, $link) === 1) {
    exibirFuncao();
  } else {
    echo "<br><p>O link não corresponde ao padrão.</p>";
  }
} 

function exibirFuncao(){

global $link;

libxml_use_internal_errors(true);

$conteudo = file_get_contents("$link");

$documento = new DOMDocument();
$documento->loadHTML($conteudo);

$xPath = new DOMXPath($documento);

$elementos = [
    './/*[contains(concat(" ",normalize-space(@class)," ")," container ")][contains(concat(" ",normalize-space(@class)," ")," detalhes-lote ")]//h4/following-sibling::*[1]/self::h4',
    '//strong[contains(text(), "Valor de Avaliação:")]/following-sibling::text()[1]',
    '//*[@id="carouselImgsLoteGrande"]/div/div[1]/a/@href',
    './/*[contains(concat(" ",normalize-space(@class)," ")," arquivos-lote ")]//p//a/@href',
    '//b[contains(text(), "Endereço")]/following-sibling::text()[1]',
    '//strong[contains(text(), "Data 1º Leilão:")]/following-sibling::text()[1]',
    '//h6[strong[contains(text(), "Data 2º Leilão")]]/following-sibling::*[1]/strong/following-sibling::text()[1]',
    '//b[contains(text(), "Cidade:")]/following-sibling::text()[1]'
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

$titulo = !empty($resultados[0][0]) ? $resultados[0][0] : "Informação indisponível";
$avaliacao = !empty($resultados[1][0]) ? $resultados[1][0] : "Informação indisponível";
$data = !empty($resultados[5][0]) ? $resultados[5][0] : "Informação indisponível";
$valorSegunda = !empty($resultados[6][0]) ? $resultados[6][0] : "Informação indisponível";
$endereco = !empty($resultados[4][0]) ? $resultados[4][0] : "Informação indisponível";
$documento = !empty($resultados[3][0]) ? $resultados[3][0] : "Informação indisponível";
$imagem = !empty($resultados[2][0]) ? $resultados[2][0] : "Informação indisponível";
$cidade = !empty($resultados[7][0]) ? $resultados[7][0] : "Informação indisponível";

  echo "<b>Título:</b> ". $titulo . "<br><br>";
  echo "<b>Avaliação:</b> " . $avaliacao . "<br><br>";
  echo "<b>Data da primeira Praça:</b> " . $data . "<br><br>";
  echo "<b>Valor da Segunda Praça:</b> " . $valorSegunda . "<br><br>";
  echo "<b>Endereço:</b> " . $endereco. " - " .$cidade. "<br><br>";

  if($documento !== "Informação indisponível"){
    echo "<b>Link do documento:</b> <a href= ".$documento. " target='_blank'>". $documento ."</a> <br><br>";
  }else{
    echo "<b>Link do documento:</b> " . $documento . "<br><br>";
  }
  

  if($imagem !== "Informação indisponível"){
    echo "<b>Link da imagem:</b> <a href= ".$imagem. " target='_blank'>". $imagem ."</a> <br><br>";
    echo '<img src="'. $imagem .'"><br>';
  }else{
    echo "<b>Link da imagem:</b> " . $imagem . "<br><br>";
  }
}
?>

</main>

</body>
</html>

