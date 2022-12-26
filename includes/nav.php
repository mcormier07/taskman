<?php
require('../../controllers/projects/ListController.php');
?>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Taskman</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Projets
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        foreach ($projects as $ligne) { ?>
                            <li><a class="dropdown-item" href="/admin/projects/view.php?id=<?= $ligne['id'] ?>"><?= $ligne['name'] ?></a></li>
                        <?php }
                        ?>
                    </ul>
                </li>
            </ul>
            <?php if (isAuthorized() == 1) { ?>
                <a href="/admin/projects/new.php"><button class="btn btn-primary">Ajouter un project</button></a>
                <a href="/public/auth/logout.php"><button class="btn btn-danger">Déconnexion</button></a>
            <?php } ?>
        </div>
    </div>
</nav>