<?php

class TestController
{
    public function testAction(): string
    {
        $view = new View('layout');

        return $view->render([
            'content' => 'welcome',
            'sub_content' => 'sub-view',
            'name' => 'Max Mustermann',
        ]);
    }
}
