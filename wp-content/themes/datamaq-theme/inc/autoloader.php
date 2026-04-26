<?php
/**
 * Simple PSR-4 Autoloader for DataMaq Theme
 */

spl_autoload_register(function ($class) {
    $prefix = 'DataMaq\\';
    $base_dir = get_template_directory() . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
