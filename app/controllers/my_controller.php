<?php

class MyController extends ApiController
{
    public function index()
    {
        $this->set(array('title' => 'DC', 'msg' => 'welcome'));
    }
}
