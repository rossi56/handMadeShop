<?php ob_start(); ?>

<h2><?= $errors ?></h2>

<?php $content= ob_get_clean(); ?>

<?php require('templates/template.php'); ?>