<?php

if (!function_exists('get_class_name')) {
    function get_class_name($class)
    {
        $exploded_class = explode('\\', get_class($class));
        return end($exploded_class);
    }
}

if (!function_exists('storage_image_path')) {
    function storage_image_path($module, $prefix = 'origin')
    {
        $path = [config("modules.$module.storage.images")];
        if ($prefix) {
            $path[] = $prefix;
        }
        return implode('/', $path);
    }
}
