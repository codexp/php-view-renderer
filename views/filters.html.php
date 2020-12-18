<?php /** @var View $view */ ?>

<h2>Filters</h2>

<dl class="filters">
    <dt>default filter: escape (htmlspecialchars)</dt>
    <dd><?= $view->filter('<b>bold</b>') ?></dd>

    <dt>trim</dt>
    <dd>"<?= $view->filter('   trim all spaces   ', 'trim') ?>"</dd>

    <dt>join</dt>
    <dd><?= $view->filter(['join', 'all', 'elements', 'of', 'an', 'array'], 'join') ?></dd>

    <dt>upper</dt>
    <dd><?= $view->filter('all in upper case', 'upper') ?></dd>

    <dt>ucwords</dt>
    <dd><?= $view->filter('all words upper cased', 'ucwords') ?></dd>

    <dt>camelCase</dt>
    <dd><?= $view->filter('make words to camel case', 'camelCase') ?></dd>

    <dt>trim with additional argument AND camelCase</dt>
    <dd>"<?= $view->filter('---trim all dashes and camel case---', ['trim' => '-'], 'camelCase') ?>"</dd>

    <dt>number with multiple arguments</dt>
    <dd><?= $view->filter(-123456.789, ['number' => [2, ',', '.']]) ?></dd>

    <dt>multiple filters with multiple arguments</dt>
    <dd><?= $view->filter(123456.789, ['number' => [2, ',', '.'], 'trim' => '-']) ?></dd>

    <dt>json</dt>
    <dd><?= $view->filter(['convert' => 'anything', 'to' => 'JSON'], 'json') ?></dd>

    <dt>price (generates HTML)</dt>
    <dd><?= $view->filter(-123.4567, 'price') ?></dd>
</dl>

<style>
    dl.filters > dt {
        margin-top: 10px;
        font-weight: bold;
    }

    .price {
        font-size: 24px;
    }

    .price.negative {
        color: red;
    }
</style>
