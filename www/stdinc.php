<?php

spl_autoload_register(function ($class_name) {
    include __DIR__ . '/src/' . $class_name . '.php';
});


function display($file, $params = [])
{
    extract($params);

    require_once sprintf('%s/tmpl/%s.html.php', __DIR__, $file);
    exit();
}

function dd() {
    var_dump(func_get_args()); die();
}