<?php

declare(strict_types=1);

require '../../config/database.php';

$id = (int) $_POST['id'];

unset($_POST['id']);

$set = [];

foreach (array_keys($_POST) as $field) {
    $set[] = "$field = :$field";
}

$sql = sprintf(
    'UPDATE servers SET %s WHERE id = :id',
    implode(', ', $set)
);

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ...$_POST,
    'id' => $id,
]);

echo json_encode([
    'success' => true,
]);
