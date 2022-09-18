<?php
if (isAuthorized() == 1) {
    header(('Location:../../admin/projects/index.php'));
}

$sql = $pdo->query("SELECT admin_password FROM $dbName.settings");
$checkSettings = $sql->fetch();
if (isset($_POST) && !empty($_POST)) {
    $password = $_POST["password"];
    if (!$checkSettings) {
        $confirm = $_POST["confirmPassword"];
        if ($password == $confirm) {
            $hashPasswd = password_hash($password, PASSWORD_ARGON2ID);
            try {
                $createPassword = $pdo->prepare("INSERT INTO $dbName.settings (admin_password) VALUES (?)");
                $createPassword->bindParam(1, $hashPasswd);
                $createPassword->execute();
                echo '<div class="alert alert-success" role="alert"><b>Mot de passe créé.</b></div> <meta http-equiv="REFRESH" content="3;url="/">';
            } catch (PDOException $e) {
                die('<div class=alert alert-danger" role="alert"><b>Une erreur s\'est produite lors de la vérification du mot de passe :' . $e->getMessage());
            }
        }
    } else {
        if (password_verify($password, $checkSettings['admin_password'])) {
            enableAccess();
            echo '<div class="alert alert-success" role="alert"><b>Connecté(e).</b></div> <meta http-equiv="REFRESH" content="3;url="/taskman/projects/index.php">';
        } else {
            die('<div class="alert alert-danger" role="alert"><b>Mot de passe incorrect.</b></div>');
        }
    }
}
