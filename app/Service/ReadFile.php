<?php

namespace App\Service;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Config;

class ReadFile {
    const IMAGE = 1;
    const VIDEO = 2;
    public static function getLink($filePath) {
        $host = Config::get('params.host');
        $link = $host.'/'.$filePath;
        if (isset($link)) {
            return $link;
        }
        return '';
    }

}
