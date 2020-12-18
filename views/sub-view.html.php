<?php /** @var View $view */ ?>

<h2>Sub-View</h2>

<p>Dear <?= $name ?? 'Pete' ?>, welcome to <?= $title ?>!</p>

<h3>Sub-View Variables</h3>
<pre><code><?= var_export($view->getVariables(), 1) ?></code></pre>
