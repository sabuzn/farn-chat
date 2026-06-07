<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farn-Chat | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Ajuste fino para esconder barras de rolagem mantendo a funcionalidade */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-[#313338] antialiased select-none overflow-hidden">

    <div id="app-root" class="flex h-screen w-screen overflow-hidden">
        
        <?php 
            // 1. Primeira Coluna: Barra de Servidores (Extrema Esquerda)
            // Responsável por listar as comunidades e o botão de direct messages.
            require_once dirname(__DIR__, 2) . '/resources/js/components/ServerSidebar.jsx'; 
        ?>

        <?php 
            // 2. Segunda Coluna: Lista de Canais (Centro-Esquerda)
            // Mostra as categorias de texto e voz do servidor selecionado.
            require_once __DIR__ . '/resources/js/components/ChannelList.jsx'; 
        ?>

        <?php 
            // 3. Terceira Coluna: Janela do Chat Ativo (Área Principal)
            // Exibe o histórico de mensagens, inputs e feed em tempo real.
            require_once __DIR__ . '/resources/js/components/ChatWindow.jsx'; 
        ?>

    </div>

    <script>
        console.log("Farn-Chat: Interface carregada com sucesso.");
        // Aqui entrará a inicialização dos seus listeners de WebSocket e interações de UI
    </script>
</body>
</html>
