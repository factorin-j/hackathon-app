<?php

class ApiController extends Controller
{
    public $default_view_class = 'AppApiView';

    protected $pass_action = array('User');

    public function dispatchAction()
    {
        try {
            if (!Param::isMethod('post')) {
                throw new AppException('Invalid application request access');
            }

            $this->checkPassActions();
            parent::dispatchAction();
        } catch (Exception $e) {
            $this->toError($e->getMessage());
        }
    }

    public function toError($description)
    {
        $this->view->vars = array();
        $this->set(array(
            'is_error' => true,
            'json' => array('description' => $description)
        ));
        $this->render();
    }

    public function toJson(array $params)
    {
        $this->view->vars = array();
        $this->set(array(
            'is_error' => false,
            'json' => $params
        ));
        $this->render();
    }

    protected function checkPassActions()
    {
        if (!in_array(Inflector::camelize($this->name), $this->pass_action)) {
            $token = Param::getToken();
            if (!$token) {
                throw new AppException('You are not allowed to view this app');
            }
        }
    }
}
