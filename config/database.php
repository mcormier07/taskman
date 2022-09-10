<?php
require('global.php');
$dbName = DB_NAME;
$dbHost = DB_HOST;
$dbUser = DB_USER;
$dbPassword = DB_PASS;

$dsn = "mysql:host=$dbHost";
try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch (PDOException $e) {
    echo 'Error while connecting to database : ' . $e->getMessage();
}

try {
    $db = $pdo->prepare("CREATE DATABASE IF NOT EXISTS $dbName CHARSET utf8 COLLATE utf8_general_ci");
    $db->execute();
} catch (PDOException $e) {
    echo 'Error while creating database : ' . $e->getMessage();
}

try {
    $projects = $pdo->prepare("CREATE TABLE IF NOT EXISTS $dbName.projects (id INT(11) NOT NULL AUTO_INCREMENT, name VARCHAR(50) NOT NULL, description VARCHAR(255), PRIMARY KEY(id))");
    $projects->execute();
} catch (PDOException $e) {
    echo 'Error while creating table projects : ' . $e->getMessage();
}

try {
    $tasks = $pdo->prepare("CREATE TABLE IF NOT EXISTS $dbName.tasks (id INT(11) NOT NULL AUTO_INCREMENT, project_id INT(11) NOT NULL, description VARCHAR(255), PRIMARY KEY(id), FOREIGN KEY (project_id) REFERENCES projects(id))");
    $tasks->execute();
} catch (PDOException $e) {
    echo 'Error while creating table tasks : ' . $e->getMessage();
}

try {
    $initialSetup = $pdo->prepare("CREATE TABLE IF NOT EXISTS $dbName.settings (admin_password VARCHAR(255) NOT NULL, authorized INT(11))");
    $initialSetup->execute();
} catch (PDOException $e) {
    echo 'Error while creating table settings : ' . $e->getMessage();
}

function isAuthorized()
{
    global $pdo;
    global $dbName;
    $res = 0;
    try {
        $req = $pdo->prepare("SELECT authorized FROM $dbName.settings");
        $req->execute();
    } catch (PDOException $e) {
        echo 'Error while trying to execute request : ' . $e->getMessage();
    }
    foreach ($req as $row) {
        if ($row['authorized'] == 1) {
            $res = 1;
        } else {
            $res = 0;
        }
    }
    return $res;
}

function enableAccess()
{
    global $pdo;
    global $dbName;
    try {
        $enable = $pdo->prepare("UPDATE $dbName.settings SET authorized = 1");
        $enable->execute();
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite :</b>' . $e->getMessage());
    }
    return $enable;
}

function disableAccess()
{
    global $pdo;
    global $dbName;
    try {
        $disable = $pdo->prepare("UPDATE $dbName.settings SET authorized = 0");
        $disable->execute();
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite :</b>' . $e->getMessage());
    }
    return $disable;
}
