<!DOCTYPE html>
<?php
    $conexao = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conexao, "tutocrudphp");
    session_start();

    if(!isset($_SESSION["Usuario"]) || !isset($_SESSION["Senha"])) {
        header("Location: login.html");
        exit;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <h3> Logado. <a href="logout.php">Logout</a></h3>
</body>
</html>