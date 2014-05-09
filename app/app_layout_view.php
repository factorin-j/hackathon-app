<?php

/**
 * base application view class for layout interfaces
 * Class AppLayoutView
 */
class AppLayoutView extends View
{
    public $layout = 'layouts/default';

    /**
     * render layout view
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
        $this->filename = VIEWS_DIR . $this->layout . self::EXTENSION;
        $this->vars['_content_'] = $content;
        $this->controller->output = $this->extract();
    }
}
