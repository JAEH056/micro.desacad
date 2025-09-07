<?php

if (!function_exists('get_project_prefix')){

    function get_project_prefix(): string {
        $uri = \Config\Services::uri();

	return $uri->getSegment(1);
    }

}
