<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MINES</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php
        $senha = $_POST["senha"];
        if($senha != "203AMELHOR") {
            header ("Location: senha.php");
            exit();
        }
    ?>
    <header>
        <h1>MINES</h1>
        <nav>
            <ul>
                <li>
                    <a href="form.php">Jogar</a>
                </li>
                <li>
                    <a href="comoFunciona.php">Como funciona</a>
                </li>
                <li>
                    <a href="senha.php">Admin</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="admin.php" method="post" class="painel">
            
            <h4 id="salso">Resetar saldo</h4>
            <a href="reset.php" class="botao">Resetar</a>
            
        </form>
    </main>
    <footer>
        <a href="https://www.instagram.com/303_internet.cedup/" target="_blank">Instagram da turma</a>
        <br>
        <a href="index.php">Sair</a>
    </footer>
</body>
</html>