<?php

// escrever uma frase que motre a data atual
echo " Hoje é dia " . date('d/m/Y');
echo " e agora são " . date('H:i:s');

/*
DESAFIO
1º Na função date(), substitua Y por y e observe o resultado
2º Pesquise como exibir a hora no formato 12 horas (A.M. e P.M.);
3º Exiba o nome do mês atual;

site oficial: php.net

****** VARIÁVEL EM PHP ******
Sempre precedidos de $ e n"ao podem conter caracteres especiais
como: &, +, -, <, >, etc.
$_variavel
$variavel
$_123
$123

Para atribuir um valor a $variavel, utilizamos =, ex:
$carro = fusion;
$cor   = prata;
onde lemos: a variável $carro recebe fusion como valor.

****** SUPERGLOBAIS (PALAVRAS RESERVADAS) ******
$_GET, $_POST, $_FILES, $_SESSION, $_COOKIE, $_REQUEST, $_SERVER, ETC

****** OPERADORES ******
PARA REALIZAÇÃO DE CALCULOS ARITMETICOS UTILIZAMOS:
(+) SOMA;
(-) SUBTRAÇÃO;
(*) MULTIPLICAÇÃO;
(/) DIVISÃO;
(%) RESTO.

DESAFIO 2
1. Utilizando variável e operadores aritmeticos execute os
seguintes calculos e imprima os resultados:
1. Multiplique 10 x 20;
2. Calcule 18 % de 1.900.
3. Utilizando a função de data,calcule a diferença de dias  entre as datas;
28/02/2024 e hoje.

*/


// 1. Multiplique 10 x 20
$produto = 10 * 20;
echo "1. Multiplicação de 10 x 20: $produto\n";

// 2. Calcule 18% de 1.900
$percentual = 18 / 100 * 1900;
echo "2. 18% de 1.900: $percentual\n";

// 3. Calcule a diferença de dias entre 28/02/2024 e 15/08/2024
$data1 = new DateTime('2024-02-28');
$data2 = new DateTime('2024-08-15');
$intervalo = $data1->diff($data2);
$diferencaDias = $intervalo->days;

// Se a data1 for no futuro em relação à data2, a diferença é positiva
// O método diff calcula a diferença sempre como um valor positivo
echo "3. Diferença de dias entre 28/02/2024 e 15/08/2024: $diferencaDias dias\n";
?>
