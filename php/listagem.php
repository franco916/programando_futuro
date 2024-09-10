<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Escolas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Listagem de Escolas</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BD";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $sql = "SELECT id_escola, nome_instituicao, nome_representante, email, telefone, tipo_instituicao, comentario FROM escolas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome da Instituição</th><th>Nome do Representante</th><th>Email</th><th>Telefone</th><th>Tipo de Instituição</th><th>Comentário</th></tr>";

        // Saída de cada linha
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
        echo "</table>";
    } else {
        echo "Nenhum registro encontrado.";
    }
    $conn->close();
    ?>
</body>
</html>
