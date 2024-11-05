<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição e Listagem</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Responsividade dos textos e elementos de card */
        @media (max-width: 768px) {
            .bg-gray-section, .bg-dark-gray-section {
                padding: 40px 0;
                width: 100vw;
            }

            .bg-gray-section h1, .bg-dark-gray-section h1 {
                font-size: 2rem;
            }

            .bg-gray-section p, .bg-dark-gray-section p {
                font-size: 1.1rem;
            }
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
    
    <div class="container mt-5"> <!-- Adicionei margem superior para espaçar do botão -->
        <!-- Botão de voltar -->
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
            echo "<h2 class='text-center'>Resultados do Formulário</h2>";
            echo "<div class='table-container table-responsive'>"; 
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>ID</th><th>Nome da Instituição</th><th>Nome do Representante</th><th>Email</th><th>Telefone</th><th>Tipo de Instituição</th><th>Comentário</th><th>Ações</th></tr></thead>";
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
                echo "<td>";
                echo "<a href='editar.php?id=" . $row["id_escola"] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a> ";
                echo "<a href='excluir.php?id=" . $row["id_escola"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'><i class='fas fa-trash-alt'></i></a>";
                echo "</td>";
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
