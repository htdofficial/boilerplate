<?php

namespace App\Models;

use App\Traits\HasCategory;
use App\Traits\HasCreator;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasCreator, HasMedia, HasCategory;

    protected $table = 'base_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'record_type',
        'visibility',
        'created_by'
    ];

    public function postables()
    {
        return $this->hasMany(Postable::class);
    }

}
