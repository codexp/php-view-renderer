<?php /** @var \ViewModel\WelcomePage $view */ ?>

<h1>Hello World</h1>

<p>
    Hi, <?= $view->name ?>
</p>

<h3>Welcome-View Variables</h3>
<pre><code><?= var_export($view->getVariables(), 1) ?></code></pre>

<?php
    $view
        ->include($view->sub_content, ['only' => ['title' => 'Sub Template', 'test' => 'foo']])
        ->include('parts/filters')
        ->include('parts/rendering')
?>

<h3>Welcome View Dump</h3>
<pre><?php var_dump($view); ?></pre>

<?php $view->include('footer') ?>
