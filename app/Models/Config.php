<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory, HasMedia;

    protected $table = 'base_configs';

    public function entity()
    {
        return $this->morphTo();
    }
}
