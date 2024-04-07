<?php

namespace App\Models\Base;

use App\Models\Scopes\Base\PostScope;

class Post extends \App\Models\Post
{
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new PostScope);

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->record_type = 'POST';
        });
    }
}
