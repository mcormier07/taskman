<?php
require('../../includes/header.php');

if (isAuthorized() == 0) {
    header('Location:../../public/index.php');
}

$listClients = $pdo->prepare("SELECT * FROM $dbName.clients");
$listClients->execute();
?>

<div class="col-12">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom d'utilisateur</th>
                <th scope="col">Adresse email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <?php
        foreach ($listClients as $ligne) { ?>
            <tbody>
                <tr>
                    <th><?= $ligne['id'] ?>
                    <td><?= $ligne['name'] ?></td>
                    <td><?= $ligne['firstname'] ?></td>
                    <td><?= $ligne['username'] ?></td>
                    <td><?= $ligne['email'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $ligne['id'] ?>" class="btn btn-primary">Modifier</a>
                        <a href="delete.php?id=<?= $ligne['id'] ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        <?php }
        ?>
    </table>
</div>

<?php
require('../../includes/footer.php');
