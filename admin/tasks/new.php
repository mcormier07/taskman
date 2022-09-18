<?php
require('../../includes/header.php');
require('../../controllers/tasks/AddController.php');
?>

<form method="POST" action="#" class="row g-3">
    <div class="col-md-12">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" required>
    </div>
    <div class="col-12">
        <input type="submit" class="btn btn-primary" value="Créer">
    </div>
</form>
<a href="/taskman/admin/projects/"><button class="btn btn-danger">Retour</button></a>


<?php
require('../../includes/footer.php');
