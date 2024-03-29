<?php

class m0001_initial
{
    public function up()
    {
        $database = \walumbe\phpmvc\Application::$app->database;
        $SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                status TINYINT NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
        $database->pdo->exec($SQL);
    }

    public function down()
    {
        $database = \walumbe\phpmvc\Application::$app->database;
        $SQL = "DROP TABLE users";
        $database->pdo->exec($SQL);
    }
}