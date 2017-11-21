<?php

namespace core;

/**
 * View - класс для работы с видами.
 */
class View
{
    public $templateView; // общий вид по умолчанию
    
    /**
     * Генерация вида.
     */
    public function generate($contentView, $templateView, $data = null)
    {
        // Преобразование элементов массива в переменные:
        if (is_array($data)) {
            extract($data);
        }

        // Подключение вида:
        include '../views/'.$templateView;
    }
}
