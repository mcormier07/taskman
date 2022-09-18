<?php
if (isAuthorized() == 0) {
    header('Location:../../public');
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
        die('<div class="alert alert-danger" role="alert"><b>Aucun projet trouvé.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/">');
    }

    foreach ($checkProject as $row) {
        $name = $row['name'];
        $description = $row['description'];
        $language = $row['language'];
    }
} else {
    die('<div class="alert alert-danger" role="alert"><b>Méthode non approuvée.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/">');
}

if (isset($_POST) && !empty($_POST)) {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $language = htmlspecialchars($_POST['language']);

    try {
        $checkProject = $pdo->prepare("SELECT name FROM $dbName.projects WHERE name = ?");
        $checkProject->bindParam(1, $name);
        $checkProject->execute();
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la recherche du projet :</b>' . $e->getMessage());
    }

    if ($checkProject->rowCount() > 0) {
        die('<div class="alert alert-danger" role="alert"><b>Ce projet existe déjà.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/edit.php?id=' . $_GET['id'] . '>');
    }

    try {
        $update = $pdo->prepare("UPDATE $dbName.project SET name = ?, description = ?, language = ? WHERE id = ?");
        $update->bindParam(1, $name);
        $update->bindParam(2, $description);
        $update->bindParam(3, $language);
        $update->bindParam(4, $_GET['id']);
        $update->execute();
        echo '<div class="alert alert-success" role="alert"><b>Projet modifié.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/">';
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la modification du projet :</b>' . $e->getMessage());
    }
}
