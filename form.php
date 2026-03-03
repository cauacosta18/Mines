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
        include 'conecta.php';

        session_start();
        $perfilPost = $_SESSION['perfil'];

        $stmnt = $conn -> prepare('SELECT saldo FROM usuario WHERE perfil = :perfil');
        $stmnt -> execute([":perfil"=>$perfilPost]);
        $saldo = $stmnt->fetch();
 
    ?>
    <header>
        <h1>MINES - <?php echo($perfilPost); ?></h1>
        <nav>
            <ul>
                <li>
                    <a href="">Jogar</a>
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
        <form action="campo.php" method="post" class="painel">
            <?php
                echo <<<HTML
                    <p id="saldo">Saldo: R$ $saldo[0]</p>              
                HTML;
            ?>
            <div class="itemForm">
                <label for="numBombas">Bombas: </label>
                <select name="numBombas" required placeholder="03-20">
                
                    <option value="5">05</option>
                    <option value="6">06</option>
                    <option value="7">07</option>
                    <option value="8">08</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="itemForm">
                <span>R$ </span>
                <input type="number" name="valor" step="0.01" min="0.01" <?php echo" max='$saldo[0]' ";?> required placeholder="000000,00">
            </div>
            <button type="submit" class="botao">Iniciar</button>
            
        </form>
    </main>
    <footer>
        <a href="https://www.instagram.com/303_internet.cedup/" target="_blank">Instagram da turma</a>
        <br>
        <a href="index.php">Sair</a>
    </footer>
</body>
</html>