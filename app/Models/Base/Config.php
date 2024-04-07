<?php

namespace App\Models\Base;

use App\Models\Scopes\Base\ConfigScope;

class Config extends \App\Models\Config
{
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new ConfigScope);

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->record_type = 'DEFAULT';
        });
    }
}
