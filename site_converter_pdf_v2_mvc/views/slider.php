<?php
// Передача массива c адресами изображений в js:
if (isset($slidesArray)) {
    echo "<script type=\"text/javascript\">var slidesArray=[";
    echo htmlentities(join(',', $slidesArray));
    echo "]</script>";
}
?>
<script type="text/javascript" src="<?= PUBLIC_PATH_REL ?>/js/script.js"></script>

<a id="back" href="<?= PUBLIC_PATH_REL ?>/main/index">&laquo; Назад</a>
<?php echo outputMessage($message); ?>

<!-- Слайдер: -->
<figure id="slider">
    <img id="slide" src="" alt="слайд">
    <button id="left" onclick="slider.left();">&laquo; Назад</button>
    <button id="right" onclick="slider.right();">Далее &raquo;</button>
</figure>

<!-- Кнопка скачать zip архив: -->
<form id="form" action="slider/index/?document=<?php
    echo urlencode($_GET['document']); ?>" method="POST">
    <input type="submit" name="submit" value="Скачать zip">
</form>

<section id="images_links_list">
    <a href="<?= PUBLIC_PATH_REL ?>/api/slider/<?php echo urlencode($_GET['document']);
        ?>">Список ссылок на изображения в формате json</a>
</section>
