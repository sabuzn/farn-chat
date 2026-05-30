<?php

require dirname(__DIR__) . '/app/bootstrap.php';

echo '<pre>';

var_dump($_ENV['DB_HOST'] ?? null);
var_dump($_ENV['DB_NAME'] ?? null);
var_dump($_ENV['DB_USER'] ?? null);
var_dump($_ENV['DB_PASSWORD'] ?? null);
