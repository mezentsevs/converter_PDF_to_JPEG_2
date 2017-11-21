<?php

namespace controllers;

use core\Controller;
use models\Document;

/**
 * ApiController - класс контроллера для api.
 */
class ApiController extends Controller
{
    /**
     * Действие по умолчанию.
     */
    public function actionIndex()
    {
    }

    /**
     * Возврат ссылок изображений слайдера.
     */
    public function actionSlider($parameters)
    {
        // Проверка переданного id:
        // id указывается в параметре запроса /api/slider/{$id}
        if (empty($parameters)) {
            // Не передан id:
            $this->sendResponse(400, 'Error. Invalid ID supplied.');
        } else {
            // Получение id:
            $id = (int)$parameters;

            // Получение списка ссылок на изображения:
            $imagesLinks = Document::getImagesLinks($id);

            if (!isset($imagesLinks)) {
                // Изображения не найдены в базе данных:
                $this->sendResponse(404, 'Error. Slider not found.');
            } else {
                $slider = [
                    'id' => $id,
                    'imagesLinks' => $imagesLinks
                ];

                // Кодировка в формат json:
                $slider = json_encode($slider);
                
                $this->sendResponse(200, $slider, 'application/json');
            }
        }
    }

    /**
     * Отправка ответа.
     */
    public function sendResponse(
        $statusCode = 200,
        $content = '',
        $contentType = 'text/html'
    ) {
        // Отправка стартовой строки:
        $responseStartLine = 'HTTP/1.1 '.$statusCode.' '.
            $this->getStatusCodeMessage($statusCode);
        header($responseStartLine);

        // Отправка заголовков:
        header('Content-type: '.$contentType);

        // Отправка содержимого:
        echo $content;

        // Завершение:
        exit;
    }

    /**
     * Получение сообщения кода статуса.
     */
    public function getStatusCodeMessage($statusCode)
    {
        $codes = [
            200 => 'Successful operation',
            400 => 'Invalid ID supplied',
            404 => 'Slider not found'
        ];
        return (isset($codes[$statusCode])) ? $codes[$statusCode] : '';
    }
}
