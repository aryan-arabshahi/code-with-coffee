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

if (!function_exists('generate_slug')) {
    function generate_slug($value)
    {
        return \Str::slug($value, '-');
    }
}

if (!function_exists('humanize_date')) {
    function humanize_date($date, $format = 'F d, Y')
    {
        return $date->format($format);
    }
}

if (!function_exists('get_site_title')) {
    function get_site_title(string|array $data, bool $appendAppName = true): string
    {
        $result = (is_array($data)) ? implode(' | ', $data) : $data;
        return (!$appendAppName) ? $result : implode(' - ', [$result, config('app.name')]);
    }
}
