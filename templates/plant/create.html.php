<?php

/** @var \App\Model\Plant $plant */
/** @var \App\Service\Router $router */

$title = 'Create Plant';
$bodyClass = "edit";

ob_start(); ?>
    <h1>Create Plant</h1>
    <form action="<?= $router->generatePath('plant-create') ?>" method="post" enctype="multipart/form-data" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_createForm.html.php'; ?>
        <input type="hidden" name="action" value="plant-create">
    </form>

    <a href="<?= $router->generatePath('plant-index') ?>">Back to plant list</a>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
