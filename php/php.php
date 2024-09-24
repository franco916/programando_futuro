<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bd";
    $port = 3307;

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname, $port);


    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $nome_instituicao = $_POST['nome_instituicao'];
    $nome_representante = $_POST['nome_representante'];
    $tipo_instituicao = $_POST['tipo_instituicao'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $comentario = $_POST['comentario'];

    $sql = "INSERT INTO escolas (nome_instituicao, nome_representante, email, telefone, tipo_instituicao, comentario) 
        VALUES ('$nome_instituicao', '$nome_representante', '$email', '$tel', '$tipo_instituicao', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../p/inscreva.html");
        exit();
    }
    $conn->close();
?>