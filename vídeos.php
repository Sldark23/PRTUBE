<?php
include 'config.php'; // Inclua o arquivo de configuração

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inserir vídeos na tabela
    $videos = [
        ['nome' => 'Vídeo 1', 'url' => 'videos/video1.mp4'],
        ['nome' => 'Vídeo 2', 'url' => 'videos/video2.mp4'],
        ['nome' => 'Vídeo 3', 'url' => 'videos/video3.mp4'],
        // Adicione mais vídeos conforme necessário
    ];

    foreach ($videos as $video) {
        $stmt = $conn->prepare("INSERT INTO videos (nome, url) VALUES (:nome, :url)");
        $stmt->bindParam(':nome', $video['nome']);
        $stmt->bindParam(':url', $video['url']);
        $stmt->execute();
    }

    echo 'Vídeos inseridos com sucesso na tabela.';
} catch(PDOException $e) {
    echo 'Erro ao inserir vídeos na tabela: ' . $e->getMessage();
} finally {
    $conn = null; // Fechar a conexão com o banco de dados
}
?>
