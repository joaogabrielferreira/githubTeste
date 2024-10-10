<?php
$obj_mysqli = new mysqli("127.0.0.1", "root", "", "tutocrudphp");

if($obj_mysqli->connect_errno)
{
    echo "Ocorreu um erro na conexão com o banco de dados.";
    exit;
}

mysqli_set_charset($obj_mysqli,'utf8'); //Aqui está informando à conexão atual, que os dados serão trabalhados no formato UTF-8.

//Incluímos um código aqui...
$id = -1;
$nome = "";
$email = "";
$cidade = "";
$uf = "";

//Validando a existência dos dados
if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["cidade"]) && isset($_POST["uf"]))
{
    if(empty($_POST["nome"]))
    $erro = "Campo nome obrigatório";

    elseif(empty($_POST["email"]))
    $erro = "Campo e-mail obrigatório";

    else
    {
        //Alterção aqui também.
        //Vamos realizar o cadastro ou alteração dos dados enviados
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $cidade = $_POST["cidade"];
        $uf = $_POST["uf"];

        if($id == -1)
        {

            $stmt = $obj_mysqli->prepare("INSERT INTO `cliente` (`nome`, `email`, `cidade`, `uf`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nome, $email, $cidade, $uf);

            if(!$stmt->execute())
            {
                $erro = $stmt->error;
            }
            else
            {
                header("Location:cadastro.php");
                exit;
            }
        }

        elseif(is_numeric($id) && $id >= 1)
        {
            $stmt = $obj_mysqli->prepare("UPDATE `cliente` SET `nome`=?, `email`=?, `cidade`=?, `uf`=? WHERE id=?");
            $stmt->bind_param('ssssi', $nome, $email, $cidade, $uf, $id);

        if(!$stmt->execute())
        {
            $erro = $stmt->error;
        }
        else
        {
            header("Location:cadastro.php");exit;
        }
    }
        //Retorna um erro.
        else
        {
            $erro = "Número inválido";
        }
    }

}
    else
    //Incluimos este bloco, onde vamos verificar a existência do id passado...
    if(isset($_GET["id"]) && is_numeric($_GET["id"]))
    {
        //..,pegamos aqui o id passado...
        $id = (int)$_GET["id"];

        if(isset($_GET["del"]))
        {

        //...montamos a consulta que será realizada....
            $stmt = $obj_mysqli->prepare("DELETE FROM `cliente` WHERE id = ?");
            //passamos o id como parâmetro, do tipo i = int, inteiro...
            $stmt->bind_param('i',$id);
            //...mandamos executar a consulta...
            $stmt->execute();

            header("Location:cadastro.php");
            exit;

        }
        else
        {
            $stmt = $obj_mysqli->prepare("SELECT * FROM `cliente` WHERE id = ?");
            $stmt->bind_param('i',$id);
            $stmt->execute();

        //...retornamos o resultado, e atribuímos à variável $result...
            $result = $stmt->get_result();
            //...atribuímos o retorno, como um array de valores,
            //por meio do método fetch_assoc, que realiza um associação dos valores em forma de array...
            $aux_query = $result->fetch_assoc();

            $nome = $aux_query["Nome"];
            $email = $aux_query["Email"];
            $cidade = $aux_query["Cidade"];
            $uf = $aux_query["UF"];

            $stmt->close();
            }
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP, de forma simples e fácil</title>
</head>
<body>
    <?php
        if(isset($erro))
            echo'<div style="color:#F00">'.$erro.'</div><br/><br/>';
        elseif(isset($sucesso))
            echo'<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
    ?>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
            Nome: <br>
            <input type="text" name="nome" placeholder="Qual seu nome?" value="<?=$nome?>"><br><br>
            E-mail: <br>
            <input type="email" name="email" placeholder="Qual o seu e-mail?" value="<?=$email?>"><br><br>
            Cidade: <br>
            <input type="text" name="cidade" placeholder="Qual sua cidade?" value="<?=$cidade?>"><br><br>
            UF: <br>
            <input type="text" name="uf" size="2" placeholder="UF" value="<?=$uf?>">
            <br><br>
            <input type="hidden" value="<?=$id?>" name="id">
        <button type="submit"><?=($id==-1)?"Cadastrar":"Salvar"?></button>
        </form>
        <br>
        <br>
        <table width="400px"border="1"cellspacing="0">
            <tr>
                <th><strong>#</strong></th>
                <th><strong>Nome</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Cidade</strong></th>
                <th><strong>UF</strong></th>
                <th><strong>#</strong></th>
            </tr>
                <?php
                $result = $obj_mysqli->query("SELECT * FROM `cliente`");
                while($aux_query = $result->fetch_assoc())
                {
                    echo'<tr>';
                    echo '<td>'.$aux_query["Id"].'</td>';
                    echo '<td>'.$aux_query["Nome"].'</td>';
                    echo '<td>'.$aux_query["Email"].'</td>';
                    echo '<td>'.$aux_query["Cidade"].'</td>';
                    echo '<td>'.$aux_query["UF"].'</td>';
                    echo '<td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["Id"].'">Editar</a></td>';
                    echo '<td><a href="'.$_SERVER["PHP_SELF"].'?id='.$aux_query["Id"].'&del=true">Excluir</a></td>';
                    echo'</tr>';
                }
                ?>
        </table>
        </form>

</body>
</html>