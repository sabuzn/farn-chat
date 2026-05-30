<?php

declare(strict_types=1);

require '../../config/database.php';

$stmt = $pdo->query(
    'SELECT * FROM channels'
);

header('Content-Type: application/json');

echo json_encode(
    $stmt->fetchAll(),
    JSON_PRETTY_PRINT
);
