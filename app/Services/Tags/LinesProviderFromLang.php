<?php

namespace App\Services\Tags;

class LinesProviderFromLang implements LinesProvider
{
    public function getString(String $key)
    {
        return __('public.' . $key);
    }
}