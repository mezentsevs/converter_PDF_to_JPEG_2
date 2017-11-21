<?php

namespace controllers;

use core\Controller;
use core\Session;
use models\Document;

/**
 * MainController - класс главного контроллера.
 */
class MainController extends Controller
{
    /**
     * Действие по умолчанию.
     */
    public function actionIndex()
    {
        $session = new Session();
        $message = $session->message();
        $errors = $session->errors();

        // Максимальный размер файла
        // (50 MB = 52428800 байт):
        $maxFileSize = 52428800;

        // Проверка отправки формы:
        if (isset($_POST["submit"])) {
            // Обработка формы:
            $document = new Document();
            $document->attachFile($_FILES["file_upload"]);

            // Сохранение документа:
            if ($document->save()) {
                // Успех
                // Проверка количества страниц в документе:
                $pdfFilename = $document->uploadDir.DS.$document->filename;
                if (pdfPagesNumber($pdfFilename) > 20) {
                    // Количество страниц превышает допустимое значение:
                    $document->destroy();
                    $message = "Количество страниц в документе".
                        " превышает допустимое значение.";
                } else {
                    // Количество страниц в норме:
                    if ($document->convert()) {
                        $session->message("Конвертирование завершено успешно.");
                        redirectTo(PUBLIC_PATH_REL."/slider/index/?document=".$document->id);
                    } else {
                        $message = "Ошибка конвертирования документа.";
                    }
                }
            } else {
                // Неудача
                $message = join("<br/>", $document->errors);
            }
        } else {
            // Вероятно, это GET запрос
        }

        // Чтение cookies:
        $cookieDocumentArray = [];
        foreach ($_COOKIE as $cookieKey => $cookieValue) {
            // Поиск cookie с id:
            if (preg_match("/^id_/", $cookieKey)) {
                // Поиск документа:
                $cookieDocument = Document::findById((int)$cookieValue);
                
                // Добавление документа в массив:
                if ($cookieDocument) {
                    $cookieDocumentArray[] = $cookieDocument;
                }
            }
        }

        $data = [
            'maxFileSize' => $maxFileSize,
            'message' => $message,
            'cookieDocumentArray' => $cookieDocumentArray
        ];

        $this->view->generate('main.php', 'template.php', $data);
    }
}
