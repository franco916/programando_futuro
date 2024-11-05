<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Registro</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body {
            background-color: #ffffff;
            padding-top: 20px;
        }
        .bg-blue {
            background-color: #004aad;
        }
    </style>
</head>
<body>

    <!-- Menu de navegação -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand mx-auto" href="/">PROGRAMANDO O FUTURO</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="../index.html">Início</a></li>
                        <li class="nav-item"><a class="nav-link" href="contato.html">Quem Somos</a></li>
                        <li class="nav-item"><a class="nav-link" href="inscreva.html">Inscreva-se</a></li>
                        <li class="nav-item"><a class="nav-link" href="admin.html">Admin</a></li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br><br>

    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bd";
        $port = 3307;

        // Verificar se o ID foi passado na URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Criar conexão com o banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname, $port);

            // Verificar a conexão
            if ($conn->connect_error) {
                die("Erro de conexão: " . $conn->connect_error);
            }

            // Preparar a instrução SQL para excluir o registro
            $sql = "DELETE FROM escolas WHERE id_escola = ?";

            // Usar prepared statements para evitar SQL injection
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                // Executar o comando e verificar se houve sucesso
                if ($stmt->execute()) {
                    echo "<script>alert('Registro excluído com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao excluir o registro: " . $stmt->error . "');</script>";
                }

                // Fechar o statement
                $stmt->close();
            } else {
                echo "<script>alert('Erro na preparação da exclusão: " . $conn->error . "');</script>";
            }

            // Fechar a conexão
            $conn->close();

            // Redirecionar para a página principal após a exclusão
            echo "<script>window.location.href = 'home.php';</script>";
        } else {
            echo "<script>alert('ID do registro não especificado.'); window.location.href = 'sua_pagina_principal.php';</script>";
        }
        ?>
    </div>

    <!-- Scripts do Bootstrap e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
