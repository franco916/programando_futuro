<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #ffffff;
            padding-top: 20px;
        }
        .bg-blue {
            background-color: #004aad;
        }
        .bg-custom {
            background-color: #004aad; /* Cor personalizada */
        }
        .back-button {
            position: absolute; /* Alterado para absoluto */
            top: 20px; /* Distância do topo */
            left: 20px; /* Distância da esquerda */
            background-color: #c00010; /* Cor de fundo do botão */
            color: white; /* Cor do texto */
            border: none; /* Sem borda */
            border-radius: 5px; /* Bordas arredondadas */
            padding: 10px; /* Padding interno */
            cursor: pointer; /* Cursor de mão */
            font-size: 1.5rem; /* Tamanho da fonte */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Sombra */
            z-index: 1000; /* Fixa o botão acima de outros elementos */
        }
    </style>
</head>
<body>
    <button class="back-button" onclick="window.location.href='../p/admin.html'">
        <i class="fas fa-arrow-left"></i>
    </button>
<body>

    <br><br>

    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bd";
        $port = 3307;
        $id = $_GET['id'];

        // Criar conexão
        $conn = new mysqli($servername, $username, $password, $dbname, $port);

        // Verificar conexão
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        // Buscar o registro com o ID especificado
        if (isset($id)) {
            $sql = "SELECT * FROM escolas WHERE id_escola = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "<p>Registro não encontrado.</p>";
                exit();
            }
        }

        // Atualizar o registro no banco de dados
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome_instituicao = $_POST["nome_instituicao"];
            $nome_representante = $_POST["nome_representante"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];
            $tipo_instituicao = $_POST["tipo_instituicao"];
            $comentario = $_POST["comentario"];

            $sql = "UPDATE escolas SET 
                        nome_instituicao='$nome_instituicao', 
                        nome_representante='$nome_representante', 
                        email='$email', 
                        telefone='$telefone', 
                        tipo_instituicao='$tipo_instituicao', 
                        comentario='$comentario' 
                    WHERE id_escola = $id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Registro atualizado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao atualizar o registro: " . $conn->error . "</div>";
            }
        }

        $conn->close();
        ?>

        <!-- Formulário de edição -->
        <h2>Editar Registro</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="nome_instituicao">Nome da Instituição</label>
                <input type="text" class="form-control" id="nome_instituicao" name="nome_instituicao" value="<?php echo $row['nome_instituicao']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nome_representante">Nome do Representante</label>
                <input type="text" class="form-control" id="nome_representante" name="nome_representante" value="<?php echo $row['nome_representante']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tipo_instituicao">Tipo de Instituição</label>
                <input type="text" class="form-control" id="tipo_instituicao" name="tipo_instituicao" value="<?php echo $row['tipo_instituicao']; ?>" required>
            </div>
            <div class="form-group">
                <label for="comentario">Comentário</label>
                <textarea class="form-control" id="comentario" name="comentario" required><?php echo $row['comentario']; ?></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="home.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Scripts do Bootstrap e jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
