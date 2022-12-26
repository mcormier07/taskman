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
        if ($password == $confirm && strlen($password) >= 8) {
            $hashPasswd = password_hash($password, PASSWORD_ARGON2ID);
            try {
                $createPassword = $pdo->prepare("INSERT INTO $dbName.settings (admin_password) VALUES (?)");
                $createPassword->bindParam(1, $hashPasswd);
                $createPassword->execute();
                echo '<div class="col-12 d-flex alert alert-success w-25 justify-content-center" role="alert"><b>Mot de passe créé.</b></div> <meta http-equiv="REFRESH" content="3;url="/auth">';
            } catch (PDOException $e) {
                die('<div class=col-12 d-flex alert alert-danger w-25 justify-content-center" role="alert"><b>Une erreur s\'est produite lors de la vérification du mot de passe :' . $e->getMessage());
            }
        } else {
            echo ('<div class="col-12 d-flex alert alert-danger w-25 justify-content-center" role="alert"><b>Le mot de passe est trop court.</b></div>');
        }
    } else {
        if (password_verify($password, $checkSettings['admin_password'])) {
            enableAccess();
            echo '<div class="col-12 d-flex alert alert-success w-25 justify-content-center" role="alert"><b>Connecté(e).</b></div> <meta http-equiv="REFRESH" content="3;url="/projects">';
        } else {
            echo ('<div class="col-12 d-flex alert alert-danger w-25 justify-content-center" role="alert"><b>Mot de passe incorrect.</b></div>');
        }
    }
}
