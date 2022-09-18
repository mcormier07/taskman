<?php
require('../../includes/header.php');
require('../../controllers/projects/EditController.php');
?>

<form method="POST" action="#" class="row g-3">
    <div class="col-md-4">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" name="name" value="<?= $name ?>" required>
    </div>
    <div class="col-md-4">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" value="<?= $description ?>" required>
    </div>
    <div class="col-md-4">
        <label for="language" class="form-label">Langage</label>
        <input type="text" class="form-control" name="language" value="<?= $language ?>" required>
    </div>
    <div class="col-12">
        <input type="submit" class="btn btn-primary" value="Modifier">
    </div>
</form>
<a href="index.php"><button class="btn btn-danger">Retour</button></a>

<?php
require('../../includes/footer.php');
