<?php
// app/models/Database.php
/**
 * This file creates the tables for the sqlite database that comes bundled with epywiki
 * 
 * 
 */

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
            name TEXT NOT NULL,
            type TEXT NOT NULL,
            parent_id INTEGER,
            FOREIGN KEY (parent_id) REFERENCES locations(id)
        );

        CREATE TABLE IF NOT EXISTS disease_reports (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            disease_id INTEGER NOT NULL,
            location_id INTEGER NOT NULL,
            cases INTEGER NOT NULL,
            report_date DATE NOT NULL,
            FOREIGN KEY (disease_id) REFERENCES diseases(id),
            FOREIGN KEY (location_id) REFERENCES locations(id)
        );

        CREATE TABLE IF NOT EXISTS disease_location (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            disease_id INTEGER NOT NULL,
            location_id INTEGER NOT NULL,
            FOREIGN KEY (disease_id) REFERENCES diseases(id),
            FOREIGN KEY (location_id) REFERENCES locations(id)
        );

        CREATE TABLE IF NOT EXISTS disease_location_data (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            disease_id INTEGER NOT NULL,
            location_id INTEGER NOT NULL,
            cases INTEGER,
            deaths INTEGER,
            report_date DATE,
            notes TEXT,
            FOREIGN KEY (disease_id) REFERENCES diseases(id),
            FOREIGN KEY (location_id) REFERENCES locations(id)
        );
    ");
}

