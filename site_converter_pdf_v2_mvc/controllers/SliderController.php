<?php

namespace controllers;

use core\Controller;
use core\Session;
use models\Document;
use models\Image;

/**
 * SliderController - класс контроллера для слайдера.
 */
class SliderController extends Controller
{
    /**
     * Действие по умолчанию.
     */
    public function actionIndex()
    {
        $session = new Session();
        $message = $session->message();
        $errors = $session->errors();

        // Проверка отправки формы:
        if (isset($_POST["submit"])) {
            // Обработка формы:
            if (isset($_GET["document"])) {
                // Поиск текущего документа в базе данных:
                $document = Document::findById((int)$_GET["document"]);

                // Определение пути слайдера:
                $pdfFilePathinfo = pathinfo($document->filename);
                $source = $document->slidersDir."/".$pdfFilePathinfo["filename"];
                
                // Определение пути архива:
                $destination = $source.".zip";

                // Выполнение архивации:
                if (toZip($source, $destination)) {
                    // Установка cookies для ссылок на 30 минут:
                    setcookie(
                        "id_".$document->filename,
                        $document->id,
                        time() + 60*30,
                        '/'
                    );

                    // Скачивание и удаление архива:
                    downloadZip($destination);
                }
            }
        } else {
            // Вероятно, это GET запрос
        }

        // Поиск изображений для документа:
        $slidesArray = [];
        if (isset($_GET["document"])) {
            $imageSet = Image::findImagesForDocument((int)$_GET["document"]);
            if ($imageSet) {
                foreach ($imageSet as $image) {
                    $pdfFilePathinfo = pathinfo($image->document_filename);
                    $slidesArray[] = "'".
                        PUBLIC_PATH_REL."/".
                        $image->slidersDir."/".
                        $pdfFilePathinfo["filename"]."/".
                        $image->imagesDir."/".
                        $image->filename.
                        "'";
                }
            }
        }

        $data = [
            'slidesArray' => $slidesArray,
            'message' => $message
        ];

        $this->view->generate('slider.php', 'template.php', $data);
    }
}
