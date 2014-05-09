<?php

class AppApiView extends View
{
    public function render($action = null)
    {
        unset($action);
        header('Content-type: application/json; charset=utf-8');
        $this->controller->output = json_encode($this->vars);
    }
}
