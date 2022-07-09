<?php
use Illuminate\Support\Facades\Config;
return [
    'host' => (app()->runningInConsole() === false) ? request()?->getHttpHost() : null,
    'api' => (app()->runningInConsole() === false) ? request()?->getHttpHost().'/api' : null,
];
