<?php

if (!function_exists('get_class_name')) {
    function get_class_name($class)
    {
        $exploded_class = explode('\\', get_class($class));
        return end($exploded_class);
    }
}
