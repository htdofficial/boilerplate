<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediable extends Model
{
    use HasFactory;

    protected $table = 'base_categorizable';

    public function entity()
    {
        return $this->morphTo();
    }
}
