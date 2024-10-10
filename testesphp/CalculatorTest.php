<!-- TEST-DRIVEN DEVELOPMENT OU TDD -->

<?php
use PHPUnit\Framework\TestCase; //Importa a classe TestCase para utilizá-la na execução dos testes

require_once 'Calculator.php'; //Refereciando do arquivo Calculator.php

class CalculatorTest extends TestCase //Cria-se uma classe chamada CalculatorTest herdando da classe TestCase
{
    public function testAddition() //Cria uma função pública chamado testAddition sem passar nenhum parâmetro
    {
        $calculator = new Calculator(); //A variável $calculator recebe uma instância de uma nova classe chamada Calculator
        $result = $calculator->add(2, 3); //A variável $result recebe a variável $calculator passando como parâmetro a função add com os valores 2 e 3
        $this->assertEquals(5, $result); //Verifica se o valor é igual a 5 
    }
}

//COMO EXECUTAR O TDD
//composer require --dev phpunit/phpunit ^11
//php vendor\bin\phpunit testesphp\CalculatorTest.php