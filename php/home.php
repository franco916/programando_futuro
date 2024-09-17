<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição e Listagem</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Adicione estilos personalizados se necessário */
        body {
            padding-top: 20px;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bd";
        $port = 3307;

        // Criar conexão
        $conn = new mysqli($servername, $username, $password, $dbname, $port);

        // Verificar conexão
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        // Consultar e listar registros
        $sql = "SELECT id_escola, nome_instituicao, nome_representante, email, telefone, tipo_instituicao, comentario FROM escolas";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2><center>Resultados do Formulário: Lista de Escolas<center></h2>";
            echo "<div class='table-container'>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>ID</th><th>Nome da Instituição</th><th>Nome do Representante</th><th>Email</th><th>Telefone</th><th>Tipo de Instituição</th><th>Comentário</th></tr></thead>";
            echo "<tbody>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_escola"] . "</td>";
                echo "<td>" . $row["nome_instituicao"] . "</td>";
                echo "<td>" . $row["nome_representante"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["telefone"] . "</td>";
                echo "<td>" . $row["tipo_instituicao"] . "</td>";
                echo "<td>" . $row["comentario"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>Nenhum registro encontrado.</p>";
        }

        $conn->close();
        ?>
    </div>

    <!-- Scripts do Bootstrap e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
