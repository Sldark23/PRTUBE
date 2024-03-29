<?php
include 'config.php'; // Inclua o arquivo de configuração

// Receber os dados do formulário
$nome = $_POST['nome'];
$url = $_POST['url'];

// Verificar se a URL é válida (por exemplo, verificar se é uma URL do YouTube)
if (filter_var($url, FILTER_VALIDATE_URL) && preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $match)) {
    // Extrair o ID do vídeo do URL do YouTube
    $video_id = $match[1];

    // Construir o URL de incorporação (embed) do YouTube
    $embed_url = "https://www.youtube.com/embed/$video_id";

    try {
        // Inserir os dados do vídeo na tabela
        $stmt = $conn->prepare("INSERT INTO videos (nome, url) VALUES (:nome, :url)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':url', $embed_url);
        $stmt->execute();

        echo 'Vídeo enviado com sucesso!';
    } catch(PDOException $e) {
        echo 'Erro ao inserir vídeo no banco de dados: ' . $e->getMessage();
    }
} else {
    echo 'URL do vídeo inválida ou não suportada.';
}
?>
