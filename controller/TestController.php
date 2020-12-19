<?php

use ViewModel\Layout;

class TestController
{
    public function testAction(): string
    {
        $layout = new Layout();

        return $layout->render([
            'content' => 'WelcomePage',
            'sub_content' => 'parts/sub-view',
            'name' => 'Max Mustermann',
        ]);
    }
}
