<?php
//app/models/Databse.php

function get_db() {
    static $db = null;
    if ($db === null) {
        $db = new PDO('sqlite:' . DB_PATH);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $db;
}
function create_tables() {
    $db = get_db();
    $db->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            email TEXT UNIQUE NOT NULL,
            password_hash TEXT NOT NULL,
            is_admin INTEGER DEFAULT 0,
            is_approved INTEGER DEFAULT 0
        );

        CREATE TABLE IF NOT EXISTS diseases (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL UNIQUE,
            description TEXT
        );


CREATE TABLE IF NOT EXISTS locations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    country TEXT NOT NULL,
    level1 TEXT,
    level2 TEXT,
    level3 TEXT
);

        -- Epidemiological reports (Markdown)
        CREATE TABLE IF NOT EXISTS reports (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            disease_id INTEGER NOT NULL,
            location_id INTEGER NOT NULL,
            user_id INTEGER NOT NULL,
            content_md TEXT NOT NULL,      -- Markdown content
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (disease_id) REFERENCES diseases(id),
            FOREIGN KEY (location_id) REFERENCES locations(id),
            FOREIGN KEY (user_id) REFERENCES users(id)
        );
    ");
}
