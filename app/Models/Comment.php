<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasMedia;
use App\Traits\HasPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use HasFactory, SoftDeletes, NodeTrait, HasCreator, HasMedia, HasPost;

    protected $table = 'base_comments';

    public function entity()
    {
        return $this->morphTo();
    }

}
