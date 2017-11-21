<?= outputMessage($message) ?>
<h2>Добро пожаловать!</h2>
<p>Пожалуйста, выберите документ PDF и нажмите кнопку "Конвертировать".</p>

<!-- Форма для отправки документа: -->
<form action="index.php" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE"
        value="<?= $maxFileSize ?>">
    <input type="file" name="file_upload" accept="application/pdf"><br>
    <input type="submit" name="submit" value="Конвертировать">
</form>

<!-- Секция со ссылками на слайдеры: -->
<section id="links">
<?php
foreach ($cookieDocumentArray as $cookieDocument) {
    echo "<a href=\"".PUBLIC_PATH_REL."/slider/index/?document=".
    urlencode($cookieDocument->id)."\">";
    echo htmlentities($cookieDocument->filename);
    echo "</a><br>";
}
?>
</section>
