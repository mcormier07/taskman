<?php
if (isAuthorized() == 0) {
    header('Location:../../public/home');
}

if (!empty($_GET) && isset($_GET['project'])) {
    $id = $_GET['project'];
    if (isset($_POST) && !empty($_POST)) {
        $description = htmlspecialchars($_POST['description']);
        $project = $id;
        try {
            $checkProject = $pdo->prepare('SELECT id FROM ' . $dbName . '.projects WHERE id = ?');
            $checkProject->bindParam(1, $email);
            $checkProject->execute();
        } catch (PDOException $e) {
            die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la recherche du projet :</b>' . $e->getMessage());
        }

        try {
            $insert = $pdo->prepare("INSERT INTO $dbName.tasks(project_id, description) VALUES(?, ?)");
            $insert->bindParam(1, $id);
            $insert->bindParam(2, $description);
            $insert->execute();
            echo '<div class="alert alert-success" role="alert"><b>Tâche ajoutée au projet.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/index.php">';
        } catch (PDOException $e) {
            die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de l\'ajout de la tâche :</b>' . $e->getMessage());
        }
    }
} else {
    die('<div class="alert alert-danger" role="alert"><b>Méthode non approuvée.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/index.php">');
}
