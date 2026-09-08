<?php

namespace App\Models\Concerns;

use App\Http\Controllers\HomeController;

/**
 * Загвар хадгалагдах / устгах бүрт нүүр хуудсын кэшийг хоослоно.
 */
trait FlushesHomeCache
{
    public static function bootFlushesHomeCache(): void
    {
        static::saved(fn () => HomeController::flushCache());
        static::deleted(fn () => HomeController::flushCache());
    }
}
