<?php /** @var View $view */ ?>

<h2>Sub-View</h2>

<p>Dear <?= $name ?? 'Pete' ?>, welcome to <?= $title ?>!</p>

<h3>Sub-View Variables</h3>
<pre><code><?= var_export($view->getVariables(), 1) ?></code></pre>

<h4>View Variable access</h4>

<p>
    We can access view variables 3 different ways:
    <dl>
        <dt>By variable name like <code>$test</code></dt>
        <dd><code><?= $test ?></code></dd>

        <dt>By array access like <code>$view['test']</code></dt>
        <dd><code><?= $view['test'] ?></code></dd>

        <dt>By property access like <code>$view->test</code></dt>
        <dd><code><?= $view->test ?></code></dd>
    </dl>
</p>
