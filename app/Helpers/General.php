<?php

use App\Models\Language;
use Illuminate\Support\Facades\Config;

function get_languages()
{
    return Language::active()->get();
}

function get_defualt_language()
{
    return Config::get('app.locale');
}