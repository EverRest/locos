<?php

if (!function_exists('callingFunctionName')) {
    /**
     * @return string
     */
    function callingFunctionName(): string
    {
        $ex = new Exception();
        $trace = $ex->getTrace();
        return $trace[2];
    }
}
