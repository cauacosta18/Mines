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
    <header>
        <h1>MINES - <?php echo($perfilPost);?></h1>
        <nav>
            <ul>
                <li>
                    <a href="form.php">Jogar</a>
                </li>
                <li>
                    <a href="">Como funciona</a>
                </li>
                <li>
                    <a href="senha.php">Admin</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="bloco">
            <div>
                <h2>Como o <strong>MINES</strong> funciona</h2>
                <p>O Mines é um jogo de apostas online, semelhante a um crash game, que utiliza um tabuleiro com 25 quadrados. Nele, o jogador deve clicar nas casas procurando por estrelas, enquanto evita minas (bombas) escondidas. O objetivo é descobrir as estrelas sem detonar as minas.</p>
            </div>
           
        </section>

        <hr>
        <br>

        <section class="painel">
            <h3>Como Jogar:</h3>
            <ul>
                <li>O jogador define o valor da aposta, que pode variar entre R$1 e R$100 por rodada.</li>
                <li>Escolhe a quantidade de minas a ativar no tabuleiro, entre 1 e 25 minas.</li>
                <li>Após configurar, o jogador clica nas casas para tentar encontrar estrelas.</li>
                <li>Cada estrela encontrada aumenta o multiplicador de retorno, que tem um RTP médio de 97%.</li>
            </ul>
        </section>

        <br>
        <hr>

        
        <section class="bloco">
            <div>
                <h3>Probabilidade de Ganhar:</h3>
                <p>Para vencer, o jogador deve clicar em casas que não contenham minas. A probabilidade de encontrar uma casa sem mina depende do número de minas e do total de casas.</p>
                <ul>
                    <li>Total de casas: 25</li>
                    <li>Número de minas: m</li>
                    <li>Número de casas sem minas: 25 &#45; m</li>
                    <li>P - (Probabilidade de acertar uma casa segura)</li>
                </ul>
                <p>A probabilidade de clicar na primeira casa sem mina é:</p>
            </div>
            
<pre class="code">
<code>P = 25 &#45; <span style="text-decoration: underline;"> m </span>
        25</code>
</pre>
        </section>

        <br>
        <hr>
        
        <section class="bloco">
            <div>
                <p>A medida que mais casas são reveladas, maior é a chance do jogador clicar em uma bomba, com isso, baseado no número de bombas e casas reveladas o jogo atribui um multiplicador ao valor investido.</p>
                <p>Para cada escolha, a seguinte equação é realizada</p>
                <ul>
                    <li>Ps - Probabilidade de sucesso (inicia com 1)</li>
                    <li>I - Índice da jogada</li>
                    <li>Ma - Margem da casa</li>
                    <li>Mu - Multiplicador</li>
                </ul>
            </div>
<pre class="code">
<code>Ps = Ps x [ ( <span style="text-decoration: underline;"> 25 - m - I </span> ) ]
            ( 25 - I )</code>
</pre>
        </section>

        <br>
        <hr>
        
        <section class="bloco">
            <div>
                <p>Logo após, para calcular o multiplicador usamos a seguinte fórmula:</p>
            </div>
            
<pre class="code">
<code>Mu = ( <span style="text-decoration: underline;"> 1 </span> ) * Ma
    Ps </code> 
</pre>
        </section>
        
    </main>
    <footer>
        <a href="https://www.instagram.com/303_internet.cedup/" target="_blank">Instagram da turma</a>
        <br>
        <a href="index.php">Sair</a>
    </footer>
</body>
</html>