<?php
if (isAuthorized() == 0) {
    header('Location:../../public');
}

if (!empty($_GET) && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $checkAccount = $pdo->prepare("SELECT id FROM $dbName.projects WHERE id = ?");
        $checkAccount->bindParam(1, $id);
        $checkAccount->execute();
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la recherche du projet :</b>' . $e->getMessage());
    }

    if ($checkAccount->rowCount() == 0) {
        die('<div class="alert alert-danger" role="alert"><b>Aucun projet trouvé.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/">');
    }

    try {
        $delete = $pdo->prepare("DELETE FROM $dbName.projects WHERE id = ?");
        $delete->bindParam(1, $id);
        $delete->execute();
        echo '<div class="alert alert-success" role="alert"><b>Projet supprimé.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/">';
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la suppression du projet :</b>' . $e->getMessage());
    }
} else {
    die('<div class="alert alert-danger" role="alert"><b>Méthode non approuvée.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/">');
}
