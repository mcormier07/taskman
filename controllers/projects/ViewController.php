<?php

if (isAuthorized() == 0) {
    header('Location:../../public/home/index.php');
}

if (!empty($_GET) && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $checkProject = $pdo->prepare("SELECT * FROM $dbName.projects WHERE id = ?");
        $checkProject->bindParam(1, $id);
        $checkProject->execute();
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la recherche du projet :</b>' . $e->getMessage());
    }

    if ($checkProject->rowCount() == 0) {
        die('<div class="alert alert-danger" role="alert"><b>Aucun projet trouvé.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/index.php">');
    }

    foreach ($checkProject as $row) {
        $name = $row['name'];
        $description = $row['description'];
        $language = $row['language'];
    }

    try {
        $tasks = $pdo->prepare("SELECT * FROM $dbName.tasks WHERE project_id = ?");
        $tasks->bindParam(1, $id);
        $tasks->execute();
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la recherche des tâches du projet :</b>' . $e->getMessage());
    }
} else {
    die('<div class="alert alert-danger" role="alert"><b>Méthode non approuvée.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/index.php">');
}
