<?php
function autoload($class_name) {
    include '../app/controllers/' . $class_name . '.php';
}

spl_autoload_register('autoload');
?>
