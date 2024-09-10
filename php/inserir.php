<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$namei = $_POST['namei'];
$namer = $_POST['namer'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$inst = $_POST['inst'];
$comentario = $_POST['comen'];

$sql = "INSERT INTO escolas (nome_instituicao, nome_representante, email, telefone, tipo_instituicao, comentario) 
    VALUES ('$namei', '$namer', '$email', '$tel', '$inst', '$comentario')";

if ($conn->query($sql) === TRUE) {
    header("Location: listagem.php");
    exit();
}
$conn->close();
?>
