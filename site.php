<?php
use Portfol\Page;

$app->get('/', function() {
    $page = new Page();
    $page->setTpl("index");
});

$app->get('/album', function() {
    $page = new Page();
    $page->setTpl("album");
});

?>