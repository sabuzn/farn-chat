<?php

declare(strict_types=1);

require '../../config/database.php';

$data = $_POST;

$columns = implode(', ', array_keys($data));
$placeholders = ':' . implode(', :', array_keys($data));

$stmt = $pdo->prepare(
    "INSERT INTO messages ($columns) VALUES ($placeholders)"
);

$stmt->execute($data);

echo json_encode([
    'success' => true,
]);
