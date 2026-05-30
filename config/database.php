<?php

declare(strict_types=1);

$host = 'mysql';
$dbname = $_ENV['MYSQL_DATABASE'] ?? 'farn_chat';
$user = $_ENV['MYSQL_USER'] ?? 'farn';
$pass = $_ENV['MYSQL_PASSWORD'] ?? 'farn123';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $exception) {
    die($exception->getMessage());
}
