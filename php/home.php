<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição e Listagem</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    <h1>Formulário de Inscrição</h1>
    <form action="" method="post">
        <label for="namei">Nome da Instituição:</label><br>
        <input type="text" id="namei" name="namei" required><br><br>
        
        <label for="namer">Nome do Representante:</label><br>
        <input type="text" id="namer" name="namer" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="tel">Telefone:</label><br>
        <input type="text" id="tel" name="tel" required><br><br>
        
        <label for="inst">Tipo de Instituição:</label><br>
        <select id="inst" name="inst" required>
            <option value="Estadual">Estadual</option>
            <option value="Municipal">Municipal</option>
            <option value="Federal">Federal</option>
        </select><br><br>
        
        <label for="comen">Comentário:</label><br>
        <textarea id="comen" name="comen" rows="4" required></textarea><br><br>
        
        <input type="submit" value="Enviar">
    </form>

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

    // Processar o formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $namei = $_POST['namei'];
        $namer = $_POST['namer'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $inst = $_POST['inst'];
        $comentario = $_POST['comen'];

        $sql = "INSERT INTO escolas (nome_instituicao, nome_representante, email, telefone, tipo_instituicao, comentario) 
            VALUES ('$namei', '$namer', '$email', '$tel', '$inst', '$comentario')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registro inserido com sucesso!</p>";
        } else {
            echo "Erro: " . $conn->error;
        }
    }

    // Consultar e listar registros
    $sql = "SELECT id_escola, nome_instituicao, nome_representante, email, telefone, tipo_instituicao, comentario FROM escolas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Lista de Escolas</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome da Instituição</th><th>Nome do Representante</th><th>Email</th><th>Telefone</th><th>Tipo de Instituição</th><th>Comentário</th></tr>";

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
        echo "<p>Nenhum registro encontrado.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
