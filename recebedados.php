<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MINES</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="blur"></div>
    <?php
        include 'conecta.php';

        session_start();
        $perfilPost = $_SESSION["perfil"];

        if (isset($_POST["escolhas"])) {

            $stmnt = $conn -> prepare('SELECT saldo FROM usuario WHERE perfil = :perfil');
            $stmnt -> execute([":perfil"=>$perfilPost]);
            $saldo = $stmnt->fetch();

            $stmnt = $conn -> prepare('UPDATE usuario SET saldo = :novoSaldo WHERE perfil = :perfil');

            $valor = $_POST["valor"];
            $posicaoBombas = $_POST["posicaoBombas"];
            $escolhas = $_POST["escolhas"];
            
            $venceu = true;

            foreach ($posicaoBombas as $pos) {

                foreach ($escolhas as $escolha) {
                    if ($pos == $escolha) {
                        $venceu = false;
                    }
                }
                
            }

            $probabilidade = 1;
            $numEscolhas = count($escolhas);
            $numPosicoes = count($posicaoBombas);

            for ($i = 0; $i < $numEscolhas; $i++) {
                $probabilidade *= (25 - $numPosicoes - $i) / (25 - $i);
            }

            $multiplicador = (1 / $probabilidade) * 0.80; 
        }

  
    ?>
    <header>
        <h1>MINES - <?php echo($perfilPost);?></h1>
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
        <?php
            if (isset($_POST["escolhas"])) {
                
                echo <<<HTML

                    <form action="#" class="resultado">
                        <div class="grid">
                HTML;
            
                $alfabeto = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

                
                $numBombas = $_POST["numBombas"];
                $totalQuadrados = 25;
                $quadradosVazios = $totalQuadrados - $numBombas;

                
                for ($i=0; $i < 25; $i++) { 

                    echo ("<input type='checkbox' name='escolhas[]' id='$alfabeto[$i]' value='$i' ");

                    foreach ($escolhas as $escolha) {
                        if ($escolha == $i) {
                            echo(" checked ");
                        }
                    }
                    
                    foreach ($posicaoBombas as $pos) {
                        if ($pos == $i) {
                            echo ("class='bomba'");
                        }
                    }
                    
                    echo ("><label class='campo revelado' for='$alfabeto[$i]'></label>");
                    
                }

                echo <<<HTML
                        </div>
                        <button type="submit" class="botao" style="pointer-events:none">Resgatar</button>
                        
                        <a href="form.php" class="botao" style="pointer-events:none">Abandonar partida</a>
                        </form>
                    HTML;
    
                if ($venceu == true) {

                    $saldo[0] -= $valor;

                    $multiplicador = round($multiplicador, 2);
                    $valorFinal = $valor * $multiplicador;
                    $valorFinal = round($valorFinal, 2);
                    $novoSaldo = $saldo[0] + $valorFinal;
                    $novoSaldo = round($novoSaldo,2);

                    $lucro = $valorFinal - $valor;

                    $stmnt -> execute([':novoSaldo'=>$novoSaldo,":perfil"=>$perfilPost]);

                    echo <<<HTML
                        <div class="painel mensagem">
                            <h2>Parabéns</h2>
                            <div>
                                <p>Valor inicial: R$ $valor</p>
                                <p>Multiplicador: $multiplicador</p>
                                <p>Valor final: R$ $valorFinal</p>
                                <p>Lucro: R$ $lucro</p>
                            </div>

                            <a href="form.php" class="botao">Reiniciar</a>
                        </div>
                    HTML;
                } else {

                    $novoSaldo = $saldo[0] - $valor;

                    $stmnt -> execute(['novoSaldo'=>$novoSaldo,":perfil"=>$perfilPost]);

                    echo <<<HTML
                        <div class="painel mensagem">
                            <h2>Você perdeu</h2>
                            <a href="form.php" class="botao">Reiniciar</a>
                        </div>

                    HTML;
                }
            } else {
                echo <<<HTML
                    <section class="painel mensagem">
                        <h1>Nenhum campo foi selecionada</h1>
                    </section>
                HTML;
            }
        ?>
    </main>
    <footer>
        <a href="https://www.instagram.com/303_internet.cedup/" target="_blank">Instagram da turma</a>
        <br>
        <a href="index.php">Sair</a>
    </footer>
    
</body>
</html>