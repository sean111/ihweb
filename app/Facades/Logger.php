<?php

namespace App\Facades;

use Illuminate\Support\Facades\Log;

class Logger extends Log
{
    public static function exception(\Throwable $e)
    {
        Log::error($e->getMessage(), ['trace' => $e->getTraceAsString(), 'line' => $e->getLine()]);
    }
}
