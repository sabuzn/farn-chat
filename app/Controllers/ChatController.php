<?php

namespace App\Controllers;

use App\Services\ChatService;

class ChatController
{
    /**
     * Renderiza a interface mestre do chat (Dashboard)
     */
    public function index(): void
    {
        // Se a sua view mudou de nome ou está em outro lugar, ajuste o caminho aqui
        require_once dirname(__DIR__) . '/Views/dashboard.php';
    }

    /**
     * Endpoint da API para buscar o histórico de mensagens
     */
    public function getHistory(string $channelId): void
    {
        header('Content-Type: application/json');

        // Proteção: Validar se o usuário está autenticado e tem permissão no canal
        // if (!AuthMiddleware::check()) { ... }

        if (empty($channelId)) {
            http_response_code(400);
            echo json_encode(['error' => 'ID do canal é obrigatório.']);
            return;
        }

        try {
            $messages = ChatService::getMessagesForChannel($channelId);
            
            http_response_code(200);
            echo json_encode(['data' => $messages]);
            
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro interno ao carregar o chat.']);
        }
    }
}
