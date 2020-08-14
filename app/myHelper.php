<?php

if (! function_exists('convertToReadableSize')) {
    /**
     * @param int $size
     * @return string
     */
    function convertToReadableSize(int $size){
        $base = log($size) / log(1024);
        $suffix = array("", "KB", "MB", "GB", "TB");
        $f_base = floor($base);
        return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
    }
}

if (!function_exists('byteToMB')) {
    /**
     * byte 转成 MB
     * @param int $size
     * @return string
     */
    function byteToMB(int $size) {
        return sprintf('%.2f', $size / pow(1024, 2));
    }
}
