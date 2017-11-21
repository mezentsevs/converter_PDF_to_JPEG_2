<?php

namespace core;

/**
 * Controller - класс для работы с контроллерами.
 */
class Controller
{
    protected $db;
    public $model;
    public $view;
    
    /**
     * Конструктор.
     */
    public function __construct()
    {
        global $database;
        $this->db = $database;
        $this->view = new View();
    }
    
    /**
     * Действие по умолчанию.
     */
    public function actionIndex()
    {
    }
}
