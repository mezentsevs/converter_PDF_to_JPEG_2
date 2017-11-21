<?php

namespace core;

/**
 * Model - класс для работы с моделями.
 */
class Model
{
    protected $db;

    /**
     * Конструктор.
     */
    public function __construct()
    {
        global $database;
        $this->db = $database;
    }

    /**
     * Получение данных.
     */
    public function getData()
    {
    }
}
