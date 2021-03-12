<?php

namespace App\Traits;

trait SerializeDate
{

    protected function serializeDate($date)
    {
        return $date->format(config('global.default_date_format'));
    }

}
