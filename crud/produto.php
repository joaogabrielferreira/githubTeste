<?php //Conexão com o banco de dados.
$obj_mysqli = new mysqli("127.0.0.1", "root", "", "tutocrudphp");

if ($obj_mysqli->connect_errno)
{
    echo "Ocorreu um erro na conexão com o banco de dados.";
    exit;
}

mysqli_set_charset($obj_mysqli, 'utf8');

$id = -1; //Criando as variáveis.
$nome = "";
$marca = "";
$origem = "";
$unidademedida = "";

if(isset($_POST["nome"]) && isset($_POST["marca"]) && isset($_POST["origem"]) && isset($_POST["unidademedida"]))
{
    if(empty($_POST["nome"]))
        $erro = "Campo nome do produto obrigatório";

    elseif(empty($_POST["marca"])) //Caso o campo marca esteja vazio ele se chamará "Genérico".
        $marca = "Genérico";

    elseif(empty($_POST["origem"]))
        $erro = "Campo origem do produto obrigatório";

    elseif(empty($_POST["unidademedida"]))
        $erro = "Campo unidade de medida obrigatório";

    else
    {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $marca = $_POST["marca"];
        $origem = $_POST["origem"];
        $unidademedida = $_POST["unidademedida"];

        if($id == -1)
        {
            $stmt = $obj_mysqli->prepare("INSERT INTO `produto` (`nome`, `marca`, `origem`, `unidademedida`) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $nome, $marca, $origem, $unidademedida);

                if(!stmt->execute())
                {
                    $erro = $stmt->error;
                }
                else
                {
                    header("Location:produto.php");
                    exit;
                }
            }    
                elseif(is_numeric($id) && $id >= 1)
                {
                    $stmt = $obj_mysqli->prepare("UPDATE `produto` SET `nome`=?, `marca`=?, `origem`=?, `unidademedida`=? WHERE id = ?");
                    $stmt->bind_param('ssssi', $nome, $marca, $origem, $unidademedida, $id);

                    if(!stmt->execute())
                {
                    $erro = $stmt->error;
                }
                else
                {
                    header("Location:produto.php");
                    exit;
                }
        
            }

            {
                $erro = "Número inválido";
            }
    }
}
elseif(isset($_GET["id"]) && is_numeric($_GET["id"]))
{
    $id = (int)$_GET["id"];

    if(isset($_GET["del"]))
    {
        $stmt = $obj_mysqli->prepare("DELETE FROM `produto` WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        header("Location:produto.php");
        exit;
    }
    else
    {
        $stmt = $obj_mysqli->prepare("SELECT * FROM `produto` WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
            $aux_query = $result->fetch_assoc();

        $nome = $aux_query["Nome_prod"];
        $marca = $aux_query["Marca_prod"];
        $origem = $aux_query["Origem_prod"];
        $unidademedida = $aux_query["Unidade_medida"];

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
</head>
<body>
    <?php
    if(isset($erro))
        echo '<div style="color:#F00">' .$erro. '</div><br><br>';
    elseif(isset($sucesso))
        echo '<div style="color:#00f">' .$sucesso. '</div><br><br>';
    ?>
    <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
        <h1>Cadastro de produto</h1>
        <input type="text" name="nome" placeholder="Nome do produto" value="<?=$nome?>"><br><br>
        <input type="text" name="marca" placeholder="Marca do produto" value="<?=$marca?>"><br><br>
        <input type="text" name="origem" placeholder="Origem do produto" value="<?=$origem?>"><br><br>
        <input type="text" name="unidademedida" placeholder="Unidade de medida do produto" value="<?=$unidademedida?>">
        <input type="hidden" value="<?=id?>" name="id">
        <button type="submit"><?=($id==-1)?"Cadastrar":"Salvar"?></button>
    </form>
    <br>
    <br>
    <table width="400px" border="1" cellspacing="0">
        <tr>
            <td><strong>#</strong></td>
            <td><strong>Nome do produto</strong></td>
            <td><strong>Marca</strong></td>
            <td><strong>Origem</strong></td>
            <td><strong>Unidade de medida</strong></td>
            <td><strong>#</strong></td>
        </tr>
        <?php
        $result = $obj_mysqli->query("SELECT * FROM `produto`");
        while ($aux_query = $result->fetch_assoc())
        {
            echo '<tr>';
            echo '<td>' .$aux_query["Id_prod"]. '</td>';
            echo '<td>' .$aux_query["Nome_prod"]. '</td>';
            echo '<td>' .$aux_query["Marca_prod"]. '</td>';
            echo '<td>' .$aux_query["Origem_prod"]. '</td>';
            echo '<td>' .$aux_query["Unidade_medida"]. '</td>';
            echo '<td><a href="' .$_SERVER["PHP_SELF"]. '?id=' .$aux_query["Id_prod"].'">Editar</a></td>';
            echo '<td><a href="' .$_SERVER["PHP_SELF"]. '?id=' .$aux_query["Id_prod"].'&del=true">Excluir</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>