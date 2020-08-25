<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <!-- Favicon -->
    <link href="<?= BASE_URL ?>assets/theme/site/img/favico.png" rel="icon" type="image/png">

    <title><?= $seo["title"]; ?></title>

    <!-- Meta Tags -->
    <meta name="keywords" content="<?= $seo["title"]; ?>">
    <meta name="description" content="<?= $seo["title"]; ?>">
    <meta name="author" content="<?= SITE_NOME; ?>">
    <meta name="robots" content="<?= $seo["robots"]; ?>">
    <meta name="googlebot" content="<?= $seo["googlebot"]; ?>">
    <meta name="revisit" content="2 days">
    <meta name="Revisit-After" content="2 Days">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="format-detection" content="telephone=no">

    <!-- Facebook -->
    <meta property="og:locale" content="pt_BR">
    <meta property="og:url" content="<?= $smo["url"]; ?>">
    <meta property="og:title" content="<?= $smo["title"]; ?>">
    <meta property="og:site_name" content="<?= SITE_NOME; ?>">
    <meta property="og:description" content="<?= $smo["description"]; ?>">
    <meta property="og:image" content="<?= $smo["image"]; ?>">
    <meta property="og:image:type" content="<?= $smo["image_type"]; ?>">
    <meta property="og:image:width" content="<?= $smo["image_width"]; ?>">
    <meta property="og:image:height" content="<?= $smo["image_height"]; ?>">

    <!-- Responsivo  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Autoload ===================================================== -->
    <?php $this->view("autoload/css"); ?>

</head>
<body>