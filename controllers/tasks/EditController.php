<?php
if (isAuthorized() == 0) {
    header('Location:../../public');
}

if (!empty($_GET) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $checkAccount = $pdo->prepare("SELECT * FROM $dbName.clients WHERE id = ?");
    $checkAccount->bindParam(1, $id);
    $checkAccount->execute();

    if ($checkAccount->rowCount() == 0) {
        die('<div class="alert alert-danger" role="alert"><b>Aucun client trouvé.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/">');
    }

    foreach($checkAccount as $row) {
        $name = $row['name'];
        $firstname = $row['firstname'];
        $username = $row['username'];
        $email = $row['email'];
    }
    
} else {
    die('<div class="alert alert-danger" role="alert"><b>Méthode non approuvée.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/">');
}

if (isset($_POST) && !empty($_POST)) {
    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $username = htmlspecialchars($_POST['username']);
    $email = $_POST['email'];

    $checkAccount = $pdo->prepare("SELECT email, username FROM $dbName.clients WHERE email = ? AND username = ?");
    $checkAccount->bindParam(1, $email);
    $checkAccount->bindParam(2, $username);
    $checkAccount->execute();

    if ($checkAccount->rowCount() > 0) {
        die('<div class="alert alert-danger" role="alert"><b>Nom d\'utilisateur ou adresse mail déjà utilisés.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/edit.php?id=' . $_GET['id'] . '>');
    }

    try {
        $update = $pdo->prepare("UPDATE $dbName.clients SET name = ?, firstname = ?, username = ?, email = ? WHERE id = ?");
        $update->bindParam(1, $name);
        $update->bindParam(2, $firstname);
        $update->bindParam(3, $username);
        $update->bindParam(4, $email);
        $update->bindParam(5, $_GET['id']);
        $update->execute();
        echo '<div class="alert alert-success" role="alert"><b>Client modifié.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/">';
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la modification du client :</b>' . $e->getMessage());
    }
}

