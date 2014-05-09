<?php

/**
 * Core view class
 * Class View
 */
class View
{
    const EXTENSION = '.php';

    public $filename;
    public $controller;
    public $vars = array();

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    /**
     * Render view file
     * @param $action
     */
    public function render($action = null)
    {
        $action = is_null($action) ? $this->controller->action : $action;
        if (strpos($action, '/') === false) {
            $this->filename = VIEWS_DIR . $this->controller->name . '/' . $action . self::EXTENSION;
        } else {
            $this->filename = VIEWS_DIR . $action . self::EXTENSION;
        }
        $content = $this->extract();
        $this->controller->output = $content;
    }

    /**
     * Extract variables to view file
     * @return string
     * @throws DCException
     */
    public function extract()
    {
        if (!file_exists($this->filename)) {
            throw new DCException("{$this->filename} is not found");
        }

        extract($this->vars, EXTR_SKIP);
        ob_start();
        ob_implicit_flush(0);
        include_once($this->filename);
        $this->vars = get_defined_vars();
        return ob_get_clean();
    }
}
