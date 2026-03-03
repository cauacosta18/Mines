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
        session_start();
        $perfilPost = $_SESSION["perfil"];
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll("input[type='checkbox'].bomba");
            const form = document.querySelector("form");

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    if (this.checked) {
                       
                        form.submit();
                        
                    }
                });
            });
        });
    </script>
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

            echo <<<HTML
                <form action="recebedados.php" method="post">
                    <div class="grid">
            HTML;
        
                
            include 'conecta.php';

            $alfabeto = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

            
            $numBombas = $_POST["numBombas"];
            $valor = $_POST["valor"];
            $totalQuadrados = 25;
            $quadradosVazios = $totalQuadrados - $numBombas;
            $posicaoBombas = [];
            $valoresAnteriores = [];

            for ($i=0; $i < $numBombas; $i++) {

                $novaPosicao = rand(0, 24);
                
                foreach ($valoresAnteriores as $valorAnterior) {
                    while ($valorAnterior == $novaPosicao) {
                        $novaPosicao = rand(0, 24);
                    }
                }
                
                $posicaoBombas[$i] = $novaPosicao;

                $valoresAnteriores[$i] = $posicaoBombas[$i];
                
            }
            for ($i=0; $i < 25; $i++) { 

                echo ("<input type='checkbox' name='escolhas[]' id='$alfabeto[$i]' value='$i' ");
                
                foreach ($posicaoBombas as $pos) {
                    if ($pos == $i) {
                        echo ("class='bomba'");
                    }
                }
                
                echo ("><label class='campo' for='$alfabeto[$i]'></label>");
                
            }
            for ($i=0; $i < $numBombas; $i++) { 
                echo <<<HTML
                    <input type="checkbox" name="posicaoBombas[]" id="$posicaoBombas[$i]" value="$posicaoBombas[$i]" checked hidden>
                HTML;
            }

            echo <<<HTML
                <input type="number" name="valor" value="$valor" hidden>   
                
                <input type="number" name="numBombas" value="$numBombas" hidden>
                
                </div>
                
                <button type="submit" class="botao">Resgatar</button>
                
                <a href="form.php" class="botao">Abandonar partida</a>
                
                </form>
            HTML;
            
        ?>
    </main>
    <footer>
        <a href="https://www.instagram.com/303_internet.cedup/" target="_blank">Instagram da turma</a>
        <br>
        <a href="index.php">Sair</a>
    </footer>
    
</body>
</html>