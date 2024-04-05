<?php

namespace App\Models;

use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasCreator;

    protected $table = 'base_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'created_by'
    ];

    public function routes()
    {
        return $this->hasMany(RoleRoute::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'base_user_roles','role_id','user_id');
    }
}
