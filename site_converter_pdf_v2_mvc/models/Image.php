<?php

namespace models;

use core\DatabaseObject;

/**
 * Image - класс для работы с изображениями.
 */
class Image extends DatabaseObject
{
    protected static $tableName = "images";
    protected static $dbFields = array(
        'id',
        'document_id',
        'document_filename',
        'filename',
        'type',
        'size'
    );

    public $id;
    public $document_id;
    public $document_filename;
    public $filename;
    public $type;
    public $size;

    public $slidersDir = "sliders";
    public $imagesDir = "images";

    /**
     * Поиск всех изображений и сортировка по имени.
     */
    public static function findAllImages()
    {
        global $database;
        $sql = "SELECT * ";
        $sql .= "FROM images ";
        $sql .= "ORDER BY filename ASC";
        return self::findBySql($sql);
    }

    /**
     * Поиск изображений для документа по его id.
     */
    public static function findImagesForDocument($document_id = 0)
    {
        global $database;
        $sql  = "SELECT * FROM ".self::$tableName;
        $sql .= "  WHERE document_id=".$database->escapeValue($document_id);
        $sql .= "  ORDER BY filename ASC";
        return self::findBySql($sql);
    }

    /**
     * Определение полного пути изображения.
     */
    public function imgFilePath()
    {
        $documentFilenamePathinfo = pathinfo($this->document_filename);
        return PUBLIC_PATH.
            DS.$this->slidersDir.
            DS.$documentFilenamePathinfo["filename"].
            DS.$this->imagesDir.
            DS.$this->filename;
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
            if (is_file($this->imgFilePath())) {
                return unlink($this->imgFilePath()) ? true : false;
            } else {
                // Файл отсутствует:
                return false;
            }
        } else {
            // Неудача:
            // Удаление записи из базы данных не удалось:
            return false;
        }
    }
}
