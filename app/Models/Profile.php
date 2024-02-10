<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasMedia;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes, HasUser, HasMedia, HasCreator;

    protected $table = 'base_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'address',
        'gender',
        'phone',
        'user_id',
        'metadata',
        'created_by'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'metadata'      => 'object',
    ];

}
