<?php

    include 'conecta.php';

    $stmt = $conn -> prepare("SELECT perfil FROM usuario;");
    $stmt2 = $conn -> prepare("SELECT COUNT(perfil) FROM usuario;");

    $stmt -> execute([]);
    $stmt2 -> execute([]);

    $perfis = $stmt -> fetchAll();
    $numPerfis = $stmt2 -> fetch();

    $perfilPost = $_POST["perfil"];

    if ($numPerfis > 0) {
        foreach ($perfis as $perfil) {
            if ($perfil[0] == $perfilPost) {
                session_start();
                $_SESSION['perfil'] = $perfilPost;
                header("Location: form.php");
                exit();
            }
        }
        $stmt = $conn -> prepare("INSERT INTO usuario (perfil) VALUES (:perfil);");

        $stmt -> execute([":perfil"=>$perfilPost]);

        session_start();
        $_SESSION['perfil'] = $perfilPost;
        header("Location: form.php");
        exit();
    } else {
        $stmt = $conn -> prepare("INSERT INTO usuario (perfil) VALUES (:perfil);");

        $stmt -> execute([":perfil"=>$perfilPost]);

        session_start();
        $_SESSION['perfil'] = $perfilPost;

        header("Location: form.php");
        exit();
    }

?>