<?php
    include 'conecta.php';
    session_start();
    $perfilPost = $_SESSION["perfil"];

    $stmnt = $conn -> prepare('UPDATE usuario SET saldo = 10000 WHERE perfil = :perfil');
    $stmnt -> execute([":perfil"=>$perfilPost]);
    header('Location: form.php');
    exit();
?>