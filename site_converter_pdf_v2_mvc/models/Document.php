<?php

namespace models;

use core\DatabaseObject;

/**
 * Document - класс для работы с документом.
 */
class Document extends DatabaseObject
{
    protected static $tableName = "documents";
    protected static $dbFields = array(
        'id',
        'filename',
        'type',
        'size'
    );

    public $id;
    public $filename;
    public $type;
    public $size;

    private $tempPath;
    public $uploadDir = "documents";
    public $slidersDir = "sliders";
    public $imagesDir = "images";
    
    public $errors = array();
    protected $uploadErrors = array(
        UPLOAD_ERR_OK =>
        "Ошибок нет.",
        UPLOAD_ERR_INI_SIZE =>
        "Размер документа превышает допустимое значение upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE =>
        "Размер документа превышает допустимое значение MAX_FILE_SIZE формы.",
        UPLOAD_ERR_PARTIAL =>
        "Частичная загрузка.",
        UPLOAD_ERR_NO_FILE =>
        "Отсутствует файл.",
        UPLOAD_ERR_NO_TMP_DIR =>
        "Отсутствует временная директория.",
        UPLOAD_ERR_CANT_WRITE =>
        "Невозможно записать на диск.",
        UPLOAD_ERR_EXTENSION =>
        "Загрузка файла остановлена расширением."
        );

    /**
     * Поиск всех документов и сортировка по имени.
     */
    public static function findAllDocuments()
    {
        global $database;
        $sql = "SELECT * ";
        $sql .= "FROM documents ";
        $sql .= "ORDER BY filename ASC";
        return self::find_by_sql($sql);
    }

    /**
     * Инициализация объекта значениями из формы.
     * $file - $_FILE(['uploaded_file'])
     */
    public function attachFile($file)
    {
        // Проверка наличия ошибок:
        if (!$file || empty($file) || !is_array($file)) {
            // Ничего не было загружено или неправильный аргумент:
            $this->errors[] = "Файл не был загружен.";
            return false;
        } elseif ($file['error'] != 0) {
            // Ошибка в процессе загрузки:
            $this->errors[] = $this->uploadErrors[$file['error']];
            return false;
        } else {
        // Установка атрибутов объекта значениями из $_FILE:
            $this->tempPath = $file['tmp_name'];

        // Добавление времени к имени файла:
            $filePathinfo = pathinfo($file['name']);
            $this->filename = $filePathinfo['filename']."_".time().
            ".".$filePathinfo['extension'];

            $this->type = $file['type'];
            $this->size = $file['size'];
            return true;
        }
    }

    /**
     * Сохранение.
     */
    public function save()
    {
        // Проверка наличия id (у новой записи его нет):
        if (isset($this->id)) {
            // Если id есть, то выполняется обновление:
            return $this->update();
        } else {
            // Проверка наличия ошибок:
            if (!empty($this->errors)) {
                return false;
            }

            // Проверка дополнительных требований к файлу:

            // Проверка наличия имени файла и временной директории:
            if (empty($this->filename) || empty($this->tempPath)) {
                $this->errors[] = "Расположение файла недоступно.";
                return false;
            }

            // Определение целевого пути файла:
            $targetPath = PUBLIC_PATH.DS.$this->uploadDir.DS.$this->filename;

            // Проверка наличия файла с таким же именем:
            if (file_exists($targetPath)) {
                $this->errors[] = "Файл {$this->filename} уже существует.";
                return false;
            }

            // Попытка перемещения файла из временной в целевую директорию:
            if (move_uploaded_file($this->tempPath, $targetPath)) {
                // Успех:
                // Создание объекта с сохранением в базе данных:
                if ($this->create()) {
                    // Удаление временного пути (файла там уже нет):
                    unset($this->tempPath);
                    return true;
                }
            } else {
                // Неудача:
                // Вывод ошибки - файл не был перемещен:
                $this->errors[] =
                    "Загрузка файла прошла неуспешно,".
                    " возможно из-за некорректных разрешений".
                    " для директории загрузки.";
                return false;
            }
        }
    }

    /**
     * Определение полного пути документа.
     */
    public function pdfFilePath()
    {
        return PUBLIC_PATH.
            DS.$this->uploadDir.
            DS.$this->filename;
    }

    /**
     * Определение полного пути папки изображений.
     */
    public function imgFolderPath()
    {
        $pdfFilePathinfo = pathinfo($this->filename);
        return PUBLIC_PATH.
            DS.$this->slidersDir.
            DS.$pdfFilePathinfo["filename"].
            DS.$this->imagesDir;
    }

    /**
     * Определение полного пути папки слайдера.
     */
    public function sliderFolderPath()
    {
        $pdfFilePathinfo = pathinfo($this->filename);
        return PUBLIC_PATH.
            DS.$this->slidersDir.
            DS.$pdfFilePathinfo["filename"];
    }

