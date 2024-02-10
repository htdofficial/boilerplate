<?php

namespace App\Traits;

use App\Models\Media;

trait HasMedia {

    public function mediable()
    {
        return $this->morphToMany(Media::class, 'base_mediables');
    }

    public function media()
    {
        return $this->mediable->last();
    }

}