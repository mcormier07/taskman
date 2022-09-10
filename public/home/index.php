<?php
require(__DIR__ . '/../../includes/header.php');
require(__DIR__ . '/../../controllers/auth/AuthController.php');
?>

<?php
if (!$checkSettings) {
    require(__DIR__ . '/../auth/register.php');
} else {
    require(__DIR__ . '/../auth/login.php');
}
?>

<?php
require(__DIR__ . '/../../includes/footer.php');
