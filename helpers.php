<?php

if (!function_exists('redirect')) {
    function redirect($route)
    {
        return header("location: {$route}");
    }
}