    /**
     * Определение полного пути файла index.html слайдера.
     */
    public function sliderIndexhtmlPath()
    {
        return $this->sliderFolderPath().DS."index.html";
    }

    /**
     * Уничтожение.
     */
    public function destroy()
    {
        // Удаление записи из базы данных:
        if ($this->delete()) {
            // Успех:
            // Удаление файла:
            if (is_file($this->pdfFilePath())) {
                unlink($this->pdfFilePath());
            }

            // Поиск изображений для документа:
            $imageSet = Image::findImagesForDocument($this->id);
            if ($imageSet) {
                foreach ($imageSet as $image) {
                    // Удаление изображений:
                    $image->destroy();
                }
            }

            // Удаление папки изображений:
            if (is_dir($this->imgFolderPath())) {
                rmdir($this->imgFolderPath());
            }

            // Удаление файла index.html для слайдера:
            if (is_file($this->sliderIndexhtmlPath())) {
                unlink($this->sliderIndexhtmlPath());
            }

            // Удаление папки слайдера:
            if (is_dir($this->sliderFolderPath())) {
                rmdir($this->sliderFolderPath());
            }

            return true;
        } else {
            // Неудача:
            // Удаление записи из базы данных не удалось:
            return false;
        }
    }

    /**
     * Формирование содержимого файла index.html слайдера для скачивания.
     */
    public static function sliderIndexhtmlContent($slidesArray = [])
    {
        $output  = "<!DOCTYPE html>\r\n";
        $output .= "<html lang=\"ru\">\r\n";
        $output .= "<head>\r\n";
        $output .= "<meta charset=\"utf-8\">\r\n";
        $output .= "<title>Слайдер</title>\r\n";
        $output .= "</head>\r\n";
        $output .= "<style>\r\n";
        $output .= "body { margin: 0; font-family: Arial;";
        $output .= " font-size: 1em; }\r\n";
        $output .= "header { background: #EEE; height: 50px; }\r\n";
        $output .= "h1 { margin: 0; font-size: 1.2em;";
        $output .= " text-align: center; line-height: 50px; }\r\n";
        $output .= "main { min-height: 1000px; }\r\n";
        $output .= "#slider { margin: 50px auto; width: 640px;";
        $output .= " text-align: center; }\r\n";
        $output .= "#slide { width: 620px; border: 1px solid #CCC;";
        $output .= " -moz-box-shadow: 1px 1px 1px #CCC;";
        $output .= " -o-box-shadow: 1px 1px 1px #CCC;";
        $output .= " -webkit-box-shadow: 1px 1px 1px #CCC;";
        $output .= " box-shadow: 1px 1px 1px #CCC; }\r\n";
        $output .= "button { margin: 10px 5px; padding: 3px; }\r\n";
        $output .= "footer { background: #EEE; height: 50px;";
        $output .= " line-height: 50px; text-align: center; }\r\n";
        $output .= "</style>\r\n";
        $output .= "<script>\r\n";
        $output .= "var slider = {\r\n";
        $output .= "slides:[".htmlentities(join(',', $slidesArray))."],\r\n";
        $output .= "index:0,\r\n";
        $output .= "set: function(image) {";
        $output .= " document.getElementById(\"slide\").";
        $output .= "setAttribute(\"src\", image); },\r\n";
        $output .= "init: function() { this.set(this.";
        $output .= "slides[this.index]); },\r\n";
        $output .= "left: function() { this.index--; if (this.index < 0) {";
        $output .= " this.index = this.slides.length-1; }";
        $output .= " this.set(this.slides[this.index]); },\r\n";
        $output .= "right: function() { this.index++; if (";
        $output .= "this.index == this.slides.length) { this.index = 0; }";
        $output .= " this.set(this.slides[this.index]); }\r\n";
        $output .= "};\r\n";
        $output .= "window.onload = function() { slider.init();";
        $output .= " setInterval(function() { slider.right(); },5000); };\r\n";
        $output .= "</script>\r\n";
        $output .= "<body>\r\n";
        $output .= "<header><h1>Слайдер</h1></header>\r\n";
        $output .= "<main>\r\n";
        $output .= "<figure id=\"slider\">\r\n";
        $output .= "<img id=\"slide\" src=\"\" alt=\"слайд\">\r\n";
        $output .= "<button id=\"left\" onclick=\"slider.left();\">";
        $output .= "&laquo; Назад</button>\r\n";
        $output .= "<button id=\"right\" onclick=\"slider.right();\">";
        $output .= "Далее &raquo;</button>\r\n";
        $output .= "</figure>\r\n";
        $output .= "</main>\r\n";
        $output .= "<footer><small>&copy; Copyright</small></footer>\r\n";
        $output .= "</body>\r\n";
        $output .= "</html>\r\n";
        return $output;
    }

