<?php
    //CRIANDO VARIÁVEIS E DECLARANDO ELAS.
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "samueldb";
    //FAZENDO UMA CONEXÃO COM O BANCO DE DADOS E ATRIBUINDO PARA A VARIÁVEL $con.
    $con = mysqli_connect($localhost, $username, $password, $dbname);
    //SE A CONEXÃO COM O BANCO DE DADOS DER ERRO DÊ UM FIM NA CONEXÃO.
    if ($con->connect_error) {
        die ("connection failed:".$con->connect_error);
    }