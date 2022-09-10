<?php
if (isAuthorized() == 0) {
    header('Location:../../public');
}

if (isset($_POST) && !empty($_POST)) {
    $name = htmlspecialchars($_POST['name']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $username = htmlspecialchars($_POST['username']);
    $email = $_POST['email'];

    $checkAccount = $pdo->prepare('SELECT email, username FROM ' . $dbName . '.clients WHERE email = ? AND username = ?');
    $checkAccount->bindParam(1, $email);
    $checkAccount->bindParam(2, $username);
    $checkAccount->execute();

    if ($checkAccount->rowCount() > 0) {
        die('<div class="alert alert-danger" role="alert"><b>Nom d\'utilisateur ou adresse mail déjà utilisés.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/new.php">');
    }

    try {
        $insert = $pdo->prepare("INSERT INTO $dbName.clients(name, firstname, username, email) VALUES(?, ?, ?, ?)");
        $insert->bindParam(1, $name);
        $insert->bindParam(2, $firstname);
        $insert->bindParam(3, $username);
        $insert->bindParam(4, $email);
        $insert->execute();
        echo '<div class="alert alert-success" role="alert"><b>Compte créé.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/">';
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de l\'ajout du client :</b>' . $e->getMessage());
    }
}