    /**
     * Запись содержимого файла index.html слайдера для скачивания.
     */
    public function sliderIndexhtmlWrite()
    {
        $slidesArray = [];
        
        // Определение деталей файла pdf:
        $pdfFilePathinfo = pathinfo($this->filename);

        // Формирование массива с адресами изображений:
        $imageSet = Image::findImagesForDocument($this->id);
        if ($imageSet) {
            foreach ($imageSet as $image) {
                $slidesArray[] = "'".$this->imagesDir."/".$image->filename."'";
            }
        }

        // Формирование содержимого файла:
        $content = self::sliderIndexhtmlContent($slidesArray);

        // Запись содержимого в файл:
        file_put_contents($this->slidersDir."/".$pdfFilePathinfo["filename"]."/index.html", $content);
    }

    /**
     * Конвертирование документа.
     */
    public function convert()
    {
        // Определение путей:
        $pdfFilePath = $this->pdfFilePath();
        $imgFolderPath = $this->imgFolderPath();

        // Создание директории:
        if (mkdir($imgFolderPath, 0777, true)) {
            // Успех cоздания директории:
            // Попытка обработки документа PDF:
            try {
                // Создание нового пустого объекта Imagick:
                $imagick = new \Imagick();
                // Установка кол-ва точек на дюйм (300,300 = 300dpi):
                $imagick->setResolution(300, 300);
                // Чтение документа PDF из файла:
                $imagick->readImage($pdfFilePath);

                    // Конвертирование страниц документа PDF в изображения JPEG:
                    $i=0;
                foreach ($imagick as $pageImage) {
                    $i++;
                    // Добавление первого "0" для чисел меньше 10:
                    if ($i<10) {
                        $i = "0" . $i;
                    }

                    // Установка палитры:
                    $pageImage->setImageColorspace(255);
                    // Установка компрессора JPEG:
                    $pageImage->setCompression(\Imagick::COMPRESSION_JPEG);
                    // Установка качества сжатия
                    // (1 = высокое сжатие .. 100 = низкое сжатие):
                    $pageImage->setCompressionQuality(80);
                    // Установка формата изображения:
                    $pageImage->setImageFormat("jpeg");

                    // Изменение альбомной ориентации страницы в портретную:
                    if ($pageImage->getImageWidth() >
                        $pageImage->getImageHeight()
                    ) {
                        // Поворот изображения против часовой стрелки:
                        $pageImage->rotateImage("#000", -90);
                    }

                    // Определение пути к файлу изображения JPEG:
                    $pdfFilePathinfo = pathinfo($this->filename);
                    $imgFilename = $pdfFilePathinfo["filename"].
                        "_".$i.".jpeg";
                    $imgFilePath = $imgFolderPath.DS.$imgFilename;
                    $imgFilePathinfo = pathinfo($imgFilePath);
                        
                    // Запись страницы документа PDF
                    // в файл изображения JPEG:
                    $pageImage->writeImage($imgFilePath);

                    // Создание объекта image,
                    // инициализация и сохранение в базе данных:
                    $image = new Image();
                    $image->document_id = $this->id;
                    $image->document_filename = $this->filename;
                    $image->filename = $imgFilePathinfo["basename"];
                    $image->type = $imgFilePathinfo["extension"];
                    $image->size = filesize($imgFilePath);
                    $image->save();
                }

                // Освобождение памяти и уничтожение объекта Imagick:
                $imagick->clear();
                $imagick->destroy();

                // Запись файла index.html для слайдера:
                $this->sliderIndexhtmlWrite();

                return true;
            } catch (ImagickException $e) {
                // Обработка исключения - вывод сообщения:
                echo $e->getMessage();
                return false;
            }
        } else {
            // Неудача cоздания директории:
            return false;
        }
    }

    /**
     * Получение списка ссылок на изображения документа
     * по его id в формате json.
     */
    public static function getImagesLinks($id)
    {
        // Поиск изображений для переданного id:
        $imageSet = Image::findImagesForDocument($id);
        if ($imageSet) {
            // Изображения найдены
            // Определение списка ссылок на изображения:
            $i=0;
            foreach ($imageSet as $image) {
                $i++;
                $documentFilenamePathinfo = pathinfo(
                    $image->document_filename
                );

                // Формирование массива со ссылками:
                // ("image".$i) можно использовать для ключей $result
                $result[] = $_SERVER['SERVER_NAME']."/".
                            PUBLIC_PATH_REL."/".
                            $image->slidersDir."/".
                            $documentFilenamePathinfo["filename"]."/".
                            $image->imagesDir."/".
                            $image->filename;
            }
            return $result;
        } else {
            // Изображения не найдены
            return null;
        }
    }
}
