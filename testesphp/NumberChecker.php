<!-- TESTE UNITÁRIO -->

<?php
class NumberChecker //Cria-se uma classe chamada NumberChecker
{
    public function isPositive($number) //Cria-se uma função pública chamado isPositive passando como parâmetro uma variável chamado $number
    {
        return $number > 0; //Retorna um valor um valor se a variável $number for maior que 0
    }
}