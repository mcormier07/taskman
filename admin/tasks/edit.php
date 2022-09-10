<?php
require('../../includes/header.php');
require('../../controllers/clients/EditController.php');
?>

<form method="POST" action="#" class="row g-3">
    <div class="col-md-4">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" name="name" value="<?= $name ?>" required>
    </div>
    <div class="col-md-4">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="firstname" value="<?= $firstname ?>" required>
    </div>
    <div class="col-md-4">
        <label for="username" class="form-label">Nom d'utilisateur</label>
        <div class="input-group has-validation">
            <span class="input-group-text" id="username">@</span>
            <input type="text" class="form-control" name="username" aria-describedby="username" value="<?= $username ?>" required>
        </div>
    </div>
    <div class="col-md-12">
        <label for="email" class="form-label">Adresse email</label>
        <input type="email" class="form-control" name="email" value="<?= $email ?>" required>
    </div>
    <div class="col-12">
        <input type="submit" class="btn btn-primary" value="Modifier">
    </div>
</form>
<a href="index.php"><button class="btn btn-danger">Retour</button></a>

<?php
require('../../includes/footer.php');
