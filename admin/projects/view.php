<?php
require('../../includes/header.php');
require('../../controllers/projects/ViewController.php');
?>

<div class="row g-3">
    <div class="col-md-4">
        <label for="name" class="form-label">Nom du projet</label>
        <input type="text" class="form-control" name="name" value="<?= $name ?>" disabled>
    </div>
    <div class="col-md-4">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" value="<?= $description ?>" disabled>
    </div>
    <div class="col-md-4">
        <label for="language" class="form-label">Language</label>
        <input type="text" class="form-control" name="language" value="<?= $language     ?>" disabled>
    </div>
</div>

<hr />

<div class="col-12">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <?php
        foreach ($tasks as $ligne) { ?>
            <tbody>
                <tr>
                    <th><?= $ligne['id'] ?>
                    <td><?= $ligne['description'] ?></td>
                    <td>
                        <a href="/admin/tasks/edit.php?project=<?= $ligne['id'] ?>" class="btn btn-primary">Modifier</a>
                        <a href="/admin/tasks/delete.php?id=<?= $ligne['id'] ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        <?php }
        ?>
    </table>
</div>
<a href="/admin/tasks/new.php?project=<?= $id ?>"><button class="btn btn-primary">Ajouter une tâche</button></a>
<a href="index.php"><button class="btn btn-danger">Retour</button></a>

<?php
require('../../includes/footer.php');
