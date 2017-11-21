<?php

/**
 * Общие установки.
 */

    // Установка временной зоны:
    date_default_timezone_set("Europe/Samara");

/**
 * Установка основных путей.
 */

    // Установка разделителя директорий:
    defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

    // Установка пути корневой директории сайта:
    defined("SITE_ROOT") ? null : define(
        "SITE_ROOT",
        $_SERVER["DOCUMENT_ROOT"].DS."my-site".DS."site_converter_pdf_v2_mvc"
    );

    // Установка пути папки public:
    $publicPath = "public";
    defined("PUBLIC_PATH") ? null : define(
        "PUBLIC_PATH",
        SITE_ROOT.DS.$publicPath
    );

    // Установка относительного пути папки public от корня сайта:
    defined("PUBLIC_PATH_REL") ? null : define(
        "PUBLIC_PATH_REL",
        "/my-site/site_converter_pdf_v2_mvc/".$publicPath
    );

    // Установка пути директории с библиотеками:
    defined("LIB_PATH") ? null : define(
        "LIB_PATH",
        SITE_ROOT.DS."includes"
    );
