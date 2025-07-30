<?php
require 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    email TEXT,
    phone TEXT,
    fullname TEXT,
    is_admin INTEGER DEFAULT 0,
    is_active INTEGER DEFAULT 0
)";
$pdo->exec($sql);

echo "✅ Table 'users' créée (ou existante) avec succès.";
