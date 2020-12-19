<?php /** @var View $view */ ?>

<h2>Rendering</h2>

<p>
    There are few ways to render a Template:
</p>

<h3>By including a template</h3>

<p><code>$view->include('parts/included');</code></p>
<?php $view->include('parts/included'); ?>

<h3>By echoing a view instance</h3>

<?php $myView = new View('parts/included') ?>

<pre><code>&lt;?php $myView = new View('parts/included') ?&gt;
&lt;?= $myView ?&gt;
</code></pre>

<?= $myView ?>

<h3>By invoking a view instance</h3>

<pre><code>&lt;?php $myView = new View('parts/included') ?&gt;
&lt;?= $myView(['foo' => 'bar']) ?&gt;
</code></pre>

<?= $myView(['foo' => 'bar']) ?>

<p>repeatedly...</p>

<pre><code>&lt;?= $myView(['foo' => 'BAZ']) ?&gt;</code></pre>

<?= $myView(['foo' => 'BAZ']) ?>
