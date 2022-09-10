<?php
require('../../includes/header.php');

if (isAuthorized() == 0) {
    echo '<script language="javascript">document.location="/auth/login"</script>';
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
                <th scope="col">Description</th>
            </tr>
        </thead>

        <?php
        foreach ($listClients as $ligne) { ?>
            <tbody>
                <tr>
                    <th><?= $ligne['id'] ?>
                    <td><?= $ligne['name'] ?></td>
                    <td><?= $ligne['description'] ?></td>
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
