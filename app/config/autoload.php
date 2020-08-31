<?php

$pluginsAutoLoad = [
    "alertify" => [
        "js" => ["js/alertify"],
        "css" => ["css/alertify"]
    ],
//    "jquery" => [
//        "js" => ["jquery-3.4.1.min"],
//        "css" => null
//    ],
//    "bootstrap" => [
//        "js" => ["js/bootstrap.min","js/popper.min"],
//        "css" => ["css/bootstrap.min"]
//    ],
    "sweetalert" => [
        "js" => ["sweetalert2.all"],
        "css" => null,
    ],
//    "owl-carousel" => [
//        "js" => ["owl.carousel.min"],
//        "css" => ["owl.carousel.min"]
//    ],
    "selectize" => [
        "js" => ["dist/js/standalone/selectize"],
        "css" => ["dist/css/selectize"]
    ],
    "mascara" => [
        "js" => ["mascara"],
        "css" => null,
    ],
    "dropify" => [
        "js" => ["js/dropify.min"],
        "css" => ["css/dropify.min"],
    ],
    "animate" => [
        "js" => null,
        "css" => ["css/animate.min"],
    ],
    "owl-carousel" => [
        "js" => ["owl.carousel.min"],
        "css" => ["owl.carousel.min","owl.theme.default.min"],
    ]
];

// Salva como constant
defined("PLUGINS_AUTOLOAD") OR define("PLUGINS_AUTOLOAD", serialize($pluginsAutoLoad));