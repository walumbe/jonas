<?php
class m0002_add_password_column
{
    public function up()
    {
        $database = \app\core\Application::$app->database;
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL";
        $database->pdo->exec($SQL);
    }

    public function down()
    {
        $database = \app\core\Application::$app->database;
        $SQL = "ALTER TABLE users DROP COLUMN password";
        $database->pdo->exec($SQL);
    }
}