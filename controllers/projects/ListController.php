<?php

if (isAuthorized() == 0) {
    header('Location:../../public/home');
}

try {
    $projects = $pdo->prepare("SELECT * FROM $dbName.projects");
    $projects->execute();
} catch (PDOException $e) {
    die('<div class="alert alert-denager" role="alert"><b>Une erreur s\'est produite lors de la recherche des projets :</b>' . $e->getMessage());
}
