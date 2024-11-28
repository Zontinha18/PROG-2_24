<?php
function autoload($class_name) {
    $paths = ['../Controller/', '../Models/'];
    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if (file_exists($file)) {
            include $file;
        }
    }
}

spl_autoload_register('autoload');

?>
