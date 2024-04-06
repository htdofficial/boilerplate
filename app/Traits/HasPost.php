<?php

namespace App\Traits;

use App\Models\Post;

trait HasPost 
{
    
    public function posts()
    {
        return $this->morphToMany(Post::class, 'base_postables');
    }

    public function post()
    {
        return $this->posts->last();
    }
    
}