<?php
if (isAuthorized() == 0) {
    header('Location:../../public');
}

if (!empty($_GET) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $checkAccount = $pdo->prepare("SELECT id FROM $dbName.clients WHERE id = ?");
    $checkAccount->bindParam(1, $id);
    $checkAccount->execute();

    if ($checkAccount->rowCount() == 0) {
        die('<div class="alert alert-danger" role="alert"><b>Aucun client trouvé.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/">');
    }

    try {
        $delete = $pdo->prepare("DELETE FROM $dbName.clients WHERE id = ?");
        $delete->bindParam(1, $id);
        $delete->execute();
        echo '<div class="alert alert-success" role="alert"><b>Client(e) supprimé.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/">';
    } catch (PDOException $e) {
        die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la suppression du client :</b>' . $e->getMessage());
    }

} else {
    die('<div class="alert alert-danger" role="alert"><b>Méthode non approuvée.</b></div> <meta http-equiv="REFRESH" content="3;url=/baptiste/admin/clients/">');
}
