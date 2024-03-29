<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Site de Vídeos</title>
</head>
<body>
    <h1>Bem-vindo ao Seu Site de Vídeos</h1>

    <!-- Link para o formulário de envio de vídeos -->
    <p><a href="enviar_video.html">Clique aqui para enviar um vídeo</a></p>

    <h2>Vídeos Recentes</h2>
    <div id="videosContainer">
        <!-- PHP para exibir os vídeos mais recentes -->
        <?php
        include 'config.php'; // Inclua o arquivo de configuração

        try {
            // Conexão com o banco de dados usando PDO
            $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query para obter os vídeos mais recentes do banco de dados
            $query = $conn->query("SELECT nome, url FROM videos ORDER BY id DESC LIMIT 5");
            $videos = $query->fetchAll(PDO::FETCH_ASSOC);

            // Exibir os vídeos na página
            foreach ($videos as $video) {
                echo '<h3>' . $video['nome'] . '</h3>';
                echo '<iframe width="560" height="315" src="' . $video['url'] . '" allowfullscreen></iframe>';
            }
        } catch(PDOException $e) {
            // Em caso de erro na conexão ou na consulta SQL
            echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
        } finally {
            // Fechar a conexão com o banco de dados
            $conn = null;
        }
        ?>
    </div>
</body>
</html>
