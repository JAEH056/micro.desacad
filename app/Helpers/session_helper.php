<?php

if (!function_exists('session_get')){

    function session_get(string $key) {
        $session = \Config\Services::session();

        return $session->$key;
    }
}


