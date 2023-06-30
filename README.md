## Sobre

Este é um projeto criado para coletar dados do site [agostinholeiloes.com.br](https://agostinholeiloes.com.br/), coletando dados da página de detalhes do lote. Atualmente o projeto pega as seguintes informações

- [x]  Título:
- [x]  Valor de Avaliação:
- [x]  Data da Primeira Praça:
- [x]  Valor da Segunda Praça:
- [x]  Endereço:
- [x]  Link de um Documento:
- [x]  Link de uma Imagem:

## Como utilizar

Para utilizar o site, sera necessário colar um link válido, o link deve ser acessado no site [agostinholeiloes.com.br](https://agostinholeiloes.com.br/), ao clicar em um lote desejado, você terá que ir na página de detalhes do lote, nessa página terá a url válida, copiando ela, você poderá colar no site e vizualizar as informações disponíveis.

## Uso/Exemplos

Como esse projeto e para captação de dados, foram utilizados diversos seletores CSS e xPath. Alguns exemplos:
```
--CSS
#carouselImgsLoteGrande > div > div:nth-child(1)

--xPath
//b[contains(text(), "Endereço")]/following-sibling::text()[1]
