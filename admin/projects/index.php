<?php
require('../../includes/header.php');
require('../../controllers/projects/ListController.php');
?>

<div class="col-12">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Description</th>
                <th scope="col">Langage</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <?php
        foreach ($projects as $ligne) { ?>
            <tbody>
                <tr>
                    <th><?= $ligne['id'] ?>
                    <td><?= $ligne['name'] ?></td>
                    <td><?= $ligne['description'] ?></td>
                    <td><?= $ligne['language'] ?></td>
                    <td>
                        <a href="view.php?id=<?= $ligne['id'] ?>" class="btn btn-success">Voir</a>
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
