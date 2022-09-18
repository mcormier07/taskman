<?php
if (isAuthorized() == 0) {
    header('Location:../../public');
}

if (isset($_POST) && !empty($_POST)) {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $language = htmlspecialchars($_POST['language']);

    try {
        $checkProject = $pdo->prepare('SELECT name FROM ' . $dbName . '.projects WHERE name = ?');
        $checkProject->bindParam(1, $name);
        $checkProject->execute();
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la recherche du projet :</b>' . $e->getMessage());
    }

    if ($checkProject->rowCount() > 0) {
        die('<div class="alert alert-danger" role="alert"><b>Ce projet existe déjà.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/new.php">');
    }

    try {
        $insert = $pdo->prepare("INSERT INTO $dbName.projects(name, description, language) VALUES(?, ?, ?)");
        $insert->bindParam(1, $name);
        $insert->bindParam(2, $description);
        $insert->bindParam(3, $language);
        $insert->execute();
        echo '<div class="alert alert-success" role="alert"><b>Projet créé.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/index.php">';
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la création du project :</b>' . $e->getMessage());
    }
}
