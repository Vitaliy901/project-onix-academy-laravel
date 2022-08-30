<?php

namespace App\Models\Traits;

use App\Models\Scopes\Posts\MyFilter;

trait RegisterGlobalScope
{
    protected static function bootRegisterGlobalScope()
    {
        !request()->is('api/posts/my') ?: static::addGlobalScope(new MyFilter);
    }
}
