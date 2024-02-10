<?php

namespace App\Traits;

use App\Models\User;

trait HasCreator {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->created_by = $query->created_by ?? auth()->user()->id;
        });
    }

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    
}