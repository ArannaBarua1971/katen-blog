<?php

if (! (function_exists('dateCreate'))) {
    function dateCreate($target, $format)
    {
        $data = Carbon\carbon::parse($target)->format($format);

        return $data;
    }
}
if (! function_exists('timeCreate')) {
    function timeCreate($target, $format)
    {
        $time = Carbon\carbon::parse($target)->format($format);

        return $time;
    }
}
