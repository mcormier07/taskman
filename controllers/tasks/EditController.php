<?php
if (isAuthorized() == 0) {
    header('Location:../../public');
}

if (!empty($_GET) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $checkTask = $pdo->prepare("SELECT * FROM $dbName.tasks WHERE id = ?");
    $checkTask->bindParam(1, $id);
    $checkTask->execute();

    if ($checkTask->rowCount() == 0) {
        die('<div class="alert alert-danger" role="alert"><b>Aucune tâche trouvée.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/index.php">');
    }

    foreach($checkTask as $row) {
        $name = $row['name'];
    }
    
} else {
    die('<div class="alert alert-danger" role="alert"><b>Méthode non approuvée.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/index.php">');
}

if (isset($_POST) && !empty($_POST)) {
    $description = htmlspecialchars($_POST['description']);

    try {
        $update = $pdo->prepare("UPDATE $dbName.tasks SET description = ? WHERE id = ?");
        $update->bindParam(1, $description);
        $update->bindParam(2, $_GET['id']);
        $update->execute();
        echo '<div class="alert alert-success" role="alert"><b>Tâche modifiée.</b></div> <meta http-equiv="REFRESH" content="3;url=/taskman/admin/projects/index.php">';
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la modification de la tâche :</b>' . $e->getMessage());
    }
}

