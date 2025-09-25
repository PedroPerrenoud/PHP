O programa pede 13 digitos (Números)
Análisa e retorna se o código é valido ou não
  O usuário pode inserir quantos digitos quiser, o programa quem pega os 13 primeiros.
  Faz o cálculo do dígito verificador e Retorna:
    "OK" ou "Recusado"
  O último dígito é guardado para comparação

Exemplo:
  Código 7891000315507
  Os dígitos são multiplicados por 1 e por 3 em sequência repetitiva
    7 * 1 = 7
    8 * 3 = 24
    9 * 1 = 9
    1 * 3 = 3
    0 * 1 = 0
    0 * 3 = 0
    0 * 1 = 0
    3 * 3 = 9
    1 * 1 = 1
    5 * 3 = 15
    5 * 1 = 5
    0 * 3 = 0

  Somando o resultado das multiplicações encontra-se o total de 73
  O valor da soma deve ser dividido por 10
    73/10 = 7.3
  
  Transforme o resultado em inteiro, arredondando para baixo
    7.3 = 7
  
  Some ao resultado da divisão o valor 1
    7 + 1 = 8

  Multiplique o resultado por 10
    8 * 10 = 80
  
  Subtraia desse resultado o valor da soma inicial das multiplicações
    80 - 73 = 7

  O digito verificador é 7 (Último da lista) e o resultado dessas contas é 7 ( 7 == 7 ) então o código 7891000315507 está correto