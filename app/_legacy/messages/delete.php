<?php

declare(strict_types=1);

require '../../config/database.php';

$stmt = $pdo->prepare(
    'DELETE FROM messages WHERE id = :id'
);

$stmt->execute([
    'id' => (int) $_POST['id'],
]);

echo json_encode([
    'success' => true,
]);
