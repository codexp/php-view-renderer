<?php /** @var View $view */ ?>
<p>This template has been included<?=
    $view->has('foo') ? sprintf(' with <code>foo: "%s"</code>', $view->foo) : ''
?>.</p>
