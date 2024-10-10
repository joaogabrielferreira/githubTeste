<!-- TESTE UNITÁRIO -->

<?php
use PHPUnit\Framework\TestCase; //Importa a classe TestCase para utilizá-la na execução dos testes

require_once 'NumberChecker.php'; //Refereciando do arquivo NumberChecker.php

class NumberCheckerTest extends TestCase //Cria-se uma classe chamado NumberCheckerTest herdando da classe TestCase
{
    public function testIsPositive() //Cria-se uma função pública chamado testIsPositive sem passar nenhum parâmetro
    {
        $checker = new NumberChecker(); //A variável $checker recebe uma instância de uma nova classe chamado NumberChecker

        $this->assertTrue($checker->isPositive(5)); //Verifica se 5 é positivo

        $this->assertFalse($checker->isPositive(-3)); //Verifica se -3 não é positivo

        $this->assertFalse($checker->isPositive(0)); //Verifica se 0 não é positivo
    }
}

//COMO EXECUTAR O TESTE UNITÁRIO
//composer require --dev phpunit/phpunit ^11
//php vendor\bin\phpunit testesphp\NumberCheckerTest.php