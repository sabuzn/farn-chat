#!/usr/bin/env bash

set -Eeuo pipefail

printf '\n╭─[ygg@NyggUwU]::~ farn-chat bootstrap\n╰─➤ Criando estrutura...\n'

mkdir -p \
    config \
    database \
    docker/nginx \
    docker/php \
    public/servers \
    public/channels \
    public/messages

cat > database/schema.sql <<'SQL'
CREATE DATABASE IF NOT EXISTS farn_chat;
USE farn_chat;

CREATE TABLE servers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE channels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    server_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (server_id)
        REFERENCES servers(id)
        ON DELETE CASCADE
);

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    channel_id INT NOT NULL,
    username VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (channel_id)
        REFERENCES channels(id)
        ON DELETE CASCADE
);
SQL

cat > config/database.php <<'PHP'
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
PHP

cat > .env <<'ENV'
MYSQL_DATABASE=farn_chat
MYSQL_ROOT_PASSWORD=root
MYSQL_USER=farn
MYSQL_PASSWORD=farn123

APP_PORT=8080
MYSQL_PORT=3306
PHPMYADMIN_PORT=8081
ENV

cat > .dockerignore <<'TXT'
.git
.gitignore

vendor
node_modules
TXT

cat > docker-compose.yml <<'YAML'
services:
  nginx:
    image: nginx:stable-alpine
    restart: unless-stopped

    ports:
      - "${APP_PORT}:80"

    volumes:
      - ./public:/var/www/html/public
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf

    depends_on:
      - php

  php:
    build:
      context: .
      dockerfile: docker/php/Dockerfile

    restart: unless-stopped

    volumes:
      - ./:/var/www/html

    working_dir: /var/www/html

    depends_on:
      - mysql

  mysql:
    image: mysql:8.4

    restart: unless-stopped

    environment:
      MYSQL_DATABASE: ${MYSQL_DATABASE}
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD: ${MYSQL_PASSWORD}

    ports:
      - "${MYSQL_PORT}:3306"

    volumes:
      - mysql_data:/var/lib/mysql
      - ./database/schema.sql:/docker-entrypoint-initdb.d/schema.sql

  phpmyadmin:
    image: phpmyadmin:latest

    restart: unless-stopped

    ports:
      - "${PHPMYADMIN_PORT}:80"

    environment:
      PMA_HOST: mysql

    depends_on:
      - mysql

volumes:
  mysql_data:
YAML

cat > docker/php/Dockerfile <<'DOCKER'
FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    bash \
    git \
    curl \
    unzip \
    icu-dev \
    libzip-dev \
    oniguruma-dev

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    intl \
    mbstring \
    zip

WORKDIR /var/www/html
DOCKER

cat > docker/nginx/default.conf <<'NGINX'
server {
    listen 80;

    root /var/www/html/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;

        fastcgi_pass php:9000;

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
NGINX

create_crud() {
    local dir="$1"
    local table="$2"

    cat > "public/$dir/create.php" <<PHP
<?php

declare(strict_types=1);

require '../../config/database.php';

\$data = \$_POST;

\$columns = implode(', ', array_keys(\$data));
\$placeholders = ':' . implode(', :', array_keys(\$data));

\$stmt = \$pdo->prepare(
    "INSERT INTO $table (\$columns) VALUES (\$placeholders)"
);

\$stmt->execute(\$data);

echo json_encode([
    'success' => true,
]);
PHP

    cat > "public/$dir/read.php" <<PHP
<?php

declare(strict_types=1);

require '../../config/database.php';

\$stmt = \$pdo->query(
    'SELECT * FROM $table'
);

header('Content-Type: application/json');

echo json_encode(
    \$stmt->fetchAll(),
    JSON_PRETTY_PRINT
);
PHP

    cat > "public/$dir/update.php" <<PHP
<?php

declare(strict_types=1);

require '../../config/database.php';

\$id = (int) \$_POST['id'];

unset(\$_POST['id']);

\$set = [];

foreach (array_keys(\$_POST) as \$field) {
    \$set[] = "\$field = :\$field";
}

\$sql = sprintf(
    'UPDATE $table SET %s WHERE id = :id',
    implode(', ', \$set)
);

\$stmt = \$pdo->prepare(\$sql);

\$stmt->execute([
    ...\$_POST,
    'id' => \$id,
]);

echo json_encode([
    'success' => true,
]);
PHP

    cat > "public/$dir/delete.php" <<PHP
<?php

declare(strict_types=1);

require '../../config/database.php';

\$stmt = \$pdo->prepare(
    'DELETE FROM $table WHERE id = :id'
);

\$stmt->execute([
    'id' => (int) \$_POST['id'],
]);

echo json_encode([
    'success' => true,
]);
PHP
}

create_crud servers servers
create_crud channels channels
create_crud messages messages

printf '\n╭─[ygg@NyggUwU]::~ farn-chat bootstrap\n╰─➤ Estrutura criada com sucesso.\n'
