<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Конвертер PDF в JPEG</title>
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_PATH_REL ?>/css/main.css">
</head>
<body>
    <header><h1>Конвертер PDF в JPEG</h1></header>
    <main>
    <?php include '../views/'.$contentView; ?>
    </main>
    <footer><small>&copy; Copyright</small></footer>
</body>
</html>
<?php global $database;
if (isset($database)) {
    $database->closeConnection();
} ?>